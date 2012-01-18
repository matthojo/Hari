<?php
/**
 * functions.php
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @copyright Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @package Hari CMS
 * @license http://www.opensource.org/licenses/gpl-2.0.php
 */
 
require_once('classes/view/display.class.php');

function display_content(){
    $display = new Display();
    echo $display->parseContent();
}

?>