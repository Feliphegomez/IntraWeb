<?php

class infoUser
{
	var $id = 0;
	var $name = 'guest';
	var $surname = 'guest';
	
}

class Session
{
	var $isLogin = null;
	var $id = null;
	var $username = null;
	var $token = null;
	var $infoUser = null;
	
	function __construct()
	{
		$this->isLogin = false;
		$this->id = 0;
		$this->username = 'guest';
		$this->infoUser = new infoUser();
	}
}