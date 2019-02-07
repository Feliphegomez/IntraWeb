<?php global $session; ?>
<!-- Sidebar -->
<ul class="sidebar navbar-nav toggled">
	<li class="nav-item active_not">
		<a class="nav-link" href="/index.html">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span>
		</a>
	</li>
	
	<li class="nav-item dropdown no-arrow mx-1">
		<a class="nav-link dropdown-toggle" href="#" id="businessSubdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-building"></i>
			<span>Mi Empresa</span>
			<span class="badge badge-danger">Business</span>
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="businessSubdropdown">
			<a class="dropdown-item" href="/business/contacts/">Contactos</a>
			<a class="dropdown-item" href="/business/services/">Servicios</a>
			<a class="dropdown-item" href="/business/vehicles/">Vehículos</a>
			<div class="dropdown-divider"></div>
		</div>
	</li>
	
	<li class="nav-item dropdown no-arrow mx-1">
		<a class="nav-link dropdown-toggle" href="#" id="servicesSubdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-cog"></i>
			<span>Servicios</span>
			<!-- // <span class="badge badge-danger"></span> -->
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="servicesSubdropdown">
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/business/status-services/">Estados de Servicios</a>
		</div>
	</li>
	
	<li class="nav-item dropdown no-arrow mx-1">
		<a class="nav-link dropdown-toggle" href="#" id="locationsSubdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-cog"></i>
			<span>Geo-Referencias</span>
			<!-- // <span class="badge badge-danger"></span> -->
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="locationsSubdropdown">
			<a class="dropdown-item" href="/business/geo-citys/">Ciudades</a>
			<a class="dropdown-item" href="/business/geo-departments/">Departamentos</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/business/types-meditions/">Tipos de Medidas</a>
		</div>
	</li>
	
	<li class="nav-item dropdown no-arrow mx-1">
		<a class="nav-link dropdown-toggle" href="#" id="locationsSubdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-cog"></i>
			<span>Colaboradores</span>
			<!-- // <span class="badge badge-danger"></span> -->
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="locationsSubdropdown">
			<a class="dropdown-item" href="/business/arls/">ARL</a>
			<a class="dropdown-item" href="/business/eps/">EPS</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/business/funds-compensations/">Cajas de compensacion</a>
			<a class="dropdown-item" href="/business/funds-pensions/">Fondos de Penciones</a>
			<a class="dropdown-item" href="/business/funds-severances/">Fondos de Cesantias</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/business/status-employees/">Estados de Empleados</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/business/actions-performances-employees/">Acciones de Desempeño</a>
			<a class="dropdown-item" href="/business/reasons-performances-employees/">Motivos de Desempeño</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/business/types-identifications/">Tipos de Identificaciones</a>
			<a class="dropdown-item" href="/business/types-bloods/">Tipos de Sangre</a>
			<a class="dropdown-item" href="/business/types-bloods-rhs/">Tipos de RH</a>
			<a class="dropdown-item" href="/business/types-contacts/">Tipos de Contacto</a>
			<a class="dropdown-item" href="/business/types-charges/">Tipos de Cargos</a>
		</div>
	</li>
	
	<li class="nav-item dropdown no-arrow mx-1">
		<a class="nav-link dropdown-toggle" href="#" id="locationsSubdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-cog"></i>
			<span>Clientes</span>
			<!-- // <span class="badge badge-danger"></span> -->
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="locationsSubdropdown">
			<a class="dropdown-item" href="/business/types-societys/">Tipos de Sociedades</a>
			<a class="dropdown-item" href="/business/types-clients/">Tipos de Clientes</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/business/attributes/">Conceptos Adicionales</a>
		</div>
	</li>
	
	<li class="nav-item dropdown no-arrow mx-1">
		<a class="nav-link dropdown-toggle" href="#" id="locationsSubdropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fas fa-cog"></i>
			<span>Vehículos</span>
			<!-- // <span class="badge badge-danger"></span> -->
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="locationsSubdropdown">
			<a class="dropdown-item" href="/business/types-vehicles/">Tipos de Vehículos</a>
			<a class="dropdown-item" href="/business/types-fuels/">Tipos de Combustibles</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="/business/status-vehicles/">Estados de Vehículos</a>
		</div>
	</li>
</ul>

