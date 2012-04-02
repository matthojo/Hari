<?php
/**
 * Install, index.php
 *
 * @author Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @copyright Matthew Harrison-Jones <contact@matthojo.co.uk>
 * @package Hari CMS
 * @license http://www.opensource.org/licenses/gpl-2.0.php
 */
$installed = false;
$error = false;
$error_message = "";
if(isset($_POST['setup'])){
    $website_name = $_POST['website_name'];
    $website_desc = $_POST['website_desc'];
    $author = $_POST['author'];
    $order = $_POST['order'];
    $FBID = $_POST['facebook'];
    $google = $_POST['google'];

    $config = '../config.php';

    if (file_exists($config)) {
        if(is_writable($config)){
            $config_file = file_get_contents($config);

            // Replace Title
            if($website_name != "") $config_file = str_replace('My Timeline', $website_name, $config_file);
            // Replace Description
            if($website_desc != "") $config_file = str_replace('WEBSITE DESCRIPTION GOES HERE', $website_desc, $config_file);
            // Replace Author
            if($author != "") $config_file = str_replace('WEBSITE AUTHOR GOES HERE', $author, $config_file);
            // Replace Post Order
            if($order != "") $config_file = str_replace("'desc'", "'".$order."'", $config_file);
            // Replace Facebook App ID
            if($FBID != "") $config_file = str_replace('XXXXXXXXXX', $FBID, $config_file);
            // Replace Google Analytics ID
            if($google != "") $config_file = str_replace('XXXXX-X', $google, $config_file);

            file_put_contents($config, $config_file);
            $installed = true;
            /*if(DEBUG){
                echo $website_name."\n";
                echo $website_desc."\n";
                echo $author."\n";
                echo $order."\n";
                echo $FBID."\n";
                echo $google."\n";
                echo $config_file;
            }*/
        }else{
            $error = true;
            $error_message = "CONFIG FILE NOT WRITABLE";
        }
    }else{
        $error = true;
        $error_message = "NO CONFIG FILE";
    }

}

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
    <?php
        if($installed){
            echo '
            <section class="modal" id="installed">
        <div class="modal-header">
            <h1>Website Installed Successfully</h1>
        </div>
        <div class="modal-body">
            <p>Now all you need to do it:</p>
            <ul>
                <li> Delete the "install" folder. Just for safety.</li>
                <li> Drag some images / .txt / .video (See below) files into the "display" folder.</li>
                <li> The post title is based on the filename, so, "this_is_an_image.jpg" turns into "This Is An Image".</li>
                <li> Thats it.</li>
            </ul>
        </div>
            <div class="modal-footer">
            </div>
    </section>
            ';
        }elseif($error){
            echo '
            <section class="modal" id="installed">
        <div class="modal-header">
            <h1>There Was An Error During The Installation</h1>
        </div>
        <div class="modal-body">
            <p>Error message: '.$error_message.'</p>
        </div>
            <div class="modal-footer">
            </div>
    </section>
            ';
        }
    ?>
    <?php if(!$error && !$installed): ?>
    <ul class="breadcrumb">
        <li class="active">
            <a href="#stage1">Website Details</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#stage2">Content Details</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#stage3">Extras</a>
        </li>
    </ul>
    <form class="setup-form form-horizontal" method="post" action="">
    <section class="modal stage" id="stage1">
        <div class="modal-header">
            <h1>Website Details</h1>
        </div>
        <div class="modal-body">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="input01">Website Title</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input01" name="website_name">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input02">Website Description</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input02" name="website_desc">
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
            <h1>Content Details</h1>
        </div>
        <div class="modal-body">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="input03">Author Name</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input03" name="author">
                    </div>
                </div>
                <div class="control-group">
                    <p class="control-label">Post Order</p>
                    <div class="controls">
                        <label class="radio">
                            <input type="radio" value="asc" name="order" /> Ascending (Oldest First / On top)
                        </label>
                        <label class="radio">
                            <input type="radio" value="desc" name="order" checked="1"/> Descending (Newest First / On top)
                        </label>
                    </div>
                </div>
            </fieldset>
        </div>
            <div class="modal-footer">
                <a href="#stage1" class="btn btn-primary btn-large next pull-left">Back</a>
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
                    <label class="control-label" for="input04">Facebook AppID</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="input04" name="facebook">
                        <p class="help-block">View your Facebook app IDs at <a href="https://developers.facebook.com/" title="Facebook Developers">https://developers.facebook.com/</a>.</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input05">Google Analytics Site ID</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on">UA-</span><input class="input-large" id="input05" size="16" type="text" name="google">
                        </div>
                        <p class="help-block">Do NOT include the beginning 'UA-'.</p>
                    </div>
                </div>
            </fieldset>
        </div>
            <div class="modal-footer">
                <a href="#stage2" class="btn btn-primary btn-large next pull-left">Back</a>
                <input type="submit" class="btn btn-success btn-large finish" data-loading-text="Setting up...." value="Setup" name="setup"/>
            </div>
    </section>
    </form>
    <?php endif; ?>

</div>
<!-- JavaScript at the bottom for fast page loading -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="js/bootstrap-button.js"></script>

<script>
    $(function() {
        if(window.location.hash == ""){
            window.location = '#stage1';
        }else{
            $(".breadcrumb li a").each(function () {
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
                $(".breadcrumb li a").each(function () {
                    if ($(this).attr("href") == stage) {
                        $(".breadcrumb .active").removeClass("active");
                        $(this).parent().addClass("active");
                    }
                });

            }
        );
        $(".finish").on("click", function(){
                $(this).button('loading');
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