<body>
<div id="main">
	<div id="header">
		<h1 class="title"><?php echo TITLE; ?></h1>
	</div>
    <div class="content_hold">
    	<?php
    		display_content();
    	?>
    </div>
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