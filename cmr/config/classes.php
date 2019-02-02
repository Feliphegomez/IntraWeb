<?php
class Route 
{
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
	var $page_tite = null;
	 
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
				$this->fields = $this->repairFields();
				$this->action = 'delete';
				break;
			case 'GET':
				$this->method = $method;
				$this->fields = $this->repairFields();
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
			$this->id = $temp[0];
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
		$this->createTitlePage();
		
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
				try {
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
					}else{
						try {
							$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$stmt = $pdo->prepare("SELECT * FROM `url_redirects` 
							WHERE `module` IN ('{$this->module}') 
							AND `section` IN ('{$this->section}') 
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
						catch(PDOException $e) {
							// $this->result = "Error: " . $e->getMessage();
						}
					}
				}
				catch(PDOException $e) {
					// $this->result = "Error: " . $e->getMessage();
					
				}
			}
		}
		catch(PDOException $e) {
			// $this->result = "Error: " . $e->getMessage();
		}
		$this->conn = null;
	}
	
	function createTitlePage()
	{
		$this->page_tite = "{$this->section} - {$this->module}";
	}
		
	function getHeadGlobal()
	{
		require('cmr/includes/global/head.php');
	}
	function getScriptsGlobal()
	{
		require('cmr/includes/global/scripts.php');
	}
	
}

class BaseClass 
{
	var $id;

   function setData($data)
   {
		foreach($data as $k=>$v)
		{
			$this->{$k} = $v;
		}
   }
}

# ----------------- SESSION -----------------
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
	
	function dropdownUserNavbar()
	{
		?>
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-user-circle fa-fw"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="/users/profile/<?php echo $this->username; ?>">Mi Cuenta</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Opciones</a>
				<a class="dropdown-item" href="#">Historico de actividades</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar sesión</a>
			</div>
		</li>
		<?php 
	}
	
	function itemsNavbarTheme()
	{
		 ?>
		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/search" method="search">
			<!-- // Navbar Search 
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2">
				<div class="input-group-append">
					<button class="btn btn-primary" type="submit">
						<i class="fas fa-search"></i>
					</button>
				</div>
			</div>
			-->
		</form>
		<!-- Navbar USER LOGGIN -->
		<ul class="navbar-nav ml-auto ml-md-0">
			<?php $this->dropdownUserNavbar(); ?>
			
			<?php if($this->id > 0){ ?>
				<?php 
					if(
						isset($this->permissions->users)
					){ 
				?>
					<li class="nav-item dropdown no-arrow mx-1">
						<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-cogs"></i>
							<span class="badge badge-danger">Config</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
							<a class="dropdown-item" href="/users/admin.html">Usuarios</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>
				<?php } ?>
					<?php if(MODE_DEBUG == true){ ?>
					<li class="nav-item dropdown no-arrow mx-1">
						<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-fw fa-folder"></i>
							<span class="badge badge-danger">DEMO</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
							<a class="dropdown-item" href="/tables.html">
								<i class="fas fa-fw fa-table"></i>
								<span>Tables</span>
							</a>
							<a class="dropdown-item dropdown-menu-right" href="/charts.html">
								<i class="fas fa-fw fa-chart-area"></i>
								<span>Charts</span>
							</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>
				<?php } ?>
			<?php } ?>
		</ul>
		<?php 
	}
	
	function getHeadTheme()
	{
		require('cmr/content/themes/'.theme_active.'/includes/head.php');
	}
	
	function getScriptsTheme()
	{
		require('cmr/content/themes/'.theme_active.'/includes/scripts.php');
	}
	
	function getSidebarTheme()
	{
		if($this->id > 0){
			require('cmr/content/themes/'.theme_active.'/includes/sidebar.php');
		}
	}
	
	function getNavbarTheme()
	{
		if($this->id > 0){
			require('cmr/content/themes/'.theme_active.'/includes/navbar.php');
		}
	}
	
	function getBreadcrumbTheme()
	{
		if($this->id > 0){
			require('cmr/content/themes/'.theme_active.'/includes/breadcrumb.php');
		}
		
	}
	
	function getDebugBlock()
	{
		if(MODE_DEBUG == true){
			require('cmr/includes/global/debug.php');
		}
	}
	
	function getBodyTheme()
	{
		require('cmr/content/themes/'.theme_active.'/includes/body.php');
	}
	
	function getFooterTheme()
	{
		if($this->id > 0){
			require('cmr/content/themes/'.theme_active.'/includes/footer.php');
		}
	}
	
	function getModalsTheme()
	{
		require('cmr/content/themes/'.theme_active.'/includes/modals.php');
	}
	
	function getContentRoute()
	{
		require('cmr/content/themes/'.theme_active.'/includes/content.php');
	}
	
	function validatePermission($module, $permission)
	{
		if(isset($this->permissions->{$module}->$permission))
			{
				return (boolean) $this->permissions->{$module}->$permission;
			}
		else
			{
				return false;
			}
	}
	
}

