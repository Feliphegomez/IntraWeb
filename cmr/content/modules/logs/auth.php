<?php
	global $session, $site;
	

$Routes = new LogsAuth();
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
				  <th>ID</th>
				  <th>host</th>
				  <th>real_ip</th>
				  <th>forwarded_for</th>
				  <th>user_agent</th>
				  <th>accept</th>
				  <th>referer</th>
				  <th>cookie</th>
				  <th>server_address</th>
				  <th>server_name</th>
				  <th>server_port</th>
				  <th>remote_address</th>
				  <th>script_filename</th>
				  <th>redirect_url</th>
				  <th>request_method</th>
				  <th>request_uri</th>
				  <th>time</th>
				  <th>time_float</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th>ID</th>
				  <th>host</th>
				  <th>real_ip</th>
				  <th>forwarded_for</th>
				  <th>user_agent</th>
				  <th>accept</th>
				  <th>referer</th>
				  <th>cookie</th>
				  <th>server_address</th>
				  <th>server_name</th>
				  <th>server_port</th>
				  <th>remote_address</th>
				  <th>script_filename</th>
				  <th>redirect_url</th>
				  <th>request_method</th>
				  <th>request_uri</th>
				  <th>time</th>
				  <th>time_float</th>
				</tr>
			  </tfoot>
			  <tbody>
				<?php foreach($listRoutes as $route){ ?>
					<tr>
						<td><?php echo $route->id; ?></td>
						<td><?php echo $route->host; ?></td>
						<td><?php echo $route->real_ip; ?></td>
						<td><?php echo $route->forwarded_for; ?></td>
						<td><?php echo $route->user_agent; ?></td>
						<td><?php echo $route->accept; ?></td>
						<td><?php echo $route->referer; ?></td>
						<td><?php echo $route->cookie; ?></td>
						<td><?php echo $route->server_address; ?></td>
						<td><?php echo $route->server_name; ?></td>
						<td><?php echo $route->server_port; ?></td>
						<td><?php echo $route->remote_address; ?></td>
						<td><?php echo $route->script_filename; ?></td>
						<td><?php echo $route->redirect_url; ?></td>
						<td><?php echo $route->request_method; ?></td>
						<td><?php echo $route->request_uri; ?></td>
						<td><?php echo $route->time; ?></td>
						<td><?php echo $route->time_float; ?></td>
					</tr>
				<?php } ?>
			  </tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Tabla con todos los usuarios.</div>
</div>
