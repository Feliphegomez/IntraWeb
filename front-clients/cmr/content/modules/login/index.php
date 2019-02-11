<?php
	global $session;
	$fields = $session->Route->fields;
	if($session->id > 0){
		echo '<meta http-equiv="refresh" content="0; url='.path_home.'out" />';
		exit("Ya tienes una sesión iniciada, espere mientras procedemos con el cierre...");
	}
	
	# echo $fields['inputEmail'];
	# echo $fields['inputPassword'];
?>
<div id="home" class="banner" data-blast="bgColor">
	<div class="container-fluid">
		<div class="row banner-row">
			<div class="col-lg-8 bg-img text-center">
				<h3 class="agile-title">Controla tus servicios y actividades.</h3>
				<div class="bnr-img">
					<img src="images/palette.png" alt="" class="img-fluid m-auto" />
				</div>
			</div>
			<div class="col-lg-4  my-auto p-0">

				<div id="login-row">
					<h4>¡Inicia sesión ahora!</h4>
					<div id="login-column">
						<div class="box">
							<div class="shape1 shape-bg"></div>
							<div class="shape2 shape-bg"></div>
							<div class="shape3 shape-bg"></div>
							<div class="shape4 shape-bg"></div>
							<div class="shape5 shape-bg"></div>
							<div class="shape6 shape-bg"></div>
							<div class="shape7 shape-bg"></div>
							<div class="float text-center">
								<form class="form" action="#" method="post">
									<div class="form-group">
										<label for="inputNickLogin">Usuario</label><br>
										<input type="text" name="inputNickLogin" id="inputNickLogin" class="form-control text-center" placeholder="Usuario" required />
									</div>
									<div class="form-group">
										<label for="inputPasswordLogin">Contraseña</label><br>
										<input type="password" name="inputPasswordLogin" id="inputPasswordLogin" class="form-control text-center" placeholder="*****" required />
									</div>
									<div class="form-group btn-agile">
										<input type="submit" name="submit" class="btn btn-success btn-md" value="Ingresar">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>