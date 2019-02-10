<?php
	global $session, $site;
	
if(
	isset($site->fields['settingData-id'])
	&& isset($site->fields['deleteSettingForm'])
)
	{
		$valPermission = $session->validatePermission('settings', 'delete');
		
		if($valPermission == false){
			echo "No tienes permisos para realizar esta accion";
		}else{
			$routeTemp = new Setting();
			$resultDelete = $routeTemp->delete_by_id($site->fields['settingData-id']);
			
			if($resultDelete == true)
				{
					echo "El route fue borrado con éxito.";
				}
		}
	}
else if(
	isset($site->fields['settingData-id'])
	&& isset($site->fields['updateSettingForm'])
)
	{
		$valPermission = $session->validatePermission('settings', 'change');
		if($valPermission == false){
			echo "No tienes permisos para realizar esta accion";
		}else{
			$routeTemp = new Setting();
			
			$resultUpdate = $routeTemp->update_by_id($site->fields);
			
		}
		echo "<br>";
		echo "<br>";
	}
else if(
	isset($site->fields['settingData-url'])
	&& isset($site->fields['createSettingForm'])
)
	{
		$valPermission = $session->validatePermission('settings', 'create');
		if($valPermission == false){
			echo "No tienes permisos para realizar esta accion";
		}else{
			$routeTemp = new Setting();
			$resultUpdate = $routeTemp->create($site->fields);
			
		}
		echo "<br>";
		echo "<br>";
	}

$settings = new Settings();
$listsettings = $settings->list;

?>
<div class="card mb-3">
	<div class="card-header">

		<a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#CreateSettingModal-0">
			<i class="fas fa-plus"></i> 
		</a>
		
		<i class="fas fa-users"></i>
		Lista de: Configuraciones
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
			  <thead>
				<tr>
				  <th>ID</th>
				  <th>Nombre</th>
				  <th></th>
				  <th></th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th>ID</th>
				  <th>Nombre</th>
				  <th></th>
				  <th></th>
				</tr>
			  </tfoot>
			  <tbody>
				<?php foreach($listsettings as $route){ ?>
					<tr>
						<td><?php echo $route->id; ?></td>
						<td><?php echo $route->name; ?></td>
						<td>
							<a class="btn btn-warning btn-sm text-white" href="#" data-toggle="modal" data-target="#EditSettingModal-<?php echo $route->id; ?>">
								<i class="fas fa-edit"></i>
							</a>
						</td>
						<td>
							<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteSettingModal-<?php echo $route->id; ?>">
								<i class="fas fa-trash-alt"></i> 
							</a>
						</td>
					</tr>
				<?php } ?>
			  </tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">.</div>
</div>

<!-- Create Modal-->
<div class="modal fade" id="CreateSettingModal-0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				Vas a crear el contenido.
				<hr>
				<form method="POST">
					<div class="row">
						<div class="form-group col-sm-12">
							<label>Nombre</label>
							<input value="" type="text" class="form-control" name="settingData-name" placeholder="Nombre">
							<small class="form-text text-muted">Este campo debe ser unico.</small>
						</div>						
						<div class="form-group col-sm-12">
							<label>Resultado</label>
							<textarea value="" class="form-control" name="settingData-result" rows="12"></textarea>
							<small class="form-text text-muted"></small>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" type="submit" name="createSettingForm">Crear</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php foreach($listsettings as $route){ ?>
	<!-- Edit User Modal-->
	<div class="modal fade" id="EditSettingModal-<?php echo $route->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<input type="hidden" value="<?php echo $route->id; ?>" name="settingData-id" />
							<div class="form-group col-sm-12">
								<label>Nombre</label>
								<input value="<?php echo $route->name; ?>" type="text" class="form-control" name="settingData-name" placeholder="Nombre">
								<small class="form-text text-muted">Este campo debe ser unico.</small>
							</div>						
							<div class="form-group col-sm-12">
								<label>Resultado</label>
								<textarea type="text" class="form-control" name="settingData-result" rows="12"><?php echo $route->result; ?></textarea>
								<small class="form-text text-muted"></small>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit" name="updateSettingForm">Guardar</button>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Delete User Modal-->
	<div class="modal fade" id="deleteSettingModal-<?php echo $route->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
								<th>Nombre</th>
								<td><?php echo $route->name; ?></td>
							</tr>
							<tr>
								<th>Resultado</th>
								<td><?php echo $route->result; ?> </td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<form method="POST">
						<input type="hidden" name="settingData-id" value="<?php echo $route->id; ?>" />
						<button class="btn btn-danger" type="submit" name="deleteSettingForm">Eliminar</button>
					</form>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>