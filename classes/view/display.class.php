<?php

/**
 * Display
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @copyright Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @package Hari CMS
 * @license http://www.opensource.org/licenses/gpl-2.0.php
 */

require_once 'classes/model/images.class.php';

class Display {

	/**
	 * $theme
	 * @var boolean $theme Boolean to see if theme is working
	 */
    public $theme;

	/**
	 * $PostTemplate
	 * @var mixed $PostTemplate Sets the individual post template
	 */
    public $PostTemplate;

	/**
	 * $GroupTemplate
	 * @var mixed $GroupTemplate Sets the group post template
	 */
    public $GroupTemplate;
	
	/**
	 * $GroupPostTemplate
	 * @var mixed $GroupPostTemplate Sets the individual group post template
	 */
    public $GroupPostTemplate;

    /**
     * $display
     * @var mixed $display Initializes the content variable
     */
    public $display = "";

    /**
     * Takes current files in the chosen directory and turns them into an output
     *
     * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
     * @return mixed|string
     */
    public function parseContent(){

        $images = new Images();

        $images->getContent();
        if(
            file_exists('themes/'.THEME.'/post.php') &&
            file_exists('themes/'.THEME.'/group.php') &&
            file_exists('themes/'.THEME.'/groupPost.php')
        ){
            $this->theme = true;
        }
        if($images->error == false){

            if($this->theme == true){
                $this->PostTemplate = file_get_contents('themes/'.THEME.'/post.php');
                $this->GroupTemplate = file_get_contents('themes/'.THEME.'/group.php');
                $this->GroupPostTemplate = file_get_contents('themes/'.THEME.'/groupPost.php');
            } else{
                $this->display .= "
    	     	<div class='note error'>
    	     	<h2>No Theme Exists</h2>
    	     	<p>Please check your config file.</p>
    	     	</div>";
                $this->error = true;
            }

            $i = 0;
            foreach($images->file_dates as $images->file_dates){
                $date = $images->file_dates;
                $j = $images->file_names_Array[$i];
                $file = $images->file_names[$j];
                $i++;
                $ext = strrchr($file, ".");
                $filename = $images->dir.$file;
                $date = date("d / n / y", $date);
                $name = basename($filename, $ext);
                $caption = str_replace("_", " ", $name);


                if(is_dir($images->dir.'/'.$file)){

                    if($this->theme == true){
                        $this->display .= $this->GroupTemplate;
                    } else{
                        $this->display .= "
            	     	<div class='note error'>
            	     	<h2>No Theme Exists</h2>
            	     	<p>Please check your config file.</p>
            	     	</div>";
                        $this->error = true;
                    }

                    $images->getGroupsContent($images->dir.'/'.$file);
                    $groupContent = "";
                    $g = 0;
                    foreach($images->group_dates as $images->group_dates){
                        $group_date = $images->group_dates;
                        $gj = $images->group_names_Array[$g];
                        $groupFile = $images->group_names[$gj];
                        $g++;

                        $ext = strrchr($groupFile, ".");
                        $group_filename = $images->dir.$file.'/'.$groupFile;
                        $group_date = date("d / n / y", $group_date);
                        $group_name = basename($group_filename, $ext);
                        $group_caption = str_replace("_", " ", $group_name);

                        $groupContent .= $this->addMarkup($group_name, $group_date, $group_filename, $group_caption, "groupContent");

                    }

                    $this->display = str_replace('[[slug]]', $name, $this->display);
                    $this->display = str_replace('[[content]]', $groupContent, $this->display);
                    $this->display = str_replace('[[type]]', "group", $this->display);
                    $this->display = str_replace('[[date]]', $date, $this->display);
                    $this->display = str_replace('[[caption]]', $caption, $this->display);
                    $this->display = str_replace('[[author]]', AUTHOR, $this->display);
                    $this->display = str_replace('[[url]]', URL, $this->display);
                    
                    unset($images->group_dates, $images->group_names_Array, $images->group_names, $groupContent);


                } else{
                    $this->display .= $this->addMarkup($name, $date, $filename, $caption, "photo");
                }

            } // End foreach
        } // End if
        if($images->error != true){
            return $this->display;
        } else{
            return $images->display;
        }
    }

