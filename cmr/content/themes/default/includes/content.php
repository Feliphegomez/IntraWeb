<?php
	global $session;
	global $site;
?>
<div id="content-wrapper">
	<div class="container-fluid">
		<?php $session->getBreadcrumbTheme(); ?>
		<?php $session->getBodyTheme(); ?>
	</div>
	<?php $session->getFooterTheme(); ?>
	<?php $session->getModalsTheme(); ?>
</div>