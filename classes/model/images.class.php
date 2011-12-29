<?php

/**
 * Images
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @copyright Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @package Hari CMS
 * @license http://www.opensource.org/licenses/gpl-2.0.php
 */
class Images {

    /**
     * $dir
     * @var string $dir The destination of the content directory
     */
    protected $dir;

    /**
     * $good_ext
     * @var array $good_ext An array of valid extentions
     */
    protected $good_ext = array(".jpg", ".jpeg", ".gif", ".png", ".txt");

    /**
     * $display
     * @var mixed $display Initializes the content variable
     */
    protected $display = "";

    /**
     * $file_dates
     * @var array $file_dates Stores list of file dates
     */
    protected $file_dates;

    /**
     * $file_names_Array
     * @var array $file_names_Array This is uses to merge file dates and file names back together
     */
    protected $file_names_Array;

    /**
     * $file_names
     * @var array $file_names Stores list of file names
     */
    protected $file_names;

    /**
     * $group_dates
     * @var array $group_dates Stores list of file dates
     */
    protected $group_dates;

    /**
     * $group_names_Array
     * @var array $group_names_Array This is uses to merge file dates and file names back together
     */
    protected $group_names_Array;

    /**
     * $group_names
     * @var array $group_names Stores list of file names
     */
    protected $group_names;

    /**
     * $error
     * @var boolean $error Defines if there are errors in code.
     */
    protected $error = false;

    /**
     * __construct
     *
     * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
     * @param string $d This will force a specific directory rather than specified directory in config.php.
     */
    public function __construct($d = DIR){

        $this->dir = $d;

    }

    /**
     * Takes current files in the chosen directory and turns them into an output
     *
     * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
     * @return mixed|string
     */
    public function parseContent(){
        $this->getContent();
        if($this->error == false){
            $i = 0;
            foreach($this->file_dates as $this->file_dates){
                $date = $this->file_dates;
                $j = $this->file_names_Array[$i];
                $file = $this->file_names[$j];
                $i++;
                $ext = strrchr($file, ".");
                $filename = $this->dir.$file;
                $date = date("d / n / y", $date);
                $name = basename($filename, $ext);
                $caption = str_replace("_", " ", $name);


                if(is_dir($this->dir.'/'.$file)){
                    $this->display .= '<div class="group" id="'.$name.'">';
                    $this->display .= '
	    	    <span class="date">
	    	    	'.$date.'
	    	    	<span class="marker"></span>
	    	    </span>
	    	    <div class="social">
	    	    	        <!-- <div class="social-item"><div class="g-plusone" data-size="tall" data-href="'.URL.'#'.$name.'"></div></div>
	    	    	        <div class="social-item"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.URL.'#'.$name.'" data-count="vertical">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div> -->
                            <div class="social-item"><div class="fb-like" data-href="'.URL.'#'.$name.'" data-send="false" data-layout="box_count" data-width="55px" data-show-faces="false" data-font="arial"></div></div>

	    	    </div>
	    	    <div class="content">
	    	        <div class="listItems">
	    	    ';
                    $this->getGroupsContent($this->dir.'/'.$file);
                    $g = 0;
                    foreach($this->group_dates as $this->group_dates){

                        $group_date = $this->group_dates;
                        $gj = $this->group_names_Array[$g];
                        $groupFile = $this->group_names[$gj];
                        $g++;

                        $ext = strrchr($groupFile, ".");
                        $group_filename = $this->dir.$file.'/'.$groupFile;
                        $group_date = date("d / n / y", $group_date);
                        $group_name = basename($group_filename, $ext);
                        $group_caption = str_replace("_", " ", $group_name);

                        $this->addMarkup($group_name, $group_date, $group_filename, $group_caption, "groupContent");

                    }
                    unset($this->group_dates, $this->group_names_Array, $this->group_names);
                    $this->display .= '
                        </div>
	    	    	    <span class="caption">'.$caption.'<span class="arrow"></span></span>
	    	    	</div>
	    	    	</div>';
                } else{
                    $this->addMarkup($name, $date, $filename, $caption, "photo");
                }

            } // End foreach
        } // End if
        return $this->display;
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
        if($ptype == "photo"){
            $this->display .= '<div class="'.$ptype.'" id="'.$name.'">';
        }else{
            $this->display .= '<div class="'.$ptype.'" data-controls-modal="my-modal" data-backdrop="static" id="'.$name.'">';

        }

        if($ptype == "photo"){

            $this->display .= '
	    	    <span class="date">
	    	    	'.$date.'
	    	    	<span class="marker"></span>
	    	    </span>
	    	    <div class="social">
	    	    	        <!-- <div class="social-item"><div class="g-plusone" data-size="tall" data-href="'.URL.'#'.$name.'"></div></div>
	    	    	        <div class="social-item"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.URL.'#'.$name.'" data-count="vertical">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div> -->
                            <div class="social-item"><div class="fb-like" data-href="'.URL.'#'.$name.'" data-send="false" data-layout="box_count" data-width="55px" data-show-faces="false" data-font="arial"></div></div>

	    	    </div>
	    	    <div class="content">
	    	    ';
        }
        $extention = $this->get_file_extension($filename);

        switch($extention)
        {
            case 'mp4':
                $this->display .= '<video class="sublime" width="500px" height="400px" poster="video-poster.jpg" preload="none">
	    	        <source src="'.$filename.'" />
	    	      </video>';
                break;
            case 'txt':
                $txt = file_get_contents($filename, true);
                $html = $this->convertMarkdown($txt);
                $this->display .= '<div class="note">'.$html.'</div>';
                break;
            default:
                list($width, $height, $type, $attr) = getimagesize($filename);
                $this->display .= '
	    	      <div class="image">
	    	      	<img class="lazy" src="img/grey.gif" width="'.$width.'px" height="'.$height.'px" data-original="'.$filename.'" alt="'.$caption.'"/>
	    	      	<noscript>
	    	      		<img src="'.$filename.'" width="'.$width.'px" height="'.$height.'px" alt="'.$caption.'"/>
	    	      	</noscript>
	    	      </div>
	    	      ';
        }
        $this->display .= '<span class="caption">'.$caption.'<span class="arrow"></span></span>';
        if($ptype == "photo"){
            $this->display .= '
	    	    	</div>
	    	    	';
        }
        $this->display .= '</div>';
    }

