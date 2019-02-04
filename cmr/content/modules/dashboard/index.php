<?php
	global $session, $site;

	$valPermission = $session->validatePermission('dashboard', 'view');
	
	if($valPermission == false){
		echo "No tienes permisos para realizar esta accion";
	}else{
		$LogsAuth = new LogsAuth(100);
		$listLogsAuth = $LogsAuth->list;

?>
  <!-- Icon Cards
  <div class="row">
	<div class="col-xl-3 col-sm-6 mb-3">
	  <div class="card text-white bg-primary o-hidden">
		<div class="card-body">
		  <div class="card-body-icon">
			<i class="fas fa-fw fa-comments"></i>
		  </div>
		  <div class="mr-5">26 New Messages!</div>
		</div>
		<a class="card-footer text-white clearfix small z-1" href="#">
		  <span class="float-left">View Details</span>
		  <span class="float-right">
			<i class="fas fa-angle-right"></i>
		  </span>
		</a>
	  </div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
	  <div class="card text-white bg-warning o-hidden">
		<div class="card-body">
		  <div class="card-body-icon">
			<i class="fas fa-fw fa-list"></i>
		  </div>
		  <div class="mr-5">11 New Tasks!</div>
		</div>
		<a class="card-footer text-white clearfix small z-1" href="#">
		  <span class="float-left">View Details</span>
		  <span class="float-right">
			<i class="fas fa-angle-right"></i>
		  </span>
		</a>
	  </div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
	  <div class="card text-white bg-success o-hidden">
		<div class="card-body">
		  <div class="card-body-icon">
			<i class="fas fa-fw fa-shopping-cart"></i>
		  </div>
		  <div class="mr-5">123 New Orders!</div>
		</div>
		<a class="card-footer text-white clearfix small z-1" href="#">
		  <span class="float-left">View Details</span>
		  <span class="float-right">
			<i class="fas fa-angle-right"></i>
		  </span>
		</a>
	  </div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
	  <div class="card text-white bg-danger o-hidden">
		<div class="card-body">
		  <div class="card-body-icon">
			<i class="fas fa-fw fa-life-ring"></i>
		  </div>
		  <div class="mr-5">13 New Tickets!</div>
		</div>
		<a class="card-footer text-white clearfix small z-1" href="#">
		  <span class="float-left">View Details</span>
		  <span class="float-right">
			<i class="fas fa-angle-right"></i>
		  </span>
		</a>
	  </div>
	</div>
  </div>
-->
  <!-- Area Chart Example-->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-chart-area"></i>
			Uso frecuente
		</div>
		<div class="card-body">
			<canvas id="myAreaChart" width="100%" height="30"></canvas>
		</div>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div>

  <!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Últimos Registros</div>
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
				<?php foreach($listLogsAuth as $route){ ?>
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
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div>
  
<?php
	}
?>