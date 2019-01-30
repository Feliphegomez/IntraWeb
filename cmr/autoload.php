<?php
session_start();
include('config/database.php');
include('config/classes.php');
include('config/settings.php');

$session = new Session();
$site = $session->Route;
if($site->module !== 'login' && $session->id == 0)
{
	$site->module = 'login';
	$site->section = 'index';
}else{
	# echo ('Session Encontrada');
	# echo json_encode($session);
}