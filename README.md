# Hari CMS #

## Authors

* Matthew Harrison-Jones ([@matt_hojo](http://twitter.com/matt_hojo))

## Features

* Easy install
* No database
* Supports
	* Images
	* Plain Text
	* Markdown
	* Youtube and Vimeo Videos
	* Local Video [Coming Soon]
* Groups
* Themes
* Plugins
	

## Description

This is just a small CMS powered by a single folder. No database is required. 
All you do is drag and drop images / text files into the directory you choose, and that's it. Text posts can include Markdown too.
An example can be found at [Hari's Timeline](http://hari.matthojo.co.uk/).

## Installation

* Copy the programme to your websites directory.
* Go to the URL of your website with /install e.g `examle.com/install/`
* Use the installation file to set the right website settings.
* Delete the 'intall' folder. Just for safety.
* Drag some images / .txt / .video (See below) files into the 'display' folder.
* The post title is based on the filename, so, "this_is_an_image.jpg" turns into "This Is An Image".
* Thats it.

### NOTE
For the install script to work the `config.php` must have have `777` chmod permissions set.

### Advanced Settings
To change more advanced settings, such as the folder that holds posts, edit the `config.php` file.


### Adding Videos From Online Servies

To add videos from online services place the video url in a file with the extension `.video`.

Currently supports these video services;

* Youtube
* Vimeo

### Groups
Adding groups is simple. All you need to do is create a subfolder in the 'display' folder. The group will be titled what ever the subfolder is called.
Adding supported files in the subfolder will add content to the group.

### Note
Files are ordered by modification date so if you change a file once its in the timeline, it will appear at the top.

## Themes
Content in themes is done by short codes, the following list is what each one means.

* The post content  = `[[content]]`
* The slug (name of the file with underscores) e.g "This_is_a_post" = `[[slug]]`
* The type of post, be it a group / photo (not properly finished yet) = `[[type]]`
* The date the post was added = `[[date]]`
* The title of the post (name of the file with underscores replaced with spaces) e.g "This is a post" = `[[caption]]`
* The Url of the website = `[[url]]`
* The author of the website = `[[author]]`

## Plugins
Plugins are currently in a very basic form.
To add a plugin, simply create a folder in the 'plugin' directory and link it to your theme via the following syntax.

`<?php echo PLUGINDIR; ?>/FOLDER/FILENAME`

As stated, this is currently in a very primitive form and it will be improved. At the moment it just stops duplicated files across themes.

## License

### Actual Programme

* Everything but the components below: [GPL 2.0](http://www.opensource.org/licenses/gpl-2.0.php)

### Components:

* jQuery: MIT/GPL license
* Modernizr: MIT/BSD license
* Lazy Load: MIT
* Markdown: BSD
	* PHP Markdown: GPLv2

## Credits

* [HTML5 Boilerplate](http://html5boilerplate.com/)