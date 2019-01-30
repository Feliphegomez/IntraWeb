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

	
	
<style>
  .border{
    border-bottom:1px solid #F1F1F1;
    margin-bottom:10px;
  }
  .main-secction{
    box-shadow: 10px 10px 10px;
  }
  .image-section{
    padding: 0px;
    width: 100%;
    height: 333px;
    position: relative;
    background-size: cover;
    background-image: url(http://hashtag-bg.com/wp-content/uploads/2018/08/whit-ebackground-resume-white-background-photos-and-wallpaper-for-free-download-5b78ba2d6c563.jpg);
    background-position: center;
    background-repeat: no-repeat;
  }
  .image-section img{
	  /*
    width: 100%;
    height:250px;
    position: relative; */
  }
  .user-image{
    position: absolute;
    margin-top:-50px;
  }
  .user-left-part{
    margin: 0px;
  }
  .user-image img{
    width:100px;
    height:100px;
  }
  .user-profil-part{
    padding-bottom:30px;
    background-color:#FAFAFA;
  }
  .follow{    
    margin-top:70px;   
  }
  .user-detail-row{
    margin:0px; 
  }
  .user-detail-section2 p{
    font-size:12px;
    padding: 0px;
    margin: 0px;
  }
  .user-detail-section2{
    margin-top:10px;
  }
  .user-detail-section2 span{
    color:#7CBBC3;
    font-size: 20px;
  }
  .user-detail-section2 small{
    font-size:12px;
    color:#D3A86A;
  }
  .profile-right-section{
    padding: 20px 0px 10px 15px;
    background-color: #FFFFFF;  
  }
  .profile-right-section-row{
    margin: 0px;
  }
  .profile-header-section1 h1{
    font-size: 25px;
    margin: 0px;
  }
  .profile-header-section1 h5{
    color: #0062cc;
  }
  .req-btn{
    height:30px;
    font-size:12px;
  }
  .profile-tag{
    padding: 10px;
    border:1px solid #F6F6F6;
  }
  .profile-tag p{
    font-size: 12px;
    color:black;
  }
  .profile-tag i{
    color:#ADADAD;
    font-size: 20px;
  }
  .image-right-part{
    background-color: #FCFCFC;
    margin: 0px;
    padding: 5px;
  }
  .img-main-rightPart{
    background-color: #FCFCFC;
    margin-top: auto;
  }
  .image-right-detail{
    padding: 0px;
  }
  .image-right-detail p{
    font-size: 12px;
  }
  .image-right-detail a:hover{
    text-decoration: none;
  }
  .image-right img{
    width: 100%;
  }
  .image-right-detail-section2{
    margin: 0px;
  }
  .image-right-detail-section2 p{
    color:#38ACDF;
    margin:0px;
  }
  .image-right-detail-section2 span{
    color:#7F7F7F;
  }
  .nav-link{
    font-size: 1.2em;    
  }
</style>

<div class="">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 image-section">
			<!-- <img src="https://png.pngtree.com/thumb_back/fw800/back_pic/00/08/57/41562ad4a92b16a.jpg"> -->
		</div>
		<div class="col-md-12 row user-left-part">
			<div class="col-md-3 col-sm-3 col-xs-12 user-profil-part pull-left">
				<div class="row ">
					<div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
						<img src="<?php echo "/media/images/{$userInfo->avatar}"; ?>" class="rounded-circle">
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center">
						<button id="btn-contact" (click)="clearModal()" data-toggle="modal" data-target="#contact" class="btn btn-success btn-block follow">Contactarme</button> 
						<button class="btn btn-warning btn-block">Descargar Curriculum</button>                               
					</div>
					<div class="row user-detail-row">
						<div class="col-md-12 col-sm-12 user-detail-section2 pull-left">
							<div class="border"></div>
							<p>FOLLOWER</p>
							<span>320</span>
						</div>                           
					</div>
				   
					<div class="row user-detail-row">
						<div class="col-md-12 col-sm-12 user-detail-section2 pull-left">
							<div class="border"></div>
							<p>JSON</p>
							<span><?php echo json_encode($userInfo); ?></span>
						</div>                           
					</div>
				   
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
																  <th><?php echo "{$namePermission}"; ?></th>
																	<?php foreach($permissions as $k => $v){ ?>
																		<td>
																			<a class="btn btn-sm btn-primary text-white">
																				<?php if($k == 'create'){ ?>
																					<i class="fa fa-plus-circle"></i>
																				<?php } else if($k == 'change'){ ?>
																					<i class="fa fa-wrench"></i>
																				<?php } else if($k == 'delete'){ ?>
																					<i class="fa fa-trash"></i>
																				<?php } else if($k == 'view'){ ?>
																					<i class="fa fa-eye"></i>
																				<?php } ?>
																				
																				<?php if($v == true){ ?>
																					<i class="fa fa-check"></i>
																				<?php }else{ ?>
																					<i class="fa fa-trash"></i>
																				<?php } ?>
																			</a>
																		</td>
																	<?php } ?>
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