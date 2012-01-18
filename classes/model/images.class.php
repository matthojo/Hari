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
    public $dir;

    /**
     * $good_ext
     * @var array $good_ext An array of valid extentions
     */
    public $good_ext = array(".jpg", ".jpeg", ".gif", ".png", ".txt");

    /**
     * $display
     * @var mixed $display Initializes the content variable
     */
    public $display = "";

    /**
     * $file_dates
     * @var array $file_dates Stores list of file dates
     */
    public $file_dates;

    /**
     * $file_names_Array
     * @var array $file_names_Array This is uses to merge file dates and file names back together
     */
    public $file_names_Array;

    /**
     * $file_names
     * @var array $file_names Stores list of file names
     */
    public $file_names;

    /**
     * $group_dates
     * @var array $group_dates Stores list of file dates
     */
    public $group_dates;

    /**
     * $group_names_Array
     * @var array $group_names_Array This is uses to merge file dates and file names back together
     */
    public $group_names_Array;

    /**
     * $group_names
     * @var array $group_names Stores list of file names
     */
    public $group_names;

    /**
     * $error
     * @var boolean $error Defines if there are errors in code.
     */
    public $error = false;

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
}

?>