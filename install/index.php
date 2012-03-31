<?php
/**
 * Install, index.php
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @copyright Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @package Hari CMS
 * @license http://www.opensource.org/licenses/gpl-2.0.php
 */



?>

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->

<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
 More info: h5bp.com/b/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Hari CMS Install</title>
    <meta name="generator" content="Hari's CMS" />

    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <ul class="breadcrumb">
        <li class="active">
            <a href="#stage1">Website Details</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#stage2">Author Details</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#stage3">Extras</a>
        </li>
    </ul>
    <form class="setup-form form-horizontal">
    <section class="modal stage" id="stage1">
        <div class="modal-header">
            <h1>Website Details</h1>
        </div>
        <div class="modal-body">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="input01">Website Title</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input01">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">Website Description</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input02">
                    </div>
                </div>
            </fieldset>
        </div>
            <div class="modal-footer">
                <a href="#stage2" class="btn btn-primary btn-large next">Next</a>
            </div>
    </section>

    <section class="modal stage" id="stage2">
        <div class="modal-header">
            <h1>Author Details</h1>
        </div>
        <div class="modal-body">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="input01">Author Name</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input03">
                    </div>
                </div>
            </fieldset>
        </div>
            <div class="modal-footer">
                <a href="#stage3" class="btn btn-primary btn-large next">Next</a>
            </div>
    </section>

    <section class="modal stage" id="stage3">
        <div class="modal-header">
            <h1>Extras</h1>
        </div>
        <div class="modal-body">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="input01">Facebook AppID</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input04">
                        <p class="help-block">Change to your Facebook app ID (<a href="https://developers.facebook.com/" title="Facebook Developers">https://developers.facebook.com/</a>)</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input01">Google Analytics Site ID</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input05">
                        <p class="help-block">Do NOT include the beginning 'UA-'.</p>
                    </div>
                </div>
            </fieldset>
        </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-success btn-large finish">Setup</a>
            </div>
    </section>
    </form>
</div>
</body>
<!-- JavaScript at the bottom for fast page loading -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script>
    $(function() {
        if(window.location.hash == ""){
            window.location = '#stage1';
        }else{
            $(".breadcrumb li a").each(function (i) {
                if ($(this).attr("href") == window.location.hash) {
                    $(".breadcrumb .active").removeClass("active");
                    $(this).parent().addClass("active");
                }
            });
        }
        $(".breadcrumb li").on("click", function(){
                $(".breadcrumb .active").removeClass("active");
                $(this).addClass("active");
            }
        );

        $(".next").on("click", function(){
                var stage = $(this).attr("href");

                $(".breadcrumb li a").each(function (i) {
                    if ($(this).attr("href") == stage) {
                        $(".breadcrumb .active").removeClass("active");
                        $(this).parent().addClass("active");
                    }
                });

            }
        );
    });
</script>

<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7 ]>
<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
<script defer>window.attachEvent('onload', function () {
    CFInstall.check({mode:'overlay'})
})</script>
<![endif]-->

</body>
</html>