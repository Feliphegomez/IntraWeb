<?php
class Route {
	private $basepath;
	private $uri;
	private $base_url;
	private $routes;
	private $route;
	private $params;
	private $get_params;
	var $method, $path;
	var $module = 'dashboard';
	var $section = 'index';
	var $id = 0;
	var $action = null;
	var $id_route = 0;
	var $enable = false;
	var $fields = null;
	 
	function __construct($get_params = false)
	{
		$this->get_params = $get_params;
		
		$method = $_SERVER['REQUEST_METHOD'];
		$path = $_SERVER['REQUEST_URI'];
		$this->path = $path;
		
		switch($method){
			case 'POST':
				$this->method = $method;
				$this->action = 'change';
				$this->fields = $this->repairFields();
				break;
			case 'PUT':
				$this->method = $method;
				$this->action = 'create';
				$this->fields = $this->repairFields();
				break;
			case 'DELETE':
				$this->method = $method;
				$this->action = 'delete';
				break;
			case 'GET':
				$this->method = $method;
				$this->action = 'view';
				break;
			default:
				header('HTTP/1.1 405 Method not allowed');
				header('Allow: GET, PUT, POST, DELETE');
				break;
		}
	}
	
	public function repairFields()
	{
		$r = array();
		switch($this->method){
			case 'POST':
				if(isset($_POST['url'])){ unset($_POST['url']); }
				$r = ($_POST);
				$_POST = null;
				return $r;
				break;
			case 'PUT':
				if(isset($_PUT['url'])){ unset($_PUT['url']); }
				$r = ($_PUT);
				$_PUT = null;
				return $r;
				break;
			case 'DELETE':
				if(isset($_DELETE['url'])){ unset($_DELETE['url']); }
				$r = ($_DELETE);
				$_DELETE = null;
				return $r;
				break;
			case 'GET':
				if(isset($_GET['url'])){ unset($_GET['url']); }
				$r = ($_GET);
				$_GET = null;
				return $r;
				break;
			default:
				return $r;
				break;
		}
	}
	 
	public function getRoutes()
	{
		$this->base_url = $this->getCurrentUri();
		$this->routes = explode('/', $this->base_url);
		 
		$this->getParams(); //invocamos el neuvo método
		if(isset($this->routes[1]) && $this->routes[1] !== ''){ $this->module = $this->routes[1];
		};
		if(isset($this->routes[2])){ $this->section = $this->routes[2]; };
		if(isset($this->routes[3])){
			$temp = array_reverse($this->routes);
			$this->id = (int) $temp[0];
		};
		
		$temp = array();
		foreach($this->routes as $k=>$v){ if($v !== ''){ $temp[$k] = $v; } };
		if(isset($temp[1]) && $temp[1] == $this->module){ unset($temp[1]); };
		if(isset($temp[2]) && $temp[2] == $this->section){ unset($temp[2]); };
		$temp = array_values($temp);
		
		$arrayTotal = count($temp) - 1;
		if(count($temp) > 0 && $this->id > 0){ unset($temp[$arrayTotal]); }
		
		$this->routes = $temp;
		$this->validateRoute();
		return $this->routes;
	}
	 
	private function getCurrentUri()
	{
		$this->basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$this->uri = substr($_SERVER['REQUEST_URI'], strlen($this->basepath));
		 
		if($this->get_params)
		{
		$this->getParams();
		}else{
		if (strstr($this->uri, '?')) $this->uri = substr($this->uri, 0, strpos($this->uri, '?'));
		}
		 
		$this->uri = '/' . trim($this->uri, '/');
		return $this->uri;
	}
	 
	private function getParams()
	{
		if (strstr($this->uri, '?'))
		{
			$params = explode("?", $this->uri);
			$params = $params[1];
			parse_str($params, $this->params);
			$this->routes[0] = $this->params;
			array_pop($this->routes);
		}
	}

