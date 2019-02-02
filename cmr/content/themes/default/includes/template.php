<?php
	global $session;
	global $site;
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php $site->getHeadGlobal(); ?>
		<?php $session->getHeadTheme(); ?>
	</head>
	<body id="page-top" class="sidebar-toggled">
		<?php $session->getNavbarTheme(); ?>
		<div id="wrapper">
			<?php $session->getSidebarTheme(); ?>
			<?php $session->getContentRoute(); ?>
		</div>
		<?php $site->getScriptsGlobal(); ?>
		<?php $session->getScriptsTheme(); ?>
	</body>
</html>