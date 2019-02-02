<?php

global $session;
$username = $session->Route->id;
/*
if(isset($session->Routes2->id)){
}else{
	#echo '<meta http-equiv="refresh" content="0; url='.path_home.'out" />';
	exit("Usuario no detectado.");
}*/
$userInfo = new User();
$userInfo->load_by_username($username);
?>

<div class="">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 image-section">
			<!-- <img src="https://png.pngtree.com/thumb_back/fw800/back_pic/00/08/57/41562ad4a92b16a.jpg"> -->
		</div>
		<div class="col-md-12 row user-left-part">
			<div class="col-md-3 col-sm-3 col-xs-12 user-profil-part pull-left">
				<div class="row ">
					<div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
						<!-- // <img src="" class=""> -->
						<img class="rounded-circle" id="myImg" data-toggle="modal" data-target="#myModal" src="<?php echo "/media/images/{$userInfo->avatar}"; ?>" data-src="<?php echo "/media/images/{$userInfo->avatar}"; ?>" />
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
						<!--
						<button id="btn-contact" (click)="clearModal()" data-toggle="modal" data-target="#contact" class="btn btn-success btn-block follow">Contactarme</button> 
						<button class="btn btn-warning btn-block">Descargar Curriculum</button>
						-->
					</div>
					
					<div class="row user-detail-row">
						<!--
						<div class="col-md-12 col-sm-12 user-detail-section2 pull-left">
							<div class="border"></div>
							<p>FOLLOWER</p>
							<span>320</span>
						</div>    -->                       
					</div>
				   
				   <!--
					<div class="row user-detail-row">
						<div class="col-md-12 col-sm-12 user-detail-section2 pull-left">
							<div class="border"></div>
							<p>JSON</p>
							<span><?php echo json_encode($userInfo); ?></span>
						</div>                           
					</div>-->
				   
				</div>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12 pull-right profile-right-section">
				<div class="row profile-right-section-row">
					<div class="col-md-12 profile-header">
						<div class="row">
							<div class="col-md-8 col-sm-6 col-xs-6 profile-header-section1 pull-left">
								<h1><?php echo "{$userInfo->names} {$userInfo->surname} {$userInfo->second_surname}"; ?></h1>
								<h5>Developer</h5>
							</div>
							<div class="col-md-4 col-sm-6 col-xs-6 profile-header-section1 text-right pull-rigth">
								<a href="/search" class="btn btn-primary btn-block">Seguir buscando</a>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-8">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" href="#profile" role="tab" data-toggle="tab"><i class="fas fa-user-circle"></i> Información Personal</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#buzz" role="tab" data-toggle="tab"><i class="fas fa-info-circle"></i> Permisos</a>
									</li>                                                
								</ul>
								  
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade show active" id="profile">
										<div class="row">
											<div class="col-md-2">
												<label>ID</label>
											</div>
											<div class="col-md-6">
												<p><?php echo "{$userInfo->id}"; ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label>Nombres</label>
											</div>
											<div class="col-md-6">
												<p><?php echo "{$userInfo->names}"; ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label>Primer Apellido</label>
											</div>
											<div class="col-md-6">
												<p><?php echo "{$userInfo->surname}"; ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label>Segundo Apellido</label>
											</div>
											<div class="col-md-6">
												<p><?php echo "{$userInfo->second_surname}"; ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label>Email</label>
											</div>
											<div class="col-md-6">
												<p><?php echo "{$userInfo->mail}"; ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label>Teléfono</label>
											</div>
											<div class="col-md-6">
												<p><?php echo "{$userInfo->phone}"; ?></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<label>Móvil</label>
											</div>
											<div class="col-md-6">
												<p><?php echo "{$userInfo->mobile}"; ?></p>
											</div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="buzz">
										<div class="row">
											<div class="col-md-12">
												<div class="table-responsive">
													<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
														<thead>
															<tr>
															  <th>Modulo</th>
															  <th>Crear</th>
															  <th>Editar</th>
															  <th>Borrar</th>
															  <th>Ver</th>
															</tr>
														</thead>
														<tfoot>
															<tr>
															  <th>Modulo</th>
															  <th>Crear</th>
															  <th>Editar</th>
															  <th>Borrar</th>
															  <th>Ver</th>
															</tr>
														</tfoot>
														<tbody>
															<?php foreach($userInfo->permissions as $namePermission => $permissions){ ?>
																<tr>
																	<td><?php echo "{$namePermission}"; ?></td>
																	<td>
																		<?php
																			if(isset($permissions->create) && $permissions->create == true)
																			{
																				echo "<a class=\"btn btn-sm btn-success text-white\">";
																					//echo "<i class=\"fa fa-plus-circle\"></i> ";
																					echo "<i class=\"fa fa-check\"></i>";
																				echo "</a>";
																			}else{
																				echo "<a class=\"btn btn-sm btn-danger text-white\">";
																					//echo "<i class=\"fa fa-plus-circle\"></i> ";
																					echo "<i class=\"fa fa-ban\"></i>";
																				echo "</a>";
																			}
																		?>
																	</td>
																	<td>
																		<?php
																			if(isset($permissions->change) && $permissions->change == true)
																			{
																				echo "<a class=\"btn btn-sm btn-success text-white\">";
																					//echo "<i class=\"fa fa-wrench\"></i> ";
																					echo "<i class=\"fa fa-check\"></i>";
																				echo "</a>";
																			}else{
																				echo "<a class=\"btn btn-sm btn-danger text-white\">";
																					//echo "<i class=\"fa fa-wrench\"></i> ";
																					echo "<i class=\"fa fa-ban\"></i>";
																				echo "</a>";
																			}
																		?>
																	</td>
																	<td>
																		<?php
																			if(isset($permissions->delete) && $permissions->delete == true)
																			{
																				echo "<a class=\"btn btn-sm btn-success text-white\">";
																					//echo "<i class=\"fa fa-trash\"></i> ";
																					echo "<i class=\"fa fa-check\"></i>";
																				echo "</a>";
																			}else{
																				echo "<a class=\"btn btn-sm btn-danger text-white\">";
																					//echo "<i class=\"fa fa-trash\"></i> ";
																					echo "<i class=\"fa fa-ban\"></i>";
																				echo "</a>";
																			}
																		?>
																	</td>
																	<td>
																		<?php
																			if(isset($permissions->view) && $permissions->view == true)
																			{
																				echo "<a class=\"btn btn-sm btn-success text-white\">";
																					//echo "<i class=\"far fa-eye\"></i> ";
																					echo "<i class=\"fa fa-check\"></i>";
																				echo "</a>";
																			}else{
																				echo "<a class=\"btn btn-sm btn-danger text-white\">";
																					//echo "<i class=\"far fa-eye\"></i> ";
																					echo "<i class=\"fa fa-ban\"></i>";
																				echo "</a>";
																			}
																		?>
																	</td>
																</tr>
															<?php } ?>
													  </tbody>
													</table>
												</div>														
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4 img-main-rightPart">
								<div class="row">
									<div class="col-md-12">
										<div class="row image-right-part">
											<div class="col-md-6 pull-left image-right-detail">
												<h6>PUBLICIDAD</h6>
											</div>
										</div>
									</div>
									<a href="http://camaradecomerciozn.com/">
										<div class="col-md-12 image-right">
											<img src="http://pluspng.com/img-png/bootstrap-png-bootstrap-512.png">
										</div>
									</a>
									<div class="col-md-12 image-right-detail-section2">

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="contact">Contactarme</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<p for="msj">Se enviará este mensaje a la persona que desea contactar, indicando que te quieres comunicar con el. Para esto debes de ingresar tu información personal.</p>
				</div>
				<div class="form-group">
					<label for="txtFullname">Nombre completo</label>
					<input type="text" id="txtFullname" class="form-control">
				</div>
				<div class="form-group">
					<label for="txtEmail">Email</label>
					<input type="text" id="txtEmail" class="form-control">
				</div>
				<div class="form-group">
					<label for="txtPhone">Teléfono</label>
					<input type="text" id="txtPhone" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" (click)="openModal()" data-dismiss="modal">Guardar</button>
			</div>
		</div>
	</div>
</div>