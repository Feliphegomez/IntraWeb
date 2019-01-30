<?php
session_start();
include('config/database.php');
include('config/classes.php');
include('config/settings.php');

$session = new Session();
$site = $session->Route;



# IMAGENES
if($site->module == 'media' && $site->section == 'images' && isset($site->id))
{
	$site->id = (int) $site->id;
	$picture = new Picture($site);
	
	if($picture->id > 0)
	{
		#echo json_encode($picture);
		#echo '<br>';
		#exit('Cargando Imagen...');
		
		$Base64Img = $picture->data;
		$Base64Img = @explode('data:image/', $Base64Img);
		$Base64Img = @explode(';base64,',$Base64Img[1]);
		$TypeImg = ($Base64Img[0]);
		$Base64Img = ($Base64Img[1]);
		
		if(!isset($Base64Img[0]) || !isset($Base64Img[1])){
			$path = '_docs/images/sorry-image-not-available.jpg';
			exit('_docs/images/sorry-image-not-available.jpg');
		}
		
	
		if(!isset($data['out_type'])){ $data['out_type'] = $TypeImg; }
		elseif(isset($data['out_type']) && $data['out_type'] !== $TypeImg){ $data['out_type'] = $TypeImg; };
		
		$imageData = base64_decode($Base64Img);
		$source = imagecreatefromstring($imageData);
		
		if($data['out_type'] == 'gif'){
			header("Content-type: image/gif");
			//$source = imagecreatefromgif("data://image/gif;base64,".$Base64Img);
			$source = imagegif($source);
		}
		else if($data['out_type'] == 'png'){
			header("Content-type: image/png");
			$source = imagecreatefrompng("data://image/".$TypeImg.";base64,".$Base64Img);
			
			imageAlphaBlending($source, true);
			imageSaveAlpha($source, true);
			$source = imagepng($source);
		}
		else if($data['out_type'] == 'jpg' || $data['out_type'] == 'jpeg'){
			#$source = imagecreatefromjpeg("data://image/jpeg;base64:".$Base64Img);
			header("Content-type: image/jpeg");
			
			if(isset($data['thumb']) && $data['thumb'] == true){
			$source = imagecreatefromjpeg("data://image/".$TypeImg.";base64,".$Base64Img);
				
				if(isset($data['zoom']) && $data['zoom'] > 0){
					$porcentaje = $data['zoom'];
				}else{
					$porcentaje = 0.5;
				}
				
				$alto = ImageSY($source);
				$ancho = ImageSX($source);
											
				$nuevo_ancho = $ancho * $porcentaje;
				$nuevo_alto = $alto * $porcentaje;
				// Cargar
				$source = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
				$origen = imagecreatefromjpeg("data://image/".$TypeImg.";base64,".$Base64Img);
				// Cambiar el tamaño
				imagecopyresized($source, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
			}
			
			$source = imagejpeg($source);
		}
		imagedestroy($source);
	}
	exit();
}

# SESSION
if($site->module !== 'login' && $session->id == 0)
{
	$site->module = 'login';
	$site->section = 'index';
}else{
	# echo ('Session Encontrada');
	# echo json_encode($session);
}

include("cmr/content/themes/default/includes/template.php");
