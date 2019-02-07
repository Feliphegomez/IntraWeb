<?php global $session; ?>
<!-- Sidebar -->
<ul class="sidebar navbar-nav toggled">
	<li class="nav-item active">
		<a class="nav-link" href="/index.html">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
	</li>
	
	
	<li class="nav-item dropdown no-arrow mx-1">
		<a class="nav-link dropdown-toggle" href="#" id="businessSubdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-cog"></i>
			Options
			<span class="badge badge-danger">Business</span>
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="businessSubdropdown">
			<a class="dropdown-item" href="/business/arls/">ARL</a>
			<a class="dropdown-item" href="/business/eps/">EPS</a>
			<a class="dropdown-item" href="/business/types-identifications/">Tipos de Identificaciones</a>
			<a class="dropdown-item" href="/business/types-meditions/">Tipos de Medidas</a>
			<a class="dropdown-item" href="/business/types-societys/">Tipos de Sociedades</a>
			<a class="dropdown-item" href="/business/types-vehicles/">Tipos de Vehículos</a>
			<a class="dropdown-item" href="/business/types-fuels/">Tipos de Combustibles</a>
			<a class="dropdown-item" href="/business/types-clients/">Tipos de Clientes</a>
			<a class="dropdown-item" href="/business/types-bloods/">Tipos de Sangre</a>
			<div class="dropdown-divider"></div>
		</div>
	</li>
</ul>

