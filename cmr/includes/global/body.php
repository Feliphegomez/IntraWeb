<?php

$site = new Route();
$routes = $site->getRoutes();
#echo json_encode($routes);


$pageActive = "cmr/content/modules/{$site->module}/{$site->section}.php";
if(file_exists($pageActive)){
	include($pageActive);
}else{
	include("cmr/includes/errors/404.php");
}
