<?php

$site = new Route();
$routes = $site->getRoutes();
#echo json_encode($routes);

# Validar si existe en Route

if($site->id_route > 0 && $site->enable == true){
	$pageActive = "cmr/content/modules/{$site->module}/{$site->section}.php";
	if(file_exists($pageActive)){
		include($pageActive);
	}else{
		include("cmr/includes/errors/404.php");
	}
}else{
	include("cmr/includes/errors/404-Route.php");
}