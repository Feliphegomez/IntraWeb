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
	 
	function __construct($get_params = false) {
		$this->get_params = $get_params;
		
		$method = $_SERVER['REQUEST_METHOD'];
		$path = $_SERVER['REQUEST_URI'];
		$this->path = $path;
		
		switch($method){
			case 'POST':
				$this->method = $method;
				$this->action = 'Edit';
				break;
			case 'PUT':
				$this->method = $method;
				$this->action = 'Create';
				break;
			case 'DELETE':
				$this->method = $method;
				$this->action = 'Delete';
				break;
			case 'GET':
				$this->method = $method;
				$this->action = 'View';
				break;
			default:
				header('HTTP/1.1 405 Method not allowed');
				header('Allow: GET, PUT, POST, DELETE');
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
		foreach($this->routes as $k=>$v){
			if($v !== ''){
				$temp[$k] = $v;
			}
		}
		if(isset($temp[1]) && $temp[1] == $this->module){ unset($temp[1]); }
		if(isset($temp[2]) && $temp[2] == $this->section){ unset($temp[2]); }
		$temp = array_values($temp);
		echo json_encode($temp); //
		
		$arrayTotal = count($temp) - 1;
		if(count($temp) > 0 && $this->id > 0){
			unset($temp[$arrayTotal]);
		}
		
		$this->routes = $temp;
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
}

class DataBase
{
	var $conn = null;
	var $query = null;
	var $result = null;
	
	function __construct()
	{
	}
	
	function setQuery($query)
	{
		$this->query = $query;
		$this->Run();
		
	}
	
	function getResult()
	{
		return ($this->result);
	}
	function getResultJSON()
	{
		return json_encode($this->result);
	}
	
	function Run()
	{
		try {
			$this->conn = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $this->conn->prepare($this->query);
			$stmt->execute();
			// set the resulting array to associative
			$result = $stmt->setFetchMode(PDO::FETCH_OBJECT); 
			$this->result = new RecursiveArrayIterator($stmt->fetchAll());
		}
		catch(PDOException $e) {
			$this->result = "Error: " . $e->getMessage();
		}
		$this->conn = null;
	}
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
	}
}

class UrlRedirects {
  var $id, $short, $url, $created_at;
   
   function __construct()
   {}

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		#$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT * FROM `url_redirects` WHERE id=?');
		$stmt->execute([$id]);
		return $stmt->fetchObject(__CLASS__);
   }
}

class User {
  var $id, $username, $permissions;
   
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
   
   function setData($data){
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