# ----------------- USERS -----------------
class Users
{
	var $list = array();
	var $total = 0;
	
	function __construct()
	{
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions` 
		FROM `users` 
		LEFT JOIN `permissions` ON `permissions`.id = `users`.`permissions` 
		LIMIT 1000
		');
		$stmt->execute();
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		$temp =  array();
		$this->total = count($result);
		foreach($result as $item)
		{
			$temp[] = new User($item);
		}
		$this->list = $temp;
	}
}

class User
{
  var $id, $username, $permissions, $names, $surname, $second_surname, $mail, $phone, $mobile, $avatar;
  var $array_healthy = array("userData-id", "userData-username", "userData-names", "userData-surname", "userData-second_surname", "userData-phone", "userData-mobile", "userData-avatar", "userData-mail", "userData-hash", "userData-permissions");
  var $array_yummy = array("id", "username", "names", "surname", "second_surname", "phone", "mobile", "avatar", "mail", "hash", "permissions");
   
   function __construct($params=null)
   {
		if(isset($params->id) && $params->id > 0){
			$this->load_by_id($params->id);
		}
   }
   
   function __toString()
   {
	   #return ($this->username);
	   return "{$this->names} {$this->surname} {$this->second_surname}";
   }

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions`, `pictures`.`data` as `avatar_data`
		FROM `users` 
		LEFT JOIN `permissions` ON `permissions`.`id` = `users`.`permissions` 
		LEFT JOIN `pictures` ON `pictures`.`id` = `users`.`avatar`
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
		$stmt = $pdo->prepare('SELECT `users`.*, `permissions`.`data` as `permissions`, `pictures`.`data` as `avatar_data`
		FROM `users` 
		LEFT JOIN `permissions` ON `permissions`.id = `users`.`permissions` 
		LEFT JOIN `pictures` ON `pictures`.`id` = `users`.`avatar`
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
	
	function delete_by_id($id)
	{
		try {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "DELETE FROM `users` WHERE `users`.`id` IN ('{$id}')";
				$pdo->exec($sql);
				return true;
			}
		catch(PDOException $e)
			{
				return false;
			}
		$pdo = null;
	}
	
	function update_by_id($dataInput)
	{
		$dataRet = new stdClass();
		$dataArray = array();
		$healthy   = $this->array_healthy;
		$yummy   = $this->array_yummy;
		
		foreach($dataInput as $k => $v)
		{
			$newKey = str_replace($healthy, $yummy, $k);
			if(in_array($newKey, $yummy) == true)
			{
				$dataRet->{$newKey} = $v;
				$dataArray[] = " `{$newKey}`='{$v}' ";
			}
		}
		
		try 
		{
			if(isset($dataRet->id))
			{
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$sql = "UPDATE `users` SET ".implode(',', $dataArray)." WHERE `id`='{$dataRet->id}'";
							
				$stmt = $pdo->prepare($sql);
				$stmt->execute();
				echo "".$stmt->rowCount()." campos ACTUALIZADOS satisfactoriamente.";
			}else{
				echo "NO EXISTE ID DEL USUARIO";
			}
		}
		catch(PDOException $e)
		{
			echo $sql . "<br>" . $e->getMessage();
		}

		$conn = null;
	}
	
	function create($dataInput)
	{
		$dataRet = new stdClass();
		$dataArray = array();
		$dataFields = array();
		$healthy   = $this->array_healthy;
		$yummy   = $this->array_yummy;
		
		foreach($dataInput as $k => $v)
		{
			$newKey = str_replace($healthy, $yummy, $k);
			if(in_array($newKey, $yummy) == true)
			{
				$dataRet->{$newKey} = $v;
				$dataFields[] = " `{$newKey}` ";
				$dataArray[] = " '{$v}' ";
			}
		}
				
		try {
				$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO `users` (".implode(',', $dataFields).")
				VALUES (".implode(',', $dataArray).")";
				$pdo->exec($sql);
				echo "Nuevo registro creado exitosamente";
			}
		catch(PDOException $e)
			{
				#echo $sql . "<br>" . $e->getMessage();
				echo "<br>" . json_encode($e);
			}

		$pdo = null;
	}
}

# ----------------- PICTURES -----------------
class Picture extends BaseClass
{
  var $id, $data, $url_short, $url_large;
   
   function __construct($params=null)
   {
		if(isset($params->id) && $params->id > 0){
			$this->load_by_id($params->id);
		}
   }
   
   function __toString()
   {
	   return "{$this->url_large}";
   }

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `pictures`.*
		FROM `pictures` 
		WHERE `pictures`.`id` = ?');
		$stmt->execute([$id]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
			$this->setData($resultOne);
		}
   }
   
   function getPicture(){
	   return ($this);
   }
}

# ----------------- PERMISSIONS -----------------
class Permission extends BaseClass
{
  var $name, $data;
   
