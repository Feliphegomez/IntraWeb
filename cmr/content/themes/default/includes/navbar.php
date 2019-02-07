<?php global $session; ?>
<?php global $site; ?>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
	<a class="navbar-brand mr-1" href="<?php echo path_home; ?>"><?php echo title_sm; ?></a>
	<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
		<i class="fas fa-bars"></i>
	</button>
	<?php $session->itemsNavbarTheme(); ?>
	
</nav>