    /**
     *
     * Creates HTML content
     *
     * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
     * @param string $name Name of the file
     * @param string $date Date of the file
     * @param string $filename Path of the file
     * @param string $caption Processed file name
     *
     */
    public function addMarkup($name, $date, $filename, $caption, $ptype){
		$postContent = "";
        if($ptype == "groupContent"){
            $postContent .= $this->GroupPostTemplate;
        } else{
            $postContent .= $this->PostTemplate;
        }
        
        $extention = $this->get_file_extension($filename);

        switch($extention)
        {
            case 'mp4':
                $content = '<video class="sublime" width="500px" height="400px" poster="video-poster.jpg" preload="none">
    	        <source src="'.$filename.'" />
    	      </video>';
                break;
            case 'video':
                $video_url = file_get_contents($filename, true);
                $type = $this->videoType($video_url);
                switch($type){
                    case "youtube":
                        $video_url = $this->convertYoutube($video_url);
                        if($video_url){
                            $content = '
                            <div class="video">
                                <iframe id="player" type="text/html" width="500px" height="400px" src="'.$video_url.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                            </div>
                            ';
                        }else{
                            $content = "<div class='note error'><h2>Invalid Youtube video.</h2></div>";
                        }
                        break;
                    case "vimeo":
                        $video_url = $this->convertVimeo($video_url);
                        if($video_url){
                            $content = '
                            <div class="video">
                                <iframe src="'.$video_url.'" width="500px" height="400px" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                            </div>
                            ';
                        }else{
                            $content = "<div class='note error'><h2>Invalid Vimeo video.</h2></div>";
                        }
                        break;
                    default:
                        $content = "<div class='note error'><h2>Video type not supported.</h2></div>";
                }
                break;
            case 'txt':
                $txt = file_get_contents($filename, true);
                $html = $this->convertMarkdown($txt);
                $content = '<div class="note">'.$html.'</div>';
                break;
            default:
                list($width, $height, $type, $attr) = getimagesize($filename);
                $content = '
    	      <div class="image">
    	      	<img class="lazy" src="img/grey.gif" width="'.$width.'px" height="'.$height.'px" data-original="'.$filename.'" alt="'.$caption.'"/>
    	      	<noscript>
    	      		<img src="'.$filename.'" width="'.$width.'px" height="'.$height.'px" alt="'.$caption.'"/>
    	      	</noscript>
    	      </div>
    	      ';
        }

        $postContent = str_replace('[[date]]', $date, $postContent);
        $postContent = str_replace('[[slug]]', $name, $postContent);
        $postContent = str_replace('[[type]]', $ptype, $postContent);
        $postContent = str_replace('[[caption]]', $caption, $postContent);
        $postContent = str_replace('[[content]]', $content, $postContent);
        $postContent = str_replace('[[author]]', AUTHOR, $postContent);
        $postContent = str_replace('[[url]]', URL, $postContent);
        
        return $postContent;
    }

    /**
     * Takes a filename e.g "image.jpg" and returns the extention.
     *
     * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
     * @param string $file_name The filename of which the extention is retrived.
     * @return string
     */
    public function get_file_extension($file_name){
        return substr(strrchr($file_name, '.'), 1);
    }

    /**
     * Takes a url and decides if its Youtube or Vimeo.
     *
     * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
     * @url http://stackoverflow.com/questions/6618967/php-how-to-check-whether-the-url-is-youtubes-or-vimeos
     * @param $url
     * @return string
     */
    public function videoType($url) {
        if (strpos($url, 'youtu') > 0) {
            return 'youtube';
        }elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }

    /**
     * Takes a Youtube URL and converts it into an embedable URL.
     *
     * @url https://gist.github.com/2217372
     * @author      Corey Ballou http://coreyballou.com
     * @copyright   (c) 2012 Skookum Digital Works http://skookum.com
     * @param $link
     * @return null|string
     */
    public function convertYoutube($link){
        $videoIdRegex = NULL;
        $video_str = NULL;
        $video_id = NULL;

        if (strpos($link, 'youtube.com') !== FALSE) {
            // works on:
            // http://www.youtube.com/embed/VIDEOID
            // http://www.youtube.com/embed/VIDEOID?modestbranding=1&amp;rel=0
            // http://www.youtube.com/v/VIDEO-ID?fs=1&amp;hl=en_US
            $videoIdRegex = '/youtube.com\/(?:embed|v){1}\/([a-zA-Z0-9_]+)\??/i';
        } else if (strpos($link, 'youtu.be') !== FALSE) {
            // works on:
            // http://youtu.be/daro6K6mym8
            $videoIdRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
        }

        if ($videoIdRegex !== NULL) {
            if (preg_match($videoIdRegex, $link, $results)) {
                $video_id = $results[1];
                $video_str = 'http://www.youtube.com/embed/$2?fs=1&rel=0&enablejsapi=1';
            }
        }

        $final_url = sprintf($video_str, $video_id);
        if($final_url){
            return $final_url;
        }else{
            //Fallback for default URL
            $link = preg_replace('/.+(\?|&)v=([a-zA-Z0-9]+).*/', 'https://www.youtube.com/embed/$2?fs=1&rel=0&enablejsapi=1', $link);
            return $link;
        }
    }

    /**
     * Takes a Vimeo URL and converts it into an embedable URL
     *
     * @url https://gist.github.com/2217372
     * @author      Corey Ballou http://coreyballou.com
     * @copyright   (c) 2012 Skookum Digital Works http://skookum.com
     * @param $link
     * @return null|string
     */
    public function convertVimeo($link){
        $videoIdRegex = NULL;
        $video_str = NULL;
        $video_id = NULL;

        if (strpos($link, 'player.vimeo.com') !== FALSE) {
            // works on:
            // http://player.vimeo.com/video/37985580?title=0&amp;byline=0&amp;portrait=0
            $videoIdRegex = '/player.vimeo.com\/video\/([0-9]+)\??/i';
        } else {
            // works on:
            // http://vimeo.com/37985580
            $videoIdRegex = '/vimeo.com\/([0-9]+)\??/i';
        }

        if ($videoIdRegex !== NULL) {
            if (preg_match($videoIdRegex, $link, $results)) {
                $video_id = $results[1];
                $video_str = 'http://player.vimeo.com/video/%s?byline=0&amp;portrait=0';
            }
        }

        return sprintf($video_str, $video_id);
    }

    /**
     * Converts the input into Markdown.
     *
     * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
     * @param string $input The string is is being converted to Markdown.
     * @return string
     */
    public function convertMarkdown($input){
        require_once "markdown.php";
        return Markdown($input);
    }

}

?>