    /**
     * Retrieves list of content from chosen directory and sorts them into chronological order
     *
     * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
     */
    public function getContent(){

        if($handle = opendir($this->dir)){
            while(false !== ($file = readdir($handle))){
                $ext = strtolower(strrchr($file, "."));
                //echo $ext."<br>";

                if(in_array($ext, $this->good_ext) || is_dir($this->dir.'/'.$file) && $file != "." && $file != ".."){
                    $currentModified = filectime($this->dir.$file);
                    $this->file_names[] = $file;
                    $this->file_dates[] = $currentModified;
                }

            }
            closedir($handle);
            if(!empty($this->file_names)){
                switch(SORT){
                    case 'desc':
                        arsort($this->file_dates);
                        break;
                    case 'asc':
                        asort($this->file_dates);
                        break;
                    default:
                        arsort($this->file_dates);
                }

                //Match file_names array to file_dates array
                $this->file_names_Array = array_keys($this->file_dates);
                foreach($this->file_names_Array as $idx => $name){
                    $name = $this->file_names[$name];
                }
                $this->file_dates = array_merge($this->file_dates);
            } else{
                $this->display .= "<div class='note error'><h2>Directory does not contain any posts.</h2></div>";
                $this->error = true;
            }
        }
        else
        {
            $this->display .= "
				<div class='note error'>
				<h2>Directory does not exist!</h2>
				<p>Please check your config file.</p>
				</div>";
            $this->error = true;
        }
    }

    /**
     * Retrieves list of content from specific directory and sorts it into chronological order
     *
     * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
     * @param string $getDir The directory to find content in
     */
    public function getGroupsContent($getDir){

        if($handle = opendir($getDir)){
            while(false !== ($file = readdir($handle))){
                $ext = strtolower(strrchr($file, "."));
                //echo $ext."<br>";

                if(in_array($ext, $this->good_ext)){
                    $currentModified = filectime($getDir.'/'.$file);
                    $this->group_names[] = $file;
                    $this->group_dates[] = $currentModified;
                }

            }
            closedir($handle);
            if(!empty($this->group_names)){
                switch(SORT){
                    case 'desc':
                        arsort($this->group_dates);
                        break;
                    case 'asc':
                        asort($this->group_dates);
                        break;
                    default:
                        arsort($this->group_dates);
                }

                //Match file_names array to file_dates array
                $this->group_names_Array = array_keys($this->group_dates);
                foreach($this->group_names_Array as $idx => $name){
                    $name = $this->group_names[$name];
                }
                $this->group_dates = array_merge($this->group_dates);

            } else{
                $this->display .= "<div class='note error'><h2>Directory does not contain any posts.</h2></div>";
                $this->error = true;
            }
        }
        else
        {
            $this->display .= "
				<div class='note error'>
				<h2>Directory does not exist!</h2>
				<p>Please check your config file.</p>
				</div>";
            $this->error = true;
        }
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