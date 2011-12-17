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

?>
 
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo TITLE; ?></title>
  <meta name="description" content="">
  <meta name="author" content="Hari's CMS">

  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

  <link rel="stylesheet" href="css/style.css">
 
  <script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>
  <header>
  <h3>Tips:</h3>
  <ul>
  	<li>Hover over the post to see the date it was posted.</li>
  </ul>
  </header>  
  <div id="main">
    <div id="rule"></div>
  	<h1 class="title"><?php echo TITLE; ?></h1>
  		<?php
  			require_once('classes/view/display.class.php');
  			$display = new Display();
  			
  			$display->displayContent();
  		?>
  </div>
  	<div class="clearfix"></div>
  
  <footer>
	&copy; <?php echo date('Y')." ".AUTHOR; ?>. Powered by <a href="https://github.com/matthojo/Hari-s-CMS" title="Hari's CMS">Hari's CMS</a>.
  </footer>


  <!-- JavaScript at the bottom for fast page loading -->
	
  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

  <div id="fb-root"></div>
  <!-- Change 'XXXXXXXXXX' to your Facebook app ID (https://developers.facebook.com/)-->
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=XXXXXXXXXX";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <script src="js/libs/jquery.lazyload.min.js" type="text/javascript"></script>
  <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {          
            $("img.lazy").show().lazyload({
               effect : "fadeIn"
            });
        });
    </script>
  <!-- end scripts -->


  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
  <script>
    var _gaq=[['_setAccount','UA-XXXXXXX-XX'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

</body>
</html>
