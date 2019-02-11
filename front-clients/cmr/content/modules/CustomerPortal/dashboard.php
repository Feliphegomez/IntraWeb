<?php global $site, $session; ?>
<br>
<br>
<br>
    <section class="wthree-row  w3-contact">
        <div class="row  no-gutters align-items-center abbot-main">
            <div class="col-lg-6 about-grid-agileits py-5" data-blast="bgColor">
                <div class="about-grid">
                    <div class="container">
                        <div class="d-flex">
                            <div class="mx-auto">
                                <div class="title-section py-lg-5 pb-4">
                                    <h4>Informacion</h4>
                                    <h3 class="w3ls-title text-uppercase text-white">Básica</h3>
                                </div>
								<!-- 
									<div class="wthree-list-grid d-flex flex-wrap">
										<div class="wthree-list-icon">
											<span class="fa fa-user-circle" aria-hidden="true"></span>
										</div>
										<div class="wthree-list-desc">
											<h5>Nombres</h5>
											<p>Consectetur adipiscing elit estibulum nibh urna.</p>
										</div>
									</div>
									<div class="wthree-list-grid d-flex flex-wrap">
										<div class="wthree-list-icon">
											<span class="fa fa-money" aria-hidden="true"></span>
										</div>
										<div class="wthree-list-desc">
											<h5>affordable</h5>
											<p>Elit consectetur adipiscing estibulum nibh urna.</p>
										</div>
									</div>
									<div class="wthree-list-grid d-flex flex-wrap">
										<div class="wthree-list-icon">
											<span class="fa fa-picture-o" aria-hidden="true"></span>
										</div>
										<div class="wthree-list-desc">
											<h5>quality</h5>
											<p>Consectetur adipiscing elit estibulum nibh urna.</p>
										</div>
									</div>
								-->
								
								<div class="wthree-list-grid d-flex flex-wrap">
									<div class="wthree-list-icon">
										<span class="fa fa-user-circle" aria-hidden="true"></span>
									</div>
									<div class="wthree-list-desc">
										<h5>IP Actual de Conexion</h5>
										<p><?php echo ($session->user_ip); ?></p>
									</div>
								</div>
								
								<div class="wthree-list-grid d-flex flex-wrap">
									<div class="wthree-list-icon">
										<span class="fa fa-user-circle" aria-hidden="true"></span>
									</div>
									<div class="wthree-list-desc">
										<h5>Usuario</h5>
										<p><?php echo ($session->username); ?></p>
									</div>
								</div>
								
								<div class="wthree-list-grid d-flex flex-wrap">
									<div class="wthree-list-icon">
										<span class="fa fa-user-circle" aria-hidden="true"></span>
									</div>
									<div class="wthree-list-desc">
										<h5>Nombres y Apeliidos</h5>
										<p>
											<?php echo ($session->names); ?> <?php echo ($session->surname); ?> <?php echo ($session->second_surname); ?>
										</p>
									</div>
								</div>
								
								<div class="wthree-list-grid d-flex flex-wrap">
									<div class="wthree-list-icon">
										<span class="fa fa-user-circle" aria-hidden="true"></span>
									</div>
									<div class="wthree-list-desc">
										<h5>Correo Electronico</h5>
										<p><?php echo ($session->mail); ?></p>
									</div>
								</div>
								
								<div class="wthree-list-grid d-flex flex-wrap">
									<div class="wthree-list-icon">
										<span class="fa fa-user-circle" aria-hidden="true"></span>
									</div>
									<div class="wthree-list-desc">
										<h5>Teléfono</h5>
										<p><?php echo ($session->phone); ?></p>
									</div>
								</div>
								
								<div class="wthree-list-grid d-flex flex-wrap">
									<div class="wthree-list-icon">
										<span class="fa fa-user-circle" aria-hidden="true"></span>
									</div>
									<div class="wthree-list-desc">
										<h5>Móvil</h5>
										<p><?php echo ($session->mobile); ?></p>
									</div>
								</div>
								
								<div class="wthree-list-grid d-flex flex-wrap">
									<div class="wthree-list-icon">
										<span class="fa fa-user-circle" aria-hidden="true"></span>
									</div>
									<div class="wthree-list-desc">
										<h5>Avatar</h5>
										<p>
											<br><img class="img-thumbnail" width="250px" src="/media/images/<?php echo ($session->avatar); ?>" />
										</p>
									</div>
								</div>
								
								
								<?php 									
								/*
								foreach($session As $UserItemK=>$UserItemV)
									{
										if($UserItemK !== 'server' || $UserItemK !== 'route' || $UserItemK !== 'routes2' || $UserItemK !== 'permissions' || $UserItemK !== 'hash'){	
											?>
											<div class="wthree-list-grid d-flex flex-wrap">
												<div class="wthree-list-icon">
													<span class="fa fa-phone" aria-hidden="true"></span>
												</div>
												<div class="wthree-list-desc">
													<h5><?php echo "{$UserItemK}"; ?></h5>
													<p>
														<?php echo json_encode($UserItemV); ?>
													</p>
												</div>
											</div>
											<?php 
										}
									}
								$mySession = new User($session);

								foreach($mySession As $UserItemK=>$UserItemV)
									{
										if($UserItemK !== 'server' || $UserItemK !== 'route' || $UserItemK !== 'routes2' || $UserItemK !== 'permissions' || $UserItemK !== 'hash'){	
											?>
											<div class="wthree-list-grid d-flex flex-wrap">
												<div class="wthree-list-icon">
													<span class="fa fa-phone" aria-hidden="true"></span>
												</div>
												<div class="wthree-list-desc">
													<h5><?php echo "{$UserItemK}"; ?></h5>
													<p>
														<?php echo json_encode($UserItemV); ?>
													</p>
												</div>
											</div>
											<?php 
										}
									}
									
								*/
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6  py-5">
                <div class="rgrid-agileits">
                    <h4>Informacion <br> Usuario <br> 
						<?php 
							echo "# ".$session->id;
						?>
					</h4>
                    <span class="about-line" data-blast="bgColor"></span>
                </div>
            </div>
        </div>
    </section>
    <!-- //about -->
    
    <!-- services -->
    <div class="row  no-gutters align-items-center abbot-main flex-row-reverse" id="services">
        <div class="col-lg-6 about-grid-agileits py-5" data-blast="bgColor">
            <div class="about-grid">
                <div class="container">
                    <div class="d-flex">
                        <div class="mx-auto">
                            <div class="title-section py-lg-5 pb-4">
                                <h4>Listado de: </h4>
                                <h3 class="w3ls-title text-uppercase text-white">Empresas </h3>
                            </div>
							<?php
								$pdo = new PDO("mysql:host=".HOST_DB.";dbname=".NAME_DB, USER_DB, PASS_DB);
								$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								#$pdo->exec("SET CHARACTER SET utf8; SET COLLATION SET utf8_unicode_ci");
								$stmt = $pdo->prepare("SELECT `clients`.*
									FROM `users_clients` 
									LEFT JOIN `clients` ON `clients`.`id` = `users_clients`.`client`
									WHERE `users_clients`.`user` IN ('{$session->id}') LIMIT 1000");
								$stmt->execute();
								$result = ($stmt->fetchAll(PDO::FETCH_OBJ));
								$resultTotal = count($result);
								
								
								foreach($result As $item)
								{
									?>
									<div class="wthree-list-grid d-flex flex-wrap">
										<div class="wthree-list-icon">
											<span class="fa fa-money" aria-hidden="true"></span>
										</div>
										<div class="wthree-list-desc">
											<h5><?php echo $item->identification_number; ?> - <?php echo $item->social_reason; ?></h5>
											<p></p>
											<p><?php echo $item->tradename; ?></p>
										</div>
									</div>
									<?php
								}
								
							?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6  py-sm-5 py-4">
            <div class="lgrid-agileits">
                <h4>Mis <br> Empresas <br> </h4>
                <span class="about-line" data-blast="bgColor"></span>
            </div>
        </div>
    </div>
	<!-- 
    <div class="row  no-gutters align-items-center abbot-main">
        <div class="col-lg-6 about-grid-agileits py-sm-5 py-4" data-blast="bgColor">
            <div class="about-grid">
                <div class="container">
                    <div class="d-flex">
                        <div class="mx-auto">
                            <div class="title-section py-lg-5 pb-4">
                                <h4>Power Tools</h4>
                                <h3 class="w3ls-title text-uppercase text-white">unique features</h3>
                            </div>
                            <div class="wthree-list-grid d-flex flex-wrap">
                                <div class="wthree-list-icon">
                                    <span class="fa fa-thumbs-up" aria-hidden="true"></span>
                                </div>
                                <div class="wthree-list-desc">
                                    <h5>vision</h5>
                                    <p>Consectetur adipiscing elit estibulum nibh urna.</p>
                                </div>
                            </div>
                            <div class="wthree-list-grid d-flex flex-wrap">
                                <div class="wthree-list-icon">
                                    <span class="fa fa-money" aria-hidden="true"></span>
                                </div>
                                <div class="wthree-list-desc">
                                    <h5>affordable</h5>
                                    <p>Elit consectetur adipiscing estibulum nibh urna.</p>
                                </div>
                            </div>
                            <div class="wthree-list-grid d-flex flex-wrap">
                                <div class="wthree-list-icon">
                                    <span class="fa fa-picture-o" aria-hidden="true"></span>
                                </div>
                                <div class="wthree-list-desc">
                                    <h5>quality</h5>
                                    <p>Consectetur adipiscing elit estibulum nibh urna.</p>
                                </div>
                            </div>
                            <div class="wthree-list-grid d-flex flex-wrap">
                                <div class="wthree-list-icon">
                                    <span class="fa fa-phone" aria-hidden="true"></span>
                                </div>
                                <div class="wthree-list-desc">
                                    <h5>24*7 support</h5>
                                    <p>Adipiscing consectetur elit estibulum nibh urna.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6  px-sm-5 mx-auto py-lg-0 py-4">
            <section class="px-sm-5 px-3 accordion-agile">
                <div class="typo-grid my-auto">
                    <div class="panel-group" id="accordion4" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne4">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseOne4"
                                        aria-expanded="true" aria-controls="collapseOne4" data-blast="bgColor">
                                        <i class="icon fa fa-globe text-white"></i>
                                        Section 1
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne4">
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent
                                        nisl
                                        lorem,
                                        dictum id pellentesque at, vestibulum ut arcu. Curabitur erat
                                        libero,
                                        egestas
                                        eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet
                                        lectus,
                                        blandit
                                        posuere tortor aliquam vitae. Curabitur molestie eros. </p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion4"
                                        href="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4"
                                        data-blast="bgColor">
                                        <i class="icon fa fa-briefcase text-white"></i>
                                        Section 2
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo4">
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent
                                        nisl
                                        lorem,
                                        dictum id pellentesque at, vestibulum ut arcu. Curabitur erat
                                        libero,
                                        egestas
                                        eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet
                                        lectus,
                                        blandit
                                        posuere tortor aliquam vitae. Curabitur molestie eros. </p>
                                </div>
                            </div>
                        </div>
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4"data-blast="bgColor">
                                        <i class="icon fa fa-mobile text-white"></i>
                                        Section 3
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree4">
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl lorem, dictum id pellentesque at, vestibulum ut arcu. Curabitur erat libero, egestas eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet lectus, blandit posuere tortor aliquam vitae. Curabitur molestie eros. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
    <!-- //services -->
    <!-- team  --
    <section class="pb-sm-5 py-4 team-agile" id="team">
        <div class="container py-md-5">
            <div class="title-section py-lg-5">
                <h4>the CRM</h4>
                <h3 class="w3ls-title text-uppercase">professionals</h3>
            </div>
            <div class="d-flex team-agile-row pt-sm-5 pt-3">
                <div class="col-lg-4 col-md-6">
                    <div class="box20">
                        <img src="images/t2.jpg" alt="" class="img-fluid" />
                        <div class="box-content">
                            <h3 class="title">willimson</h3>
                            <span class="post">Designation</span>
                        </div>
                        <ul class="icon">
                            <li>
                                <a href="#">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-md-0 mt-4">
                    <div class="box20">
                        <img src="images/t1.jpg" alt="" class="img-fluid" />
                        <div class="box-content">
                            <h3 class="title">Kristiana</h3>
                            <span class="post">Designation</span>
                        </div>
                        <ul class="icon">
                            <li>
                                <a href="#">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-lg-0 mt-4 mx-auto">
                    <div class="box20">
                        <img src="images/t3.jpg" alt="" class="img-fluid" />
                        <div class="box-content">
                            <h3 class="title">franklin</h3>
                            <span class="post">Designation</span>
                        </div>
                        <ul class="icon">
                            <li>
                                <a href="#">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //team -->
    <!-- slide --
    <div class="container slide-wthree">
        <div class="row">
            <div class="col-lg-6 mx-auto text-center">
                <h6 class="slide-head">CRM - <span>we make it easy to set.</span>
                </h6>
                <img src="images/slide.png" class="img-fluid" alt="" />
                <p>grow your audience.monitize your passion</p>
            </div>
        </div>
    </div>
    <!-- //slide -->
    <!-- testimonials Carousel --
    <section class="py-lg-5" id="testi">
        <div class="container-fluid">
            <div class="row  no-gutters testi-bg1" data-blast="bgColor">
                <div class="col-lg-7">
                    <div class="testi-bg">
                    </div>
                </div>
                <div class="col-lg-5 my-auto py-lg-0 py-5 " data-blast="bgColor">
                    <div class="title-section pb-lg-5 pb-4 text-center">
                        <h4>WE HAVE</h4>
                        <h3 class="w3ls-title text-uppercase">2817 happy users</h3>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active text-center  testi-cgrid">
                                <div class="testi-icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>

                                <p class="mx-auto text-capitalize">onec consequat sapien ut leo cursus
                                    rhoncus. Nullam dui
                                    mi,
                                    vulputate ac metus semper.</p>
                                <h6 class="b-w3ltxt  mt-4">steve</h6>
                            </div>
                            <!-- slider text -->
                            <div class="carousel-item text-center testi-cgrid">
                                <div class="testi-icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <p class="mx-auto text-capitalize">onec consequat sapien ut leo cursus
                                    rhoncus. Nullam dui
                                    mi,
                                    vulputate ac metus semper.</p>
                                <h6 class="b-w3ltxt mt-4">morrison</h6>
                            </div>
                            <!-- slider text -->
                            <div class="carousel-item text-center testi-cgrid">
                                <div class="testi-icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <p class="mx-auto text-capitalize">onec consequat sapien ut leo cursus
                                    rhoncus. Nullam dui
                                    mi,
                                    vulputate ac metus semper.</p>
                                <h6 class="b-w3ltxt  mt-4">coliis</h6>
                            </div>
                            <!-- slider text -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonials Carousel -->