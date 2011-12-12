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
	
	public function displayContent() {
		$images = new Images();
		echo $images->parseContent();
	}
}

?>