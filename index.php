<?php

/**
 * index.php
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @copyright Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @package Hari CMS
 * @license http://www.opensource.org/licenses/gpl-2.0.php
 */
require_once('config.php');

// Start initialising actual content

include('themes/'.THEME.'/header.php');
include('themes/'.THEME.'/content.php');
include('themes/'.THEME.'/footer.php');


?>