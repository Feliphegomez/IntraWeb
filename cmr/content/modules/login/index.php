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
<div class="container">
	<div class="card card-login mx-auto mt-5">
		<div class="card-header">Login</div>
		<div class="card-body">
			<form method="POST">
				<div class="form-group">
					<div class="form-label-group">
						<input type="text" name="inputNickLogin" class="form-control" placeholder="Username address" required="required" autofocus="autofocus">
						<label for="inputEmail">Email address</label>
					</div>
				</div>
				<div class="form-group">
					<div class="form-label-group">
						<input type="password" name="inputPasswordLogin" class="form-control" placeholder="Password" required="required">
						<label for="inputPassword">Password</label>
					</div>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label>
							<input type="checkbox" value="remember-me">
							Remember Password
						</label>
					</div>
				</div>
				<button class="btn btn-primary btn-block" type="submit">Login</button>
			</form>
			<div class="text-center">
				<a class="d-block small mt-3" href="register.html">Register an Account</a>
				<a class="d-block small" href="forgot-password.html">Forgot Password?</a>
			</div>
        </div>
	</div>
</div>