	function validateRoute()
	{
		try {
			$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare("SELECT * FROM `url_redirects` 
			WHERE `url` IN ('{$this->path}') 
			AND `module` IN ('{$this->module}') 
			AND `section` IN ('{$this->section}') 
			LIMIT 1");
			$stmt->execute();
			$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
			if(isset($result[0])){
				$resultOne = (object) $result[0];
				$this->enable = true;
				$this->id_route = $resultOne->id;
				# ($resultOne);
				# echo json_encode($resultOne);
			}else{
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $pdo->prepare("SELECT * FROM `url_redirects` 
				WHERE `url` IN ('{$this->path}') 
				LIMIT 1");
				$stmt->execute();
				$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
				if(isset($result[0])){
					$resultOne = (object) $result[0];
					$this->enable = true;
					$this->id_route = $resultOne->id;
					$this->module = $resultOne->module;
					$this->section = $resultOne->section;
					# ($resultOne);
					# echo json_encode($resultOne);
				}
			}
		}
		catch(PDOException $e) {
			// $this->result = "Error: " . $e->getMessage();
		}
		$this->conn = null;
	}
	
}

class User
{
  var $id, $username, $permissions, $names, $surname, $second_surname;
   
   function __construct()
   {}
   
   function __toString()
   {
	   #return ($this->username);
	   return "{$this->names} {$this->surname} {$this->second_surname}";
   }

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions` 
		FROM `users` 
		LEFT JOIN `permissions` ON `permissions`.id = `users`.`permissions`
		WHERE `users`.id=?');
		$stmt->execute([$id]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
			$this->setData($resultOne);
		}
   }

   function load_by_username($username)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions` 
		FROM `users` 
		LEFT JOIN `permissions` ON `permissions`.id = `users`.`permissions`
		WHERE `users`.username=?');
		$stmt->execute([$username]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
			$this->setData($resultOne);
		}
   }
   
   function setData($data)
   {
	   /*
		if(isset($data->permissions)){
			$data->permissions = json_decode($data->permissions);
		}
		$this->id = (int) $data->id;
		$this->username = $data->username;
		$this->permissions = $data->permissions;
		*/
		if(isset($data->permissions)){
			$data->permissions = json_decode($data->permissions);
		}
		foreach($data as $k=>$v)
		{
			$this->{$k} = $v;
		}
   }
   
   function getUser(){
	   return ($this);
   }
}

class Session extends User
{
	var $countRefresh = null;
	var $Route = null;
	var $id = 0;
	var $Routes2 = null;
	
	function __construct()
	{
		if (!isset($_SESSION['countRefresh'])) { $_SESSION['countRefresh'] = 0; } else { $_SESSION['countRefresh']++; }
		if (isset($_SESSION['id']) && $_SESSION['id'] > 0) { $_SESSION['id'] = (int) $_SESSION['id']; } else { $_SESSION['id'] = 0; }
		$this->countRefresh = $_SESSION['countRefresh'];
		$this->id = $_SESSION['id'];
		$this->Route = new Route();
		$this->Routes2 = $this->Route->getRoutes();
		
		if($this->id > 0){
			$this->load_by_id($this->id);
		}else{
			if(isset($this->Route->fields['inputNickLogin']) && isset($this->Route->fields['inputPasswordLogin']))
			{
				
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions` 
				FROM `users` 
				LEFT JOIN `permissions` ON `permissions`.`id` = `users`.`permissions`
				WHERE `users`.`username`=? AND `users`.`hash`=?');
				$stmt->execute([$this->Route->fields['inputNickLogin'],$this->Route->fields['inputPasswordLogin']]);
				$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
				if(isset($result[0])){
					$resultOne = (object) $result[0];
					$this->setData($resultOne);
					$this->saveSession();
				}
			}
		}
	}
	
	function saveSession()
	{
		$_SESSION['id'] = $this->id;
		$_SESSION['username'] = $this->username;
		$_SESSION['permissions'] = $this->permissions;
		$_SESSION['names'] = $this->names;
		$_SESSION['surname'] = $this->surname;
		$_SESSION['second_surname'] = $this->second_surname;
		$_SESSION['hash'] = $this->hash;
	}
	
	function destroySession()
	{
		// remove all session variables
		session_unset();
		// destroy the session 
		session_destroy();
		echo '<meta http-equiv="refresh" content="0; url='.path_home.'" />';
	}
}

