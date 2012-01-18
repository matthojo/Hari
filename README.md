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
	* Video [Coming Soon]
* Themes
	

## Description

This is just a small CMS powered by a single folder. No database is required. 
All you do is drag and drop images / text files into the directory you choose, and that's it. Text posts can include Markdown too.
An example can be found at [Hari's Timeline](http://hari.matthojo.co.uk/).

## Installation

* Copy the programme to your websites directory.
* Edit the config.php file so the author and other settings are correct to you.
* Drag some images / .txt files into the 'display' folder or the folder you have set in the config.php folder.
* The post title is based on the filename, so, "this_is_an_image.jpg" turns into "This Is An Image".
* Thats it.

###Note
Files are ordered by modification date so if you change a file once its in the timeline, it will appear at the top.

## Themes
Content in themes is done by short codes, the following list is what each one means.

	* The post content  = `[[content]]`
	* The slug (name of the file with underscores) e.g "This_is_a_post" = `[[slug]]`
	* The type of post, be it a group / photo (not properly finished yet) = `[[type]]`
	* The date the post was added = `[[date]]`
	* The title of the post (name of the file with underscores replaced with spaces) e.g "This is a post" = `[[caption]]`
	* The Url of the website = `[[url]]`
	
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