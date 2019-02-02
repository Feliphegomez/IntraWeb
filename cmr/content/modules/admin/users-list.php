<?php
	global $session, $site;

if(
	isset($site->fields['userData-id'])
	&& isset($site->fields['deleteUserForm'])
)
	{
		$valPermission = $session->validatePermission('users', 'delete');
		
		if($valPermission == false){
			echo "No tienes permisos para realizar esta accion";
		}else{
			$userTemp = new User();
			$resultDelete = $userTemp->delete_by_id($site->fields['userData-id']);
			
			if($resultDelete == true)
				{
					echo "El usuario fue borrado con éxito.";
				}
		}
	}
else if(
	isset($site->fields['userData-id'])
	&& isset($site->fields['updateUserForm'])
)
	{
		$valPermission = $session->validatePermission('users', 'change');
		if($valPermission == false){
			echo "No tienes permisos para realizar esta accion";
		}else{
			$userTemp = new User();
			
			$resultUpdate = $userTemp->update_by_id($site->fields);
			
			/*
			if($resultDelete == true)
				{
					echo "El usuario fue borrado con éxito.";
				}
			*/
		}
		echo "<br>";
		echo "<br>";
	}
else if(
	isset($site->fields['userData-username'])
	&& isset($site->fields['createUserForm'])
)
	{
		$valPermission = $session->validatePermission('users', 'create');
		if($valPermission == false){
			echo "No tienes permisos para realizar esta accion";
		}else{
			$userTemp = new User();
			$resultUpdate = $userTemp->create($site->fields);
			
			/*
			if($resultDelete == true)
				{
					echo "El usuario fue borrado con éxito.";
				}
			*/
		}
		echo "<br>";
		echo "<br>";
	}

$Users = new Users();
$listUsers = $Users->list;

$permissionsList = new Permissions();

