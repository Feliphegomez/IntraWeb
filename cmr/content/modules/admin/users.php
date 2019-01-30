<?php

$Users = new Users();
$listUsers = $Users->list;

?>

<div class="card mb-3">
	<div class="card-header">
		<a class="btn btn-success btn-sm" href="#">
			<i class="fa fa-plus"></i> 
		</a>
		
		<i class="fas fa-users"></i>
		Lista de: Usuarios
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			  <thead>
				<tr>
				  <th>ID</th>
				  <th>Usuario</th>
				  <th>Nombres</th>
				  <th>Primer Apellido</th>
				  <th>Segundo Apellido</th>
				  <th></th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th>ID</th>
				  <th>Usuario</th>
				  <th>Nombres</th>
				  <th>Primer Apellido</th>
				  <th>Segundo Apellido</th>
				  <th></th>
				</tr>
			  </tfoot>
			  <tbody>
				<?php foreach($listUsers as $user){ ?>
					<tr>
						<td><?php echo $user->id; ?></td>
						<td><?php echo $user->username; ?></td>
						<td><?php echo $user->names; ?></td>
						<td><?php echo $user->surname; ?></td>
						<td><?php echo $user->second_surname; ?></td>
						<td>
							<a class="btn btn-success btn-sm" href="/users/profile/<?php echo $user->username; ?>">
								<i class="far fa-eye"></i> 
							</a>
							<a class="btn btn-warning btn-sm text-white" href="#">
								<i class="fas fa-edit"></i> 
							</a>
							<a class="btn btn-danger btn-sm" href="#">
								<i class="fas fa-trash-alt"></i> 
							</a>
						</td>
					</tr>
				<?php } ?>
			  </tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
