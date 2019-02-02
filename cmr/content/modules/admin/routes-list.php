<?php
	global $session, $site;
	
if(
	isset($site->fields['routeData-id'])
	&& isset($site->fields['deleteRouteForm'])
)
	{
		$valPermission = $session->validatePermission('routes', 'delete');
		
		if($valPermission == false){
			echo "No tienes permisos para realizar esta accion";
		}else{
			$routeTemp = new Route_S();
			$resultDelete = $routeTemp->delete_by_id($site->fields['routeData-id']);
			
			if($resultDelete == true)
				{
					echo "El route fue borrado con éxito.";
				}
		}
	}
else if(
	isset($site->fields['routeData-id'])
	&& isset($site->fields['updateRouteForm'])
)
	{
		$valPermission = $session->validatePermission('routes', 'change');
		if($valPermission == false){
			echo "No tienes permisos para realizar esta accion";
		}else{
			$routeTemp = new Route_S();
			
			$resultUpdate = $routeTemp->update_by_id($site->fields);
			
		}
		echo "<br>";
		echo "<br>";
	}
else if(
	isset($site->fields['routeData-url'])
	&& isset($site->fields['createRouteForm'])
)
	{
		$valPermission = $session->validatePermission('routes', 'create');
		if($valPermission == false){
			echo "No tienes permisos para realizar esta accion";
		}else{
			$routeTemp = new Route_S();
			$resultUpdate = $routeTemp->create($site->fields);
			
		}
		echo "<br>";
		echo "<br>";
	}

$Routes = new Routes();
$listRoutes = $Routes->list;


?>
<div class="card mb-3">
	<div class="card-header">

		<a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#CreateRouteModal-0">
			<i class="fas fa-plus"></i> 
		</a>
		
		<i class="fas fa-users"></i>
		Lista de: Usuarios
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
			  <thead>
				<tr>
				  <th></th>
				  <th>ID</th>
				  <th>URL Acceso</th>
				  <th>Modulo</th>
				  <th>Section</th>
				  <th>Creado</th>
				  <th></th>
				  <th></th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th></th>
				  <th>ID</th>
				  <th>URL Acceso</th>
				  <th>Modulo</th>
				  <th>Section</th>
				  <th>Creado</th>
				  <th></th>
				  <th></th>
				</tr>
			  </tfoot>
			  <tbody>
				<?php foreach($listRoutes as $route){ ?>
					<tr>
						<td>
							<a class="btn btn-info btn-sm" target="new" href="<?php echo $route->url; ?>">
								<i class="fas fa-eye"></i> 
							</a>
						</td>
						<td><?php echo $route->id; ?></td>
						<td><?php echo $route->url; ?></td>
						<td><?php echo $route->module; ?></td>
						<td><?php echo $route->section; ?></td>
						<td><?php echo $route->created_at; ?></td>
						<td>
							<a class="btn btn-warning btn-sm text-white" href="#" data-toggle="modal" data-target="#EditRouteModal-<?php echo $route->id; ?>">
								<i class="fas fa-edit"></i>
							</a>
						</td>
						<td>
							<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteRouteModal-<?php echo $route->id; ?>">
								<i class="fas fa-trash-alt"></i> 
							</a>
						</td>
					</tr>
				<?php } ?>
			  </tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Tabla con todos los usuarios.</div>
</div>

<!-- Create User Modal-->
<div class="modal fade" id="CreateRouteModal-0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear Route</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				Vas a crear el contenido.
				<hr>
				<form method="POST">
					<div class="row">
						<div class="form-group col-sm-6">
							<label>URL Acceso</label>
							<input value="" type="text" class="form-control" name="routeData-url" placeholder="URL Acceso">
							<small class="form-text text-muted">Este campo debe ser unico.</small>
						</div>						
						<div class="form-group col-sm-6">
							<label>Modulo</label>
							<input value="" type="text" class="form-control" name="routeData-module" placeholder="Modulo">
							<small class="form-text text-muted"></small>
						</div>
						<div class="form-group col-sm-6">
							<label>Section</label>
							<input value="" type="text" class="form-control" name="routeData-section" placeholder="Section">
							<small class="form-text text-muted"></small>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" type="submit" name="createRouteForm">Crear</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php foreach($listRoutes as $route){ ?>
	<!-- Edit User Modal-->
	<div class="modal fade" id="EditRouteModal-<?php echo $route->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modificar Route</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					Vas a modificar el contenido.
					<hr>
					<form method="POST">
						<div class="row">
							<input type="hidden" value="<?php echo $route->id; ?>" name="routeData-id" />
							<div class="form-group col-sm-6">
								<label>URL Acceso</label>
								<input value="<?php echo $route->url; ?>" type="text" class="form-control" name="routeData-url" placeholder="URL Acceso">
								<small class="form-text text-muted">Este campo debe ser unico.</small>
							</div>						
							<div class="form-group col-sm-6">
								<label>Modulo</label>
								<input value="<?php echo $route->module; ?>" type="text" class="form-control" name="routeData-module" placeholder="Modulo">
								<small class="form-text text-muted"></small>
							</div>
							<div class="form-group col-sm-6">
								<label>Section</label>
								<input value="<?php echo $route->section; ?>" type="text" class="form-control" name="routeData-section" placeholder="Section">
								<small class="form-text text-muted"></small>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit" name="updateRouteForm">Guardar</button>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Delete User Modal-->
	<div class="modal fade" id="deleteRouteModal-<?php echo $route->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Estas Seguro de Eliminar?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					Vas a eliminar contenido de manera inreversible, confirma para continuar.
					<hr>
					<table class="table table-hover table-striped table-dark">
						<tbody>
							<tr>
								<th>URL Acceso</th>
								<td><?php echo $route->url; ?></td>
							</tr>
							<tr>
								<th>Modulo</th>
								<td><?php echo $route->module; ?> </td>
							</tr>
							<tr>
								<th>Section</th>
								<td><?php echo $route->section; ?></td>
							</tr>
							<tr>
								<th>Fecha de creación</th>
								<td><?php echo $route->created_at; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<form method="POST">
						<input type="hidden" name="routeData-id" value="<?php echo $route->id; ?>" />
						<button class="btn btn-danger" type="submit" name="deleteRouteForm">Eliminar</button>
					</form>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>