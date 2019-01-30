<?php global $session; ?>
<!-- Sidebar -->
<ul class="sidebar navbar-nav toggled">
	<li class="nav-item active">
		<a class="nav-link" href="/index.html">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
	</li>
	<?php if($session->id > 0){ ?>
		<!--
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-fw fa-folder"></i>
				<span>Pages</span>
			</a>
			<div class="dropdown-menu" aria-labelledby="pagesDropdown">
			<h6 class="dropdown-header">Login Screens:</h6>
				<a class="dropdown-item" href="login.html">Login</a>
				<a class="dropdown-item" href="register.html">Register</a>
				<a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
				<div class="dropdown-divider"></div>
				<h6 class="dropdown-header">Other Pages:</h6>
				<a class="dropdown-item" href="blank.html">Blank Page</a>
			</div>
		</li>-->
		<li class="nav-item">
			<a class="nav-link" href="/charts.html">
				<i class="fas fa-fw fa-chart-area"></i>
				<span>Charts</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/tables.html">
				<i class="fas fa-fw fa-table"></i>
				<span>Tables</span>
			</a>
		</li>
		
		<?php 
			if(
				isset($session->permissions->users)
			){ 
		?>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-cog"></i>
					<span>Configuracion</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<!-- // <h6 class="dropdown-header">Usuarios:</h6> -->
					<a class="dropdown-item" href="/admin-users.html">Usuarios</a>
					<a class="dropdown-item" href="/forgot-password.html">Forgot Password</a>
					<div class="dropdown-divider"></div>
					<h6 class="dropdown-header">Other Pages:</h6>
					<a class="dropdown-item" href="/blank.html">Blank Page</a>
				</div>
			</li>
		<?php } ?>
	<?php } ?>
  </ul>
