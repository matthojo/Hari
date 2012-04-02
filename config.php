<?php

/**
 * config.php
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @copyright Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @package Hari CMS
 * @license http://www.opensource.org/licenses/gpl-2.0.php
 */

/**
 * DEBUG
 *
 * To debug or not to debug, that is the question.
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global boolean DEBUG Decides if debug options are enabled or not.
 */
define('DEBUG', true);

/**
 * TITLE
 *
 * The chosen title for the website
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string TITLE Sets the title of the website
 */
define('TITLE', "My Timeline");

/**
 * AUTHOR
 *
 * The author of the content of the website
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string AUTHOR Sets the author of the website
 */
define('AUTHOR', "WEBSITE AUTHOR GOES HERE");

/**
 * DESCRIPTION
 *
 * The description of the content of the website
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string DESCRIPTION Sets the description of the website
 */
define('DESCRIPTION', "WEBSITE DESCRIPTION GOES HERE");

/**
 * THEME
 *
 * The theme you wish your content will look like.
 * NOTE: The theme name is case sensitive.
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string THEME Sets the theme of the website
 */
define('THEME', 'default');

/**
 * FBID
 *
 * Your Facebook AppID
 * Change 'XXXXXXXXXX' to your Facebook app ID (https://developers.facebook.com/)
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string FBID Sets the Facebook AppID
 */
define('FBID', 'XXXXXXXXXX');

/**
 * GAID
 *
 * Your Google Analytics Site ID.
 * NOTE: Do NOT include the beginning 'UA-'.
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string GAID Sets the Google Analytics site ID
 */
define('GAID', 'XXXXX-X');

/**
 * URL
 *
 * The url of the website. Should be set automatically.
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string URL Set this to the root of your web directory.
 */
$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
define('URL', $url);


/**
 * DIR
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string DIR Defines the directory containing the content
 */
define('DIR', 'display/');

/**
 * PLUGINDIR
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string PLUGINDIR Difines the directory contiaining plugins
 */
define('PLUGINDIR', '/plugins');

/**
 * SORT
 * This should be ether 'desc' or 'asc', otherwise will default to 'desc'
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @global string SORT Sets which way content is display in order of time
 */
define('SORT', 'desc');

/*
* If debug is set to true, enabled the debug options
*
* @param boolean DEBUG This is set in config.php
* @author Matthew Harrison-Jones <contact@matthojo.co.uk>
*/
if(DEBUG){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}else{
    error_reporting(0);
    ini_set('display_errors', '0');
}

/**
 * Sets the default timezone.
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 */
date_default_timezone_set('GMT');

?>