<?php global $site, $session; ?>
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
										<br><img class="img-thumbnail" width="50px" src="/media/images/<?php echo ($session->avatar); ?>?w=50" />
									</p>
								</div>
							</div>
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
                                <h3 class="w3ls-title text-uppercase text-white">Empresas (<?php echo $session->myBusinessTotal; ?>) </h3>
                            </div>
							<?php
								foreach($session->myBusiness As $item)
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
										<p>
											<a class="btn btn-secondary" href="<?php echo path_homeClients; ?>/CustomerPortal/companies/#/<?php echo ($item->id); ?>">
												Ingresar
											</a>
										</p>
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
    <!-- contact -->
    <section class="wthree-row  w3-contact" id="contact">
        <div class="container py-5">
            <div class="title-section py-lg-5 text-center">
                <h4>¿Desear hablar con un asesor?</h4>
                <h3 class="w3ls-title text-uppercase">CONTACTANOS</h3>
            </div>
            <div class="row contact-form pt-5">
                <div class="offset-lg-2"></div>
                <div class="col-lg-8 wthree-form-left">
                    <!-- contact form grid -->
                    <fieldset class="contact-top1" data-blast="borderColor">
                        <legend class="text-dark mb-4 text-capitalize" data-blast="bgColor">Envíenos una nota</legend>
						<!-- Coloque esta etiqueta donde usted quiera que el Plugin Live Helper sea desplegado -->
						<div id="lhc_status_container_page" ></div>

						<!--
                        <form action="#" method="get" class="f-color">
                            <div class="form-group">
                                <label for="contactusername">Nombresy Apellidos</label>
                                <input type="text" class="form-control" id="contactusername" required placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="contactemail">Email</label>
                                <input type="email" class="form-control" id="contactemail" required placeholder="Enter your Email">
                            </div>
                            <div class="form-group">
                                <label for="contactcomment">Your Message</label>
                                <textarea class="form-control" rows="5" id="contactcomment" required placeholder="your message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                        </form>-->
                    </fieldset>
                    <!--  //contact form grid ends here -->
                </div>
                <div class="offset-lg-2"></div>
            </div>
            <div class="row contact-form pt-5">
                <div class="offset-lg-2"></div>
                <div class="col-lg-8 wthree-form-left">
					<!-- Place this tag where you want the Live Helper FAQ module to render. -->
					<div id="lhc_faq_embed_container" ></div>

					<!-- Place this tag after the Live Helper Plugin tag. -->
					<script type="text/javascript">
					var LHCChatOptionsPage = {};
					LHCChatOptionsPage.opt = {};
					(function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = '//livecenter.dataservix.com/index.php/esp/chat/getstatusembed/(department)/1';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
					})();
					</script>
					<!-- Place this tag after the Live Helper FAQ module tag. -->
					<script type="text/javascript">
					var LHCFAQOptions = {url:'replace_me_with_dynamic_url',identifier:''};
					(function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = '//livecenter.dataservix.com/index.php/esp/faq/embed';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
					})();
					</script>
                </div>
                <div class="offset-lg-2"></div>
            </div>
            <div class="contact-form pt-5">
                <div class="row contact-bottom">
                    <div class="col-md-4">
                        <div class="address">
                            <h5 class="pb-3 text-capitalize" data-blast="color">Dirección para correspondencia</h5>
                            <address>
                                <p class="c-txt">Calle 33 aa # 80 b 34 Int 201 Laureles, Medellín.</p>
                            </address>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="address my-md-0 my-4">
                            <h5 class="pb-3 text-capitalize" data-blast="color">phone</h5>
                            <p>(+57) 301 720 65 60</p>
                            <p>(+57) (4) 413 90 26</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="address mt-md-0 mt-3">
                            <h5 class="pb-3 text-capitalize" data-blast="color">Correo Electronico</h5>
                            <p>
                                <a href="mailto:atencionalcliente@monteverdeltda.com">atencionalcliente@monteverdeltda.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //contact -->
    <!-- contact map grid -->
    <div class="map contact-right">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.1733346907254!2d-75.60484533564471!3d6.240872528116773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e442999ea1f26d7%3A0x946c23fb81512f74!2sMonteverde+Servicios+Forestales%2C+Ambientales+y+Paisajismo!5e0!3m2!1ses!2sco!4v1549904589818"
            allowfullscreen data-blast="borderColor"></iframe>
    </div>
    <!--//contact map grid -->