<!-- JavaScript at the bottom for fast page loading -->

<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

<!-- Google Plus button -->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
    {lang: 'en-GB', parsetags: 'explicit'}
</script>
<script type="text/javascript">gapi.plusone.go();</script>

<div id="fb-root"></div>
<!-- Change your Facebook app ID in config.php-->
<script>(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=<?php echo FBID; ?>";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script src="<?php echo PLUGINDIR; ?>/lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $("img.lazy").show().lazyload({
            effect:"fadeIn"
        });
    });
</script>
<script src="/js/libs/bootstrap-modal.js" type="text/javascript"></script>
<script>
    $('#my-modal').modal({
        keyboard: true
    });
    $('.groupContent').click(function () {
        var NAME = $(this).children(':last').text();
        var CONTENT = $(this).children(':first').html();
        $('#my-modal h3').text(NAME);
        $('#my-modal .modal-body').html(CONTENT);
    });
</script>
<!-- end scripts -->


<!-- Asynchronous Google Analytics snippet. Change the UA-XXXXX-X to be your site's ID in the config.php.
mathiasbynens.be/notes/async-analytics-snippet -->
<script>
    var _gaq = [
        ['_setAccount', 'UA-<?php echo GAID; ?>'],
        ['_trackPageview']
    ];
    (function (d, t) {
        var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
        g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g, s)
    }(document, 'script'));
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