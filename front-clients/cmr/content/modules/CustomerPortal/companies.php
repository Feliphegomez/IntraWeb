
<div>
    <section class="wthree-row" id="contact">
        <div class="container py-5">
			<section class="row" id="app">
				<div class="col-lg-12 py-5" data-blast="bgColor">
					<router-view></router-view>
				</div>
			</section>
		</div>
	</div>
</div>

<template id="page-Company-Info-View">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 ">
					<div class="list-group ">
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Info-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Dashboard
						</router-link>
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Requests-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Solicitudes & Proyectos
						</router-link>
					 
						<a href="<?php echo path_homeClients; ?>" class="list-group-item list-group-item-action">Volver</a>
					</div> 
				</div>
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<h4>Compañia</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Tipo de Cliente</label>
											<div class="col-8">
												{{ post.type.name }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Tipo de Identificacion</label>
											<div class="col-8">
												{{ post.identification_type.name }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Numero de Identificacion</label>
											<div class="col-8">
												{{ post.identification_number }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Nombre Comercial</label>
											<div class="col-8">
												{{ post.social_reason }}
											</div>
										</div>										
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Nombre Comercial</label>
											<div class="col-8">
												{{ post.tradename }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Departamento</label>
											<div class="col-8">
												{{ post.department.name }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Ciudad</label>
											<div class="col-8">
												{{ post.city.name }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Direccion Principal</label>
											<div class="col-8">
												{{ post.address }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Representante Legal</label>
											<div class="col-8">
												Identificacion: {{ post.legal_representative.identification_number }}
												<br>
												Nombre Completo: {{ post.legal_representative.first_name }} {{ post.legal_representative.second_name }} {{ post.legal_representative.surname }}  {{ post.legal_representative.second_surname }} 
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Contacto Principal</label>
											<div class="col-8">
												Identificacion: {{ post.contact_principal.identification_number }}
												<br>
												Nombre Completo: {{ post.contact_principal.first_name }} {{ post.contact_principal.second_name }} {{ post.contact_principal.surname }}  {{ post.contact_principal.second_surname }} 
											</div>
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
</template>
	
<template id="page-Company-Invoices-View">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 ">
					<div class="list-group ">
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Info-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Dashboard
						</router-link>
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Requests-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Solicitudes & Proyectos
						</router-link>
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Invoices-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Facturas
						</router-link>
						
						<a href="<?php echo path_homeClients; ?>" class="list-group-item list-group-item-action">Volver</a>
					</div> 
				</div>
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<h4>Facturas</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Tipo de Cliente</label>
											<div class="col-8">
												{{ post.type.name }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Tipo de Identificacion</label>
											<div class="col-8">
												{{ post.identification_type.name }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Numero de Identificacion</label>
											<div class="col-8">
												{{ post.identification_number }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Nombre Comercial</label>
											<div class="col-8">
												{{ post.social_reason }}
											</div>
										</div>										
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Nombre Comercial</label>
											<div class="col-8">
												{{ post.tradename }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Departamento</label>
											<div class="col-8">
												{{ post.department.name }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Ciudad</label>
											<div class="col-8">
												{{ post.city.name }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Direccion Principal</label>
											<div class="col-8">
												{{ post.address }}
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Representante Legal</label>
											<div class="col-8">
												Identificacion: {{ post.legal_representative.identification_number }}
												<br>
												Nombre Completo: {{ post.legal_representative.first_name }} {{ post.legal_representative.second_name }} {{ post.legal_representative.surname }}  {{ post.legal_representative.second_surname }} 
											</div>
										</div>
										<div class="form-group row">
											<label for="username" class="col-4 col-form-label">Contacto Principal</label>
											<div class="col-8">
												Identificacion: {{ post.contact_principal.identification_number }}
												<br>
												Nombre Completo: {{ post.contact_principal.first_name }} {{ post.contact_principal.second_name }} {{ post.contact_principal.surname }}  {{ post.contact_principal.second_surname }} 
											</div>
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
</template>
	
<template id="page-Company-Requests-View">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 ">
					<div class="list-group ">
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Info-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Dashboard
						</router-link>
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Requests-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Solicitudes & Proyectos
						</router-link>
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Invoices-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Facturas
						</router-link>
						
						<a href="<?php echo path_homeClients; ?>" class="list-group-item list-group-item-action">Volver</a>
					</div> 
				</div>
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<h4>Solicitudes & Proyectos</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
										<li class="nav-item" v-for="item in posts">
											<a class="nav-link" data-toggle="pill" v-bind:id="'#pills-' + item.id + '-tab'" v-bind:href="'#pills-' + item.id" role="tab" aria-controls="pills-profile" aria-selected="false">
											{{ item.name }}
											</a>
										</li>
									</ul>
									<div class="tab-content" id="pills-tabContent">
										<div class="tab-pane fade" v-for="item in posts" v-bind:id="'pills-' + item.id" role="tabpanel" v-bind:aria-labelledby="'#pills-' + item.id + '-tab'">
											<div class="container">
												<div class="title">
												  <h3>{{ item.name }}</h3>
												</div>
												<div class="row">
													<div class="col-md-12">
														<h3><small>{{ item.id }}</small></h3>
														<!-- Tabs with icons on Card -->
														<div class="card card-nav-tabs">
															<div class="card-header card-header-primary">
																<!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
																<div class="nav-tabs-navigation">
																	<div class="nav-tabs-wrapper">
																		<ul class="nav nav-tabs" data-tabs="tabs">
																			<li class="nav-item">
																				<a class="nav-link active" href="#profile" data-toggle="tab">
																					<i class="material-icons"></i>
																					Info
																				</a>
																			</li>
																			<li class="nav-item">
																				<a class="nav-link" href="#messages" data-toggle="tab">
																					<i class="material-icons"></i>
																					Propuestas
																				</a>
																			</li>
																			<li class="nav-item">
																				<a class="nav-link" href="#settings" data-toggle="tab">
																					<i class="material-icons"></i>
																					Settings
																				</a>
											
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
															<div class="card-body ">
																<div class="tab-content text-center">
																	<div class="tab-pane active" id="profile">
																		<p>
																			<table class="table table-bordered">
																				<thead>
																				</thead>
																				<tbody>
																					<tr>
																						<th>Nombre Proyecto/Solicitud</th>
																						<td>{{ item.name }}</td>
																					</tr>
																					<tr>
																						<th>Direccion</th>
																						<td>{{ item.name }}</td>
																					</tr>
																					<tr>
																						<th>More</th>
																						<td>{{ item }}</td>
																					</tr>
																				</tbody>
																			</table>
																		</p>
																	</div>
																	<div class="tab-pane" id="messages">
																		<p> PROPUESTAS</p>
																	</div>
																	<div class="tab-pane" id="settings">
																		<p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
																	</div>
																</div>
															</div>
														</div>
														<!-- End Tabs with icons on Card -->
													</div>
													<!--
													<div class="col-md-12">
														<h3><small>Tabs on Plain Card</small></h3>
														<div class="card card-nav-tabs card-plain">
															<div class="card-header card-header-danger">
																<!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" --
																<div class="nav-tabs-navigation">
																	<div class="nav-tabs-wrapper">
																		<ul class="nav nav-tabs" data-tabs="tabs">
																			<li class="nav-item">
																				<a class="nav-link active" href="#home" data-toggle="tab">Home</a>
																			</li>
																			<li class="nav-item">
																				<a class="nav-link" href="#updates" data-toggle="tab">Updates</a>
																			</li>
																			<li class="nav-item">
																				<a class="nav-link" href="#history" data-toggle="tab">History</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</div><div class="card-body ">
																<div class="tab-content text-center">
																	<div class="tab-pane active" id="home">
																		<p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
																	</div>
																	<div class="tab-pane" id="updates">
																		<p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
																	</div>
																	<div class="tab-pane" id="history">
																		<p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
																	</div>
																</div>
															</div></div>
													</div>-->
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
		</div>
	</div>
</template>
	<style scoped="page-Company-Requests-View">
		html *{
			-webkit-font-smoothing: antialiased;
		}
		h3{
			font-size: 25px !important;
			margin-top: 20px;
			margin-bottom: 10px;
			line-height: 1.4em !important;
		}

		p {
			font-size: 14px;
			margin: 0 0 10px !important;
			font-weight: 300;
		} 

		 small {
			font-size: 75%;
			color: #777;
			font-weight: 400;
		}

		.container .title{
			color: #3c4858;
			text-decoration: none;
			margin-top: 30px;
			margin-bottom: 25px;
			min-height: 32px;
		}

		.container .title h3{
			font-size: 25px;
			font-weight: 300;
		}

		div.card {
			border: 0;
			margin-bottom: 30px;
			margin-top: 30px;
			border-radius: 6px;
			color: rgba(0,0,0,.87);
			background: #fff;
			width: 100%;
			box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
		}

		div.card.card-plain {
			background: transparent;
			box-shadow: none;
		}
		div.card .card-header {
			border-radius: 3px;
			padding: 1rem 15px;
			margin-left: 15px;
			margin-right: 15px;
			margin-top: -30px;
			border: 0;
			background: linear-gradient(60deg,#eee,#bdbdbd);
		}

		.card-plain .card-header:not(.card-avatar) {
			margin-left: 0;
			margin-right: 0;
		}

		.div.card .card-body{
			padding: 15px 30px;
		}

		div.card .card-header-primary {
			background: linear-gradient(60deg,#ab47bc,#7b1fa2);
			box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(156,39,176,.6);
		}

		div.card .card-header-danger {
			background: linear-gradient(60deg,#ef5350,#d32f2f);
			box-shadow: 0 5px 20px 0 rgba(0,0,0,.2), 0 13px 24px -11px rgba(244,67,54,.6);
		}


		.card-nav-tabs .card-header {
			margin-top: -30px!important;
		}

		.card .card-header .nav-tabs {
			padding: 0;
		}

		.nav-tabs {
			border: 0;
			border-radius: 3px;
			padding: 0 15px;
		}

		.nav {
			display: flex;
			flex-wrap: wrap;
			padding-left: 0;
			margin-bottom: 0;
			list-style: none;
		}

		.nav-tabs .nav-item {
			margin-bottom: -1px;
		}

		.nav-tabs .nav-item .nav-link.active {
			background-color: hsla(0,0%,100%,.2);
			transition: background-color .3s .2s;
		}

		.nav-tabs .nav-item .nav-link{
			border: 0!important;
			color: #fff!important;
			font-weight: 500;
		}

		.nav-tabs .nav-item .nav-link {
			color: #fff;
			border: 0;
			margin: 0;
			border-radius: 3px;
			line-height: 24px;
			text-transform: uppercase;
			font-size: 12px;
			padding: 10px 15px;
			background-color: transparent;
			transition: background-color .3s 0s;
		}

		.nav-link{
			display: block;
		}

		.nav-tabs .nav-item .material-icons {
			margin: -1px 5px 0 0;
			vertical-align: middle;
		}

		.nav .nav-item {
			position: relative;
		}
		footer{
			margin-top:100px;
			color: #555;
			background: #fff;
			padding: 25px;
			font-weight: 300;
			
		}
		.footer p{
			margin-bottom: 0;
			font-size: 14px;
			margin: 0 0 10px;
			font-weight: 300;
		}
		footer p a{
			color: #555;
			font-weight: 400;
		}

		footer p a:hover {
			color: #9f26aa;
			text-decoration: none;
		}
	</style>
	
<template id="page-Company-Info-Edit">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 ">
					 <div class="list-group ">
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Info-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Dashboard
						</router-link>
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Requests-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Solicitudes & Proyectos
						</router-link>
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Invoices-View', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Facturas
						</router-link>
					</div> 
				</div>
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<h4>Compañia</h4>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<form>
									  <div class="form-group row">
										<label for="username" class="col-4 col-form-label">User Name*</label> 
										<div class="col-8">
										  <input id="username" name="username" placeholder="Username" class="form-control here" required="required" type="text">
										</div>
									  </div>
									  <div class="form-group row">
										<label for="name" class="col-4 col-form-label">First Name</label> 
										<div class="col-8">
										  <input id="name" name="name" placeholder="First Name" class="form-control here" type="text">
										</div>
									  </div>
									  <div class="form-group row">
										<label for="lastname" class="col-4 col-form-label">Last Name</label> 
										<div class="col-8">
										  <input id="lastname" name="lastname" placeholder="Last Name" class="form-control here" type="text">
										</div>
									  </div>
									  <div class="form-group row">
										<label for="text" class="col-4 col-form-label">Nick Name*</label> 
										<div class="col-8">
										  <input id="text" name="text" placeholder="Nick Name" class="form-control here" required="required" type="text">
										</div>
									  </div>
									  <div class="form-group row">
										<label for="select" class="col-4 col-form-label">Display Name public as</label> 
										<div class="col-8">
										  <select id="select" name="select" class="custom-select">
											<option value="admin">Admin</option>
										  </select>
										</div>
									  </div>
									  <div class="form-group row">
										<label for="email" class="col-4 col-form-label">Email*</label> 
										<div class="col-8">
										  <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text">
										</div>
									  </div>
									  <div class="form-group row">
										<label for="website" class="col-4 col-form-label">Website</label> 
										<div class="col-8">
										  <input id="website" name="website" placeholder="website" class="form-control here" type="text">
										</div>
									  </div>
									  <div class="form-group row">
										<label for="publicinfo" class="col-4 col-form-label">Public Info</label> 
										<div class="col-8">
										  <textarea id="publicinfo" name="publicinfo" cols="40" rows="4" class="form-control"></textarea>
										</div>
									  </div>
									  <div class="form-group row">
										<label for="newpass" class="col-4 col-form-label">New Password</label> 
										<div class="col-8">
										  <input id="newpass" name="newpass" placeholder="New Password" class="form-control here" type="text">
										</div>
									  </div> 
									  <div class="form-group row">
										<div class="offset-4 col-8">
										  <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>
										</div>
									  </div>
									</form>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>Codigo</th>
								<th>Nombre</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Codigo</th>
								<th>Nombre</th>
								<th>Actions</th>
							</tr>
						</tfoot>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
	
<!-- // ------------ FIN -------------------------------------  -->