   function __construct($params=null)
   {
		if(isset($params->id) && $params->id > 0){
			$this->load_by_id($params->id);
		}
   }
   
   function __toString()
   {
	   return "{$this->name}";
   }

   function load_by_id($id)
   {
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `permissions`.*
		FROM `permissions` 
		WHERE `permissions`.`id` = ?');
		$stmt->execute([$id]);
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		if(isset($result[0])){
			$resultOne = (object) $result[0];
			$this->setData($resultOne);
		}
   }
}

class Permissions
{
	var $list = array();
	var $total = 0;
	
	function __construct()
	{
		$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare('SELECT `permissions`.* FROM `permissions` LIMIT 1000');
		$stmt->execute();
		$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
		$temp =  array();
		$this->total = count($result);
		foreach($result as $item)
		{
			$temp[] = new Permission($item);
		}
		$this->list = $temp;
	}
	
}

# PASAR -----------------------
function transalateLabelPermissions($label)
{
	switch ($label) {
		case 'view':
			return 'Ver';
			break;
		case 'change':
			return 'Modificar';
			break;
		case 'create':
			return 'Crear';
			break;
		case 'delete':
			return 'Eliminar';
			break;
		case 'users':
			return 'Usuarios';
			break;
	}

}
# PASAR -----------------------
function convertBooleanToIcon($valueBoolean)
{
	switch ($valueBoolean) {
		case '1':
			return '<i class="fa fa-check"></i>';
			break;
		case true:
			return '<i class="fa fa-check"></i>';
			break;
		case 'true':
			return '<i class="fa fa-check"></i>';
			break;
		case 'enabled':
			return '<i class="fa fa-check"></i>';
			break;
		case 'enable':
			return '<i class="fa fa-check"></i>';
			break;
			
		case '0':
			return '<i class="fa fa-ban"></i>';
			break;
		case 0:
			return '<i class="fa fa-ban"></i>';
			break;
		case false:
			return '<i class="fa fa-ban"></i>';
			break;
		case 'false':
			return '<i class="fa fa-ban"></i>';
			break;
		case 'disabled':
			return '<i class="fa fa-ban"></i>';
			break;
		case 'disable':
			return '<i class="fa fa-ban"></i>';
			break;
	}

}