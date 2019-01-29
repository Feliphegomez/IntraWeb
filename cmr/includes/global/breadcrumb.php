<?php
$site = new Route();
$routes = $site->getRoutes();

# echo $site->module;
# echo $site->section;
# echo $site->id;
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><?php echo $site->action; ?></li>
	<li class="breadcrumb-item"><a href="#"><?php echo $site->module; ?></a></li>
	<li class="breadcrumb-item"><a href="#"><?php echo $site->section; ?></a></li>
	<?php foreach($routes as $k=>$v){ ?>
		<li class="breadcrumb-item">
			<a href="#"><?php echo "{$v}"; ?></a>
		</li>
	<?php } ?>
	
	<?php if($site->id > 0){ ?>
		<li class="breadcrumb-item active"><?php echo $site->id; ?></li>
	<?php } ?>
		<li class="breadcrumb-item active"><?php echo $site->path; ?></li>
  </ol>