<?php
global $site;

# Validar si existe en Route.
if($site->id_route > 0 && $site->enable == true){
	$pageActive = "cmr/content/modules/{$site->module}/{$site->section}.php";
	# Validar si existe la pagina en el modulo.
	if(file_exists($pageActive)){
		include($pageActive);
	}else{
		# Informar error de archivo no encontrado.
		include("cmr/includes/errors/404.php");
	}
}else{
	# Informar error de ruta no identificada.
	include("cmr/includes/errors/404-Route.php");
}