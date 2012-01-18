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