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
	$picture = new Picture();
	$picture->load_by_id($site->id);

	$picture->data = $picture->data;
	$pictureData = @explode('data:', $picture->data);
	
	$Base64Img = '';
	if(isset($pictureData[1])){
		$Base64Img = new stdClass();
		$Base64Img->type = "image\/none";
		$Base64Img->data = "";
		
		$Base64ImgTemp = @explode(';base64,', $pictureData[1]);
		
		if(isset($Base64ImgTemp[0]) && isset($Base64ImgTemp[1]))
		{
			$Base64Img->type = ($Base64ImgTemp[0]);
			$Base64Img->data = ($Base64ImgTemp[1]);
			
			# echo json_encode($Base64Img);
			#echo "<img src=\"{$picture->data}\" style=\"/* height: calc(100vh); */ width: calc(100vw);\" />";
			
			$data = $Base64Img->data;
			$data = base64_decode($data);
			$im = ImageCreateFromString($data);
			if ($im !== false) {
				header('Content-Type: image/png');
				
				if(isset($site->fields['w']) && $site->fields['w'] == 'original'){
					imagepng($im);
					imagedestroy($im);
				} else if(!isset($site->fields['thumb']) || $site->fields['thumb'] == false){
					$height = true;
					$width = 150;
					if(isset($site->fields['w']) && $site->fields['w'] > 0){ $width = (int) $site->fields['w']; }
					$height = $height === true ? (ImageSY($im) * $width / ImageSX($im)) : $height;
					$output = ImageCreateTrueColor($width, $height);
					ImageCopyResampled($output, $im, 0, 0, 0, 0, $width, $height, ImageSX($im), ImageSY($im));
					ImageJPEG($output, $picture->name, 95);
					imagepng($output);
				} else{
					imagepng($im);
					imagedestroy($im);
				}
			}
			else {
				echo 'Ocurrió un error.';
			}
			
			/*
			
			$imageData = ((base64_decode($Base64Img->data)));
			$source = imagecreatefromstring($imageData);
			
			switch($Base64Img->type)
			{
				case 'gif':
					echo 'gif';
					break;
				case 'png':
					echo 'png';
					break;
				case 'jpg' || 'jpeg':
						header("Content-type: image/jpeg");
						#echo 'jpg';
						
						$source = imagecreatefromjpeg("data://image/jpeg;base64,".$Base64Img->data);
						#imagedestroy($source);
						#$source2 = imagejpeg(base64_decode($source));
						#imagedestroy($source2);
					break;
				default:
					break;
			}*/
			
			
			
			
			/*
			if($Base64Img->type == 'gif'){
				header("Content-type: image/gif");
				//$source = imagecreatefromgif("data://image/gif;base64,".$Base64Img);
				$source = imagegif($source);
			}
			else if($Base64Img->type == 'png'){
				header("Content-type: image/png");
				$source = imagecreatefrompng("data://image/".$TypeImg.";base64,".$Base64Img);
				
				imageAlphaBlending($source, true);
				imageSaveAlpha($source, true);
				$source = imagepng($source);
			}
			else if($Base64Img->type == 'jpg' || $Base64Img->type == 'jpeg'){
				#$source = imagecreatefromjpeg("data://image/jpeg;base64:".$Base64Img);
				header("Content-type: image/jpeg");
			}
			*/
		}
		else
		{
			exit('_docs/images/sorry-image-not-available.jpg');
		}
	}
		
		
	
	
	exit('');
	if($picture->id > 0)
	{
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
		
		$imageData = (base64_decode(utf8_decode($Base64Img)));
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
