<?php
$site = new Route();
$routes = $site->getRoutes();
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><?php echo $site->path; ?></li>
	<li class="breadcrumb-item active"><?php echo $site->action; ?></li>
	<li class="breadcrumb-item"><a href="#"><?php echo $site->module; ?></a></li>
	<li class="breadcrumb-item"><a href="#"><?php echo $site->section; ?></a></li>
	<?php 
		foreach($routes as $k=>$v){
			if($v !== ''){
				echo "<li class=\"breadcrumb-item\"><a href=\"#\">{$v}</a></li>";
			}
		}
	?>
	<?php if($site->id > 0){
		echo "<li class=\"breadcrumb-item active\">{$site->id}</li>";
	} ?>
</ol>