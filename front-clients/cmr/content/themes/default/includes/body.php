<?php global $site; ?>
<?php global $session; ?>
<?php 
	$site->id = base64_decode($site->id);
?>
<div id="home" class="banner" data-blast="bgColor">
	<nav class="navbar fixed-top navbar-expand-lg navbar-light navbar-fixed-top">
		<div class="container">
			<h1 class="wthree-logo">
				<a href="index.html" id="logoLink" data-blast="color">Monteverde LTDA - Portal de Clientes</a>
			</h1>
			<div class="nav-item  position-relative">
				<a href="#menu" id="toggle">
					<span></span>
				</a>
				<div id="menu">
					<ul>
						<li><a data-blast="color" href="/front-clients/index.html">Inicio</a></li>
						<li><a data-blast="color" href="#contact" class="scroll">Contactar</a></li>
						
						<?php
							if($session->id > 0){
								echo "<li><a data-blast=\"color\" href=\"#services\" class=\"scroll\">Mis Empresas</a></li>";
								echo "<li><a data-blast=\"color\" href=\"/front-clients/out\">Salir</a></li>";
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	
	<?php
	if(isset($site->module) && $site->module == 'login' && isset($site->section) && $site->section == 'index' && $session->id == 0)
	{
			$pageActive = "cmr/content/modules/{$site->module}/{$site->section}.php";
			# Validar si existe la pagina en el modulo.
			if(file_exists($pageActive)){
				include($pageActive);
			}else{
				# Informar error de archivo no encontrado.
				include("cmr/includes/errors/404.php");
			}
	}
		?>
</div>
<br>
<br>
<br>
<?php
if(isset($site->module) && $site->module == 'login' && isset($site->section) && $site->section == 'index' && $session->id == 0)
{}
else
{
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
}
?>