?>
<div class="card mb-3">
	<div class="card-header">

		<a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target="#CreateUserModal-0">
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
				  <th>Usuario</th>
				  <th>Nombres</th>
				  <th>Primer Apellido</th>
				  <th>Segundo Apellido</th>
				  <th>Telefono</th>
				  <th>Móvil</th>
				  <th>Avatar</th>
				  <th>E-Mail</th>
				  <th>Permisos</th>
				  <th></th>
				  <th></th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th></th>
				  <th>ID</th>
				  <th>Usuario</th>
				  <th>Nombres</th>
				  <th>Primer Apellido</th>
				  <th>Segundo Apellido</th>
				  <th>Telefono</th>
				  <th>Móvil</th>
				  <th>Avatar</th>
				  <th>E-Mail</th>
				  <th>Permisos</th>
				  <th></th>
				  <th></th>
				</tr>
			  </tfoot>
			  <tbody>
				<?php foreach($listUsers as $user){ ?>
					<tr target="new" href="/users/profile/<?php echo $user->username; ?>">
						<td>
							<a class="btn btn-info btn-sm" target="new" href="/users/profile/<?php echo $user->username; ?>">
								<i class="fas fa-eye"></i> 
							</a>
						</td>
						<td><?php echo $user->id; ?></td>
						<td><?php echo $user->username; ?></td>
						<td><?php echo $user->names; ?></td>
						<td><?php echo $user->surname; ?></td>
						<td><?php echo $user->second_surname; ?></td>
						<td><?php echo $user->phone; ?></td>
						<td><?php echo $user->mobile; ?></td>
						<td>
							<img class="img-thumbnail" id="myImg" data-toggle="modal" data-target="#myModal" src="/media/images/<?php echo $user->avatar; ?>" data-src="/media/images/<?php echo $user->avatar; ?>" />

						</td>
						<td><?php echo $user->mail; ?></td>
						<td>
							<table class="table table-responsive table-hover table-striped">
								<tbody>
									<?php foreach($user->permissions as $k=>$v)
										{
											echo '<tr>';
												echo '<th colspan="2">'.transalateLabelPermissions($k).'</th>';
											echo '</tr>';
											
											foreach($v as $k2=>$v2)
											{
												echo '<tr>';
													echo '<td>'.convertBooleanToIcon($v2).'</td>';
													echo '<td>'.transalateLabelPermissions($k2).'</td>';
												echo '</tr>';
											}
										}
									?>
								</tbody>
							</table>
						</td>
						<td>
							<a class="btn btn-warning btn-sm text-white" href="#" data-toggle="modal" data-target="#EditUserModal-<?php echo $user->id; ?>">
								<i class="fas fa-edit"></i>
							</a>
						</td>
						<td>
							<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteUserModal-<?php echo $user->id; ?>">
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
<div class="modal fade" id="CreateUserModal-0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				Vas a modificar el contenido.
				<hr>
				<form method="POST">
					<div class="row">
						<div class="form-group col-sm-6">
							<label>Usuario</label>
							<input value="" type="text" class="form-control" name="userData-username" placeholder="Usuario">
							<small class="form-text text-muted">Este campo debe ser unico.</small>
						</div>						
						<div class="form-group col-sm-6">
							<label>Nombres</label>
							<input value="" type="text" class="form-control" name="userData-names" placeholder="Nombres">
							<small class="form-text text-muted"></small>
						</div>
						<div class="form-group col-sm-6">
							<label>Primer Apellido</label>
							<input value="" type="text" class="form-control" name="userData-surname" placeholder="Primer Apellido">
							<small class="form-text text-muted"></small>
						</div>
						<div class="form-group col-sm-6">
							<label>Segundo Apellido</label>
							<input value="" type="text" class="form-control" name="userData-second_surname" placeholder="Segundo Apellido">
							<small class="form-text text-muted"></small>
						</div>
						<div class="form-group col-sm-6">
							<label>Telefono</label>
							<input value="" type="text" class="form-control" name="userData-phone" placeholder="Telefono">
							<small class="form-text text-muted"></small>
						</div>
						<div class="form-group col-sm-6">
							<label>Móvil</label>
							<input value="" type="text" class="form-control" name="userData-mobile" placeholder="Móvil">
							<small class="form-text text-muted"></small>
						</div>
						<div class="form-group col-sm-6">
							<label>Correo Electronico</label>
							<input value="" type="email" class="form-control" name="userData-mail" placeholder="Correo Electronico" />
							<small class="form-text text-muted"></small>
						</div>
						<div class="form-group col-sm-6">
							<label>Contraseña</label>
							<input value="" type="text" class="form-control" name="userData-hash" placeholder="Contraseña" />
							<small class="form-text text-muted"></small>
						</div>
						<div class="form-group col-sm-6">
							<label>Perfil (Permisos)</label>
							<select class="form-control" name="userData-permissions">
								<?php foreach($permissionsList->list as $item){
									echo "<option value=\"{$item->id}\">{$item->name}</option>";
								} ?>
							</select>
							<small class="form-text text-muted"></small>
						</div>
						
						<div class="form-group col-sm-6">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<?php 
									$i = 0;
									foreach($permissionsList->list as $item2){
											$class = '';
											if($i==0){ $class = 'active'; };
											#echo json_encode($item2);
											echo "<li class=\"nav-item\"><a class=\"nav-link {$class}\" id=\"home-tab\" data-toggle=\"tab\" href=\"#home-{$item2->id}\" role=\"tab\" aria-controls=\"home\" aria-selected=\"true\">{$item2->name}</a></li>";
										$i++;
									}
								?>
							</ul>
							<div class="tab-content" id="myTabContent">
								<?php 
									$i = 0;
									foreach($permissionsList->list as $item2){
											$class = '';
											if($i==0){ $class = 'show active'; };
											#echo json_encode($item2);
											echo "<div class=\"tab-pane fade {$class}\" id=\"home-{$item2->id}\" role=\"tabpanel\" aria-labelledby=\"home-tab\">";
												echo "<h4>{$item->name}</h4>";
												echo "<table class=\"table table-hover table-striped table-dark\">";
													foreach(json_decode($item->data) as $k=>$v)
													{
														echo '<tr>';
															echo '<th colspan="2" class="text-center">'.transalateLabelPermissions($k).'</th>';
														echo '</tr>';
														
														foreach(($v) as $k2=>$v2)
														{
															echo '<tr>';
																echo '<td>'.convertBooleanToIcon($v2).'</td>';
																echo '<td>'.transalateLabelPermissions($k2).'</td>';
															echo '</tr>';
														}
													}
												echo "</table>";
											echo "</div>";
										$i++;
									}
								?>
							</div>
						
							<?php 
								/*
								
								echo "<div class=\"tab-pane fade show {$class}\" id=\"tab-{$item->id}\" role=\"tabpanel\" aria-labelledby=\"tab-{$item->id}\">";
									echo "<h4>{$item->name}</h4>";
									echo "<table class=\"table table-hover table-striped table-dark\">";
										foreach(json_decode($item->data) as $k=>$v)
										{
											echo '<tr>';
												echo '<th colspan="2" class="text-center">'.transalateLabelPermissions($k).'</th>';
											echo '</tr>';
											
											foreach(($v) as $k2=>$v2)
											{
												echo '<tr>';
													echo '<td>'.convertBooleanToIcon($v2).'</td>';
													echo '<td>'.transalateLabelPermissions($k2).'</td>';
												echo '</tr>';
											}
										}
									echo "</table>";
								echo "</div>";
							 */ ?>
							
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success" type="submit" name="createUserForm">Crear</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php foreach($listUsers as $user){ ?>
	<!-- Edit User Modal-->
	<div class="modal fade" id="EditUserModal-<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					Vas a modificar el contenido.
					<hr>
					<form method="POST">
						<div class="row">
							<input type="hidden" value="<?php echo $user->id; ?>" name="userData-id" />
							<div class="form-group col-sm-6">
								<label>Usuario</label>
								<input value="<?php echo $user->username; ?>" type="text" class="form-control" name="userData-username" placeholder="Usuario">
								<small class="form-text text-muted">Este campo debe ser unico.</small>
							</div>						
							<div class="form-group col-sm-6">
								<label>Nombres</label>
								<input value="<?php echo $user->names; ?>" type="text" class="form-control" name="userData-names" placeholder="Nombres">
								<small class="form-text text-muted"></small>
							</div>
							<div class="form-group col-sm-6">
								<label>Primer Apellido</label>
								<input value="<?php echo $user->surname; ?>" type="text" class="form-control" name="userData-surname" placeholder="Primer Apellido">
								<small class="form-text text-muted"></small>
							</div>
							<div class="form-group col-sm-6">
								<label>Segundo Apellido</label>
								<input value="<?php echo $user->second_surname; ?>" type="text" class="form-control" name="userData-second_surname" placeholder="Segundo Apellido">
								<small class="form-text text-muted"></small>
							</div>
							<div class="form-group col-sm-6">
								<label>Telefono</label>
								<input value="<?php echo $user->phone; ?>" type="text" class="form-control" name="userData-phone" placeholder="Telefono">
								<small class="form-text text-muted"></small>
							</div>
							<div class="form-group col-sm-6">
								<label>Móvil</label>
								<input value="<?php echo $user->mobile; ?>" type="text" class="form-control" name="userData-mobile" placeholder="Móvil">
								<small class="form-text text-muted"></small>
							</div>
							<div class="form-group col-sm-6">
								<label>Correo Electronico</label>
								<input value="<?php echo $user->mail; ?>" type="email" class="form-control" name="userData-mail" placeholder="Correo Electronico">
								<small class="form-text text-muted"></small>
							</div>
							<div class="form-group col-sm-6">
								<label>Contraseña</label>
								<input value="<?php echo $user->hash; ?>" type="text" class="form-control" name="userData-hash" placeholder="Contraseña">
								<small class="form-text text-muted"></small>
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="submit" name="updateUserForm">Guardar</button>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Delete User Modal-->
	<div class="modal fade" id="deleteUserModal-<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
								<th>Usuario</th>
								<td><?php echo $user->username; ?></td>
							</tr>
							<tr>
								<th>Nombre Completo</th>
								<td><?php echo $user->names; ?> <?php echo $user->surname; ?> <?php echo $user->second_surname; ?></td>
							</tr>
							<tr>
								<th>Teléfono</th>
								<td><?php echo $user->phone; ?></td>
							</tr>
							<tr>
								<th>Móvil</th>
								<td><?php echo $user->mobile; ?></td>
							</tr>
							<tr>
								<th>E-Mail</th>
								<td><?php echo $user->mail; ?></td>
							</tr>
							<tr>
								<th>Avatar</th>
								<td><img class="img-thumbnail" src="/media/images/<?php echo $user->avatar; ?>" /></td>
							</tr>
						</tbody>
					</table>
					
					<!--
					<form>
						<div class="form-group">
							<label for="DeleteUserInput">Usuario</label>
							<input value="" readonly="" type="text" class="form-control" id="DeleteUserInput" name="DeleteUserInput" aria-describedby="DeleteUserInput" placeholder="Usuario">
							<small id="EditUserInput" class="form-text text-muted">Este campo debe ser unico.</small>
						</div>
						
						<div class="modal-footer">
							<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
							<a class="btn btn-primary" href="<?php echo path_home; ?>out">Guardar</a>
						</div>
					</form>-->
				</div>
				<div class="modal-footer">
					<form method="POST">
						<input type="hidden" name="userData-id" value="<?php echo $user->id; ?>" />
						<button class="btn btn-danger" type="submit" name="deleteUserForm">Eliminar</button>
					</form>
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>