<?php

session_start();

include('config/database.php');
include('config/classes.php');
include('config/settings.php');

$session = new Session();
$site = $session->Route;

if($site->module !== 'login')
{
	#header("Location: /login");
	$site->module = 'login';
	$site->section = 'index';
	
	#exit('Redireccion Al Modulo: '.$site->module);
}else{
	#exit('Session Correcta');
}