<?php
/**
* Images
*
* @author Matthew Harrison-Jones <contact@matthojo.co.uk>
* @copyright Matthew Harrison-Jones <contact@matthojo.co.uk>
* @package Hari CMS
* @license http://www.opensource.org/licenses/gpl-2.0.php
* @filesource
*/
class Images{

	/**
	* $dir
	* @var string $dir The destination of the content directory
	*/
	protected $dir;
	
	/**
	* $good_ext
	* @var array $good_ext An array of valid extentions
	*/
	protected $good_ext = array(".jpg", ".jpeg",".gif",".png",".txt");
	
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
    * __construct
    *
    * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
    * @param string $d This will force a specific directory rather than specified directory in config.php.
    */
    public function __construct($d=DIR) {
    	$this->dir = $d;
    }
    
    /**
    * Takes current files in the chosen directory and turns them into an output
    *
    * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
    * @return string
    */
    public function parseContent() {
    	$this->getImages();
    	$i = 0;
    	foreach($this->file_dates as $this->file_dates){
    		$date = $this->file_dates;
    		$j = $this->file_names_Array[$i];
    	    $file = $this->file_names[$j];
    	    $i++;
    	    
    	    $ext = strrchr($file,".");       
    	    $filename = $this->dir.$file;
    	    $date = date ("d / n / y", filemtime($filename));
    	    $name = basename($filename, $ext);
    	    $caption = str_replace("_", " ", $name); 
    	    $this->display .='<div class="photo" id="'.$name.'">';
    	    $this->display .='<span class="date">'.$date.'</span>
    	    ';
    	    
    	    $extention = $this->get_file_extension($filename);
    	    switch ($extention)
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
    	      $this->display .='
    	      
    	      <img class="lazy" src="img/grey.gif" data-original="'.$filename.'" alt="'.$caption.'"/>
    	      <noscript>
    	      	<img src="'.$filename.'" alt="'.$caption.'"/>
    	      </noscript>
    	      ';
    	    }
    	    $this->display .='
    	    	<span class="caption">'.$caption.'</span>
    	    	<div class="social"><div class="fb-like" data-href="http://hari.matthojo.co.uk/#'.$name.'" data-send="false" data-layout="button_count" data-width="40px" data-show-faces="false" data-font="arial"></div></div>
    	    	
    	    </div>';
    	    
    	}
    	
    	return $this->display;
    }
    
    /**
    * Retrieves list of content from chosen directory and sorts them into chronological order
    *
    * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
    */
	public function getImages(){
		
		if ($handle = opendir($this->dir)) {
			while (false!== ($file = readdir($handle))) {
				$ext = strrchr($file,".");
				//echo $ext."<br>";
					if(in_array($ext,$this->good_ext))
					{
						$currentModified = filectime($this->dir.$file);
						$this->file_names[] = $file;
						$this->file_dates[] = $currentModified;
					}
					
				}
				closedir($handle);
				
				switch (SORT) {
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
			    foreach ($this->file_names_Array as $idx => $name) $name=$this->file_names[$name];
			    $this->file_dates = array_merge($this->file_dates);
		}
		elseif(DEBUG)
		{
				$this->display .= "Directory does not exist!";
		}
	}
	
	/**
	* Takes a filename e.g "image.jpg" and returns the extention.
	*
	* @author Matthew Harrison-Jones <contact@matthojo.co.uk>
	* @param string $file_name The filename of which the extention is retrived.
	* @return string
	*/
	public function get_file_extension($file_name)
	{
	  return substr(strrchr($file_name,'.'),1);
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