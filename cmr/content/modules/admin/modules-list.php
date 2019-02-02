<?php
	global $session, $site;

$Modules = new Modules();
$listModules = $Modules->list;
$permissionsList = new Permissions();


#exit(json_encode($listModules));
?>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-users"></i>
		Lista de: Modulos
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
			  <thead>
				<tr>
				  <th>Nombre</th>
				  <th>Sections</th>
				  <th>Scripts</th>
				</tr>
			  </thead>
			  <tfoot>
				<tr>
				  <th>Nombre</th>
				  <th>Sections</th>
				  <th>Scripts</th>
				</tr>
			  </tfoot>
			  <tbody>
				<?php foreach($listModules as $module => $sections_scripts){ ?>
					<tr>
						<td><?php echo $module; ?></td>
						<td>
							<ul>
								<?php foreach($sections_scripts as $key => $section){
									if($key !== 'scripts')
									{
										 ?>
											<li><?php echo $section; ?></li>
										<?php 
									}
								} ?>
							</ul>
						</td>
						<td>
							<ul>
								<?php foreach($sections_scripts as $key2 => $section){
									if($key2 == 'scripts')
									{
										if(is_array($section) == true)
										{
											foreach($section as $key3 => $script){
											 ?>
												<li><?php echo ($script); ?></li>
											<?php 
											}
										}
									}
								} ?>
							</ul>
						</td>
					</tr>
				<?php } ?>
			  </tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted"><?php echo json_encode($module); ?>.</div>
</div>
