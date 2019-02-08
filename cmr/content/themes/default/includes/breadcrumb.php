<?php
global $site;
global $session;
$routes = $session->Routes2;
#$routes = $site->Routes2;
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<!-- // <li class="breadcrumb-item active"><?php echo $site->path; ?></li> -->
	<li class="breadcrumb-item"><a href="<?php echo path_home; ?>"><?php echo title_md; ?></a></li>
	<li class="breadcrumb-item"><a href="#"><?php echo $site->module; ?></a></li>
	<li class="breadcrumb-item"><a href="#"><?php echo $site->section; ?></a></li>
	<?php 
		#echo json_encode($routes);
		
		foreach($routes as $k=>$v){
			if($v !== ''){
				echo "<li class=\"breadcrumb-item\"><a href=\"#\">{$v}</a></li>";
			}
		}
		if($site->id > 0){
			echo "<li class=\"breadcrumb-item active\">{$site->id}</li>";
		}
	?>
	<!-- // <li class="breadcrumb-item active"><?php echo $site->action; ?></li> -->
</ol>
