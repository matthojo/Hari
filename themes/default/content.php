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
<div id="my-modal" class="modal hide fade">
    <div class="modal-header">
        <a href="#" class="close">&times;</a>
        <h3></h3>
    </div>
    <div class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer"></div>
</div>
<div class="clearfix"></div>

<footer>
    &copy; <?php echo date('Y')." ".AUTHOR; ?>. Powered by <a href="https://github.com/matthojo/Hari-s-CMS"
                                                              title="Hari's CMS">Hari's CMS</a>.
</footer>