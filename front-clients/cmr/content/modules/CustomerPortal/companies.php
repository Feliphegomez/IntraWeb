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

<!-- // SIDEBAR -->
<template id="Sidebar-Clients-Component">
	<div>
		<div class="list-group ">
			<router-link class="list-group-item list-group-item-action" 
			  v-bind:to="{name: 'Company-Info-View', params: { company_id: this.$route.params.company_id }}">
				<i class="fa fa-home"></i> 
				General
			</router-link>
			<router-link class="list-group-item list-group-item-action" 
			  v-bind:to="{name: 'Company-Requests-List', params: { company_id: this.$route.params.company_id }}">
				<i class="fa fa-home"></i> 
				Solicitudes & Proyectos
			</router-link>
			<router-link class="list-group-item list-group-item-action" 
			  v-bind:to="{name: 'Company-Invoices-List', params: { company_id: this.$route.params.company_id }}">
				<i class="fa fa-home"></i> 
				Facturas
			</router-link>
		 
			<router-link v-if="$route.params.quotation_id != undefined" class="list-group-item list-group-item-action" 
			  v-bind:to="{name: 'Company-Requests-View', params: { company_id: this.$route.params.company_id, request_id: this.$route.params.request_id }}">
				<i class="fa fa-home"></i> 
				Volver
			</router-link>
			
			<a v-if="$route.params.quotation_id == undefined" href="<?php echo path_homeClients; ?>" class="list-group-item list-group-item-action">Volver</a>
			
		</div> 
		<div class="container">
			<h3>{{ company_id }}</h3>
		</div>
	</div>
</template>
<!-- SIDEBAR // -->

<!-- INICIO -->
<template id="page-Company-Info-View">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 ">
					<component-sidebar-clients></component-sidebar-clients>
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
	
<template id="page-Company-Invoices-List">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 ">
					<div class="list-group ">
						<component-sidebar-clients></component-sidebar-clients>
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
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped="page-Company-Requests-List">
	* { margin: 0px; padding: 0px; }
	body {
		/* background: #ecf1f5; */
		font:14px "Open Sans", sans-serif; 
		text-align:center;
	}

	.tile{
		width: 100%;
		background:#fff;
		border-radius:5px;
		box-shadow:0px 2px 3px -1px rgba(151, 171, 187, 0.7);
		float:left;
		transform-style: preserve-3d;
		margin: 10px 5px;

	}

	.header{
		border-bottom:1px solid #ebeff2;
		padding:19px 0;
		text-align:center;
		color:#59687f;
		font-size:600;
		font-size:19px;	
		position:relative;
	}

	.banner-img {
		padding: 5px 5px 0;
	}

	.banner-img img {
		width: 100%;
		border-radius: 5px;
	}

	.dates{
		border:1px solid #ebeff2;
		border-radius:5px;
		padding:20px 0px;
		margin:5px 5px;
		font-size:16px;
		color:#5aadef;
		font-weight:600;	
		overflow:auto;
	}
	.dates div{
		float:left;
		width:50%;
		text-align:center;
		position:relative;
	}
	.dates strong,
	.stats strong{
		display:block;
		color:#adb8c2;
		font-size:11px;
		font-weight:700;
	}
	.dates span{
		width:1px;
		height:40px;
		position:absolute;
		right:0;
		top:0;	
		background:#ebeff2;
	}
	.stats{
		border-top:1px solid #ebeff2;
		background:#f7f8fa;
		overflow:auto;
		padding:15px 0;
		font-size:16px;
		color:#59687f;
		font-weight:600;
		border-radius: 0 0 5px 5px;
	}
	.stats div{
		border-right:1px solid #ebeff2;
		width: 33.33333%;
		float:left;
		text-align:center
	}

	.stats div:nth-of-type(3){border:none;}

	div.footer {
		text-align: right;
		position: relative;
		margin: 20px 5px;
	}

	div.footer a.Cbtn{
		padding: 10px 25px;
		background-color: #DADADA;
		color: #666;
		margin: 10px 2px;
		text-transform: uppercase;
		font-weight: bold;
		text-decoration: none;
		border-radius: 3px;
	}

	div.footer a.Cbtn-primary{
		background-color: #5AADF2;
		color: #FFF;
	}

	div.footer a.Cbtn-primary:hover{
		background-color: #7dbef5;
	}

	div.footer a.Cbtn-danger{
		background-color: #fc5a5a;
		color: #FFF;
	}

	div.footer a.Cbtn-danger:hover{
		background-color: #fd7676;
	}
</style>

<template id="page-Company-Requests-List">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 ">
					<div class="list-group ">
						<component-sidebar-clients></component-sidebar-clients>
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
									<div class="container-fluid">
										<div class="row">
											<div style="box-shadow: 0px 0px 5px #666;" class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-for="(item, itemKey) in posts">
												<div class="tile">
													<div class="wrapper">
														<div class="header">{{ item.name }}</div>
														<!--<div class="banner-img">
															<img src="http://via.placeholder.com/640x360" alt="Image 1">
														</div>-->
														<div class="dates">
															<div class="start">
																<strong>Creación</strong> {{ item.create }}
																<span></span>
															</div>
															<div class="ends">
																<strong>Actualización</strong> {{ item.update }}
																<span></span>
															</div>
														</div>
														
														<div class="dates">
															<strong>PROPUESTAS RECIBIDAS</strong> {{ item.quotations_clients.length }}
															<span></span>
														</div>

														<div class="stats">
															<strong>CONTACTO PRINCIPAL</strong> {{ item.contact.first_name }} {{ item.contact.second_name }} {{ item.contact.surname }} {{ item.contact.second_surname }} - {{ item.contact.identification_number }}
														</div>
														
														<div class="stats">
															<strong>CONTACTO PRINCIPAL</strong> {{ item.contact.first_name }} {{ item.contact.second_name }} {{ item.contact.surname }} {{ item.contact.second_surname }} - {{ item.contact.identification_number }}
														</div>
														
														<div class="stats">
															<strong>DIRECCION</strong> 
															{{ item.address }}
														</div>
														
														<div class="stats">
															<strong>DIRECCION DE FACTURACION</strong> 
															{{ item.address_invoices }}
														</div>
														
														<!--
														<div class="stats">
															<strong>OBSERVACIONES</strong> 
															{{ item.observations }}
														</div>
														-->
														
														<div class="stats">
															<div><strong>SERVICIOS PRINCIPALES</strong> {{ item.services_clients.length }}</div>
															<div><strong>OTROS SERVICIOS</strong> {{ item.attributes_services_clients.length }}</div>
															<div><strong>TOTAL</strong> {{ item.services_clients.length + item.attributes_services_clients.length }}</div>
														</div>
														
														<div class="footer">
															<router-link class="Cbtn Cbtn-primary" 
															  v-bind:to="{ name: 'Company-Requests-View', params: { company_id: item.client, request_id: item.id } }">
																<i class="fa fa-eye"></i> 
																Visualizar
															</router-link>
															<!-- <a href="#" class="Cbtn Cbtn-danger">Delete</a> -->
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
		</div>
	</div>
</template>

<template id="page-Company-Requests-View">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 ">
					<component-sidebar-clients></component-sidebar-clients>
				</div>
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<h4>Estas viendo el proyecto {{ post.name }} - REF: {{ post.id }}</h4>
									<hr>
									<!-- <h4>{{ post}}</h4> -->
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="table table-responsive">
										<table class="table table-bordered">
											<tr>
												<th>ID</th>
												<td>{{ post.client }}</td>
											</tr>
											<tr>
												<th>Nombre del Proyecto</th>
												<td>{{ post.name }}</td>
											</tr>
											<tr>
												<th>Contacto Principal</th>
												<td>
													<table class="table table-bordered">
														<tr>
															<th>ID</th>
															<td>{{ post.contact.id }}</td>
														</tr>
														<tr>
															<th>Tipo de Identificacion</th>
															<td>{{ post.contact.identification_type.name }}</td>
														</tr>
														<tr>
															<th># de Identificacion</th>
															<td>{{ post.contact.identification_number }}</td>
														</tr>
														<tr>
															<th>Nombres</th>
															<td>{{ post.contact.first_name }} {{ post.contact.second_name }}</td>
														</tr>
														<tr>
															<th>Apellidos</th>
															<td>{{ post.contact.surname }} {{ post.contact.second_surname }}</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<th>Direccion del Proyecto</th>
												<td>{{ post.address }}</td>
											</tr>
											<tr>
												<th>Direccion de Facturacion</th>
												<td>{{ post.address_invoices }}</td>
											</tr>
											<tr>
												<th>Observaciones</th>
												<td>{{ post.observations }}</td>
											</tr>
											<tr>
												<th>Fecha de la Solicitud</th>
												<td>{{ post.create }}</td>
											</tr>
											<tr>
												<th>Última Actualización</th>
												<td>{{ post.create }}</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							
							<!--
							<div class="row">
								<div class="col-md-12">
									<h4>Servicios Actuales</h4>
									<hr>
									<div class="table table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>REF</th>
													<th>Servcio</th>
													<th>Tipo de Medicion</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="item in post.services_clients">
													<td>CSS-{{ item.service.id }}</td>
													<td>{{ item.service.name }}</td>
													<td>{{ item.service.type_medition.code }} ({{ item.service.type_medition.name }})</td>
												</tr>
												<tr v-for="item in post.attributes_services_clients">
													<td>CAS-{{ item.attribute.id }}</td>
													<td>{{ item.attribute.name }}</td>
													<td>{{ item.attribute.type_medition.code }} ({{ item.attribute.type_medition.name }})</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							-->
							
							<div class="row">
								<div class="col-md-12">
									<h4>Propuestas</h4>
									<hr>
									<div class="table table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>REF</th>
													<th>Vigencia</th>
													<th>Estado</th>
													<th>Fecha de Solicitud</th>
													<th>Última Actualización</th>
													<th></th>
												</tr>
											</thead>
											
											<tbody>
												<tr v-for="item in post.quotations_clients">
													<td>{{ item.id }}</td>
													<td>{{ item.validity }}</td>
													<td>{{ item.status.name }}</td>
													<td>{{ item.create }}</td>
													<td>{{ item.update }}</td>
													<td>
														<router-link class="list-group-item list-group-item-action" 
														  v-bind:to="{name: 'Company-Quotations-View', params: { company_id: $route.params.company_id, request_id: $route.params.request_id, quotation_id: item.id }}">
															<i class="fa fa-eye"></i> 
															Ver Propuesta
														</router-link>
														<!--
														<button @click="changeStatusQuotations($route.params.company_id, $route.params.request_id, item.id, 1)" class="btn btn-xs btn-success" v-if="item.status.id == 0">
															<i class="fa fa-check"></i>
														</button>
														
														<table class="table table-bordered">
															<tr>
																<td>Nombre</td>
																<td>description</td>
																<td>type_medition</td>
																<td>price</td>
																<td>JSON</td>
																<td>{{ item.iva }}</td>
															</tr>
															<tr v-for="subitem_i in item.values.services">
																<td>{{ subitem_i.service.name }}</td>
																<td>{{ subitem_i.service.description }}</td>
																<td>{{ subitem_i.service.type_medition.name }}</td>
																<td>{{ subitem_i.service.price }}</td>
																<td>{{ subitem_i }}</td>
															</tr>
														</table>
														-->
													</td>
												</tr>
											</tbody>
										</table>
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

<template id="page-Company-Quotations-View">
	<div>
		<div class="container">
			<div class="row">
				<div class="col-md-3 ">
					<component-sidebar-clients></component-sidebar-clients>
				</div>
				<div class="col-md-9">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<h4>Viendo Propuesta REF: {{ $parent.zfill(post.id, 11) }}</h4>
									<hr>
									<!-- <h4>{{ post}}</h4> -->
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<nav class="navbar navbar-light" style="background-color: #f8f9fa;">
										<div class="navbar-brand" href="#"></div>
										
										<a title="PDF Propuesta" v-if="post.status.id == 0 || post.status.id == 1" v-bind:href="'/api/genQ.php?refQuotations=' + post.id + '&wellcome=false'" target="_new" @click="'Accounts'" class="navbar-toggler btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top">
											<i class="fas fa-file-pdf"></i>
										</a>
										
										<button title="Ver Programacion" v-if="post.status.id == 2" href="#" class="navbar-toggler btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top">
											<i class="fa fa-calendar"></i>
										</button>
									</nav>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="table table-responsive">
										<table class="table table-bordered">
											<tr>
												<th>ID</th>
												<td>{{ post.id }}</td>
											</tr>
											<tr>
												<th>Nombre del Proyecto</th>
												<td>{{ post.account.name }}</td>
											</tr>
											<tr>
												<th>Estado de la Solicitud</th>
												<td>
													{{ post.status.name }}
												</td>
											</tr>
											<tr>
												<th>Contacto Directo</th>
												<td>{{ post.account.contact.first_name }} {{ post.account.contact.second_name }} {{ post.account.contact.surname }} {{ post.account.contact.second_surname }}</td>
											</tr>
											<tr>
												<th>Direccion</th>
												<td>{{ post.account.address }}</td>
											</tr>
											<tr>
												<th>Direccion de Facturacion</th>
												<td>{{ post.account.address_invoices }}</td>
											</tr>
											<tr>
												<th>Fecha de Creacion</th>
												<td>{{ post.account.create }}</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="col-md-12">
									<h4>Gastos</h4><hr>
									<div class="table table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>Nombre</th>
													<th>Cantidad</th>
													<th>Precio</th>
													<th>Tipo de Medicion</th>
													<th>IVA</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="item in post.values.services">
													<td>{{ item.service.id }}</td>
													<td>{{ item.service.name }}</td>
													<td>{{ item.quantity }}</td>
													<td>{{ $parent.formatMoney(item.service.price) }}</td>
													<td>{{ (item.service.type_medition.name) }}</td>
													<td>{{ item.iva }}</td>
													<td>{{ $parent.formatMoney((((item.quantity * item.service.price) / 100 ) * item.iva) + (item.quantity * item.service.price)) }}</td>
												</tr>
												<tr v-for="item in post.values.attributes">
													<td>{{ item.attribute.id }}</td>
													<td>{{ item.attribute.name }}</td>
													<td>{{ item.quantity }}</td>
													<td>{{ $parent.formatMoney(item.attribute.price) }}</td>
													<td>{{ (item.attribute.type_medition.name) }}</td>
													<td>{{ item.iva }}</td>
													<td>{{ $parent.formatMoney((((item.quantity * item.attribute.price) / 100 ) * item.iva) + (item.quantity * item.attribute.price)) }}</td>
												</tr>
											</tbody>
											<tfoot>
											</tfoot>
										</table>
									</div>
								</div>
								
								<div class="col-md-12" v-if="post.status.id == 1">
									<h4>Contratos</h4>
									<hr>
										<button title="Aprobar Contrato" @click="changeStatusQuotations($route.params.company_id, $route.params.request_id, post.id, 2)" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top">
											<i class="fas fa-check"></i>
										</button>
									<hr>
									<div class="table table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>Nombre</th>
													<th>Cantidad</th>
													<th>Precio</th>
													<th>Tipo de Medicion</th>
													<th>IVA</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr v-for="item in post.values.services">
													<td>{{ item.service.id }}</td>
													<td>{{ item.service.name }}</td>
													<td>{{ item.quantity }}</td>
													<td>{{ $parent.formatMoney(item.service.price) }}</td>
													<td>{{ (item.service.type_medition.name) }}</td>
													<td>{{ item.iva }}</td>
													<td>{{ $parent.formatMoney((((item.quantity * item.service.price) / 100 ) * item.iva) + (item.quantity * item.service.price)) }}</td>
												</tr>
												<tr v-for="item in post.values.attributes">
													<td>{{ item.attribute.id }}</td>
													<td>{{ item.attribute.name }}</td>
													<td>{{ item.quantity }}</td>
													<td>{{ $parent.formatMoney(item.attribute.price) }}</td>
													<td>{{ (item.attribute.type_medition.name) }}</td>
													<td>{{ item.iva }}</td>
													<td>{{ $parent.formatMoney((((item.quantity * item.attribute.price) / 100 ) * item.iva) + (item.quantity * item.attribute.price)) }}</td>
												</tr>
											</tbody>
											<tfoot>
										
										<a title="PDF Contrato" v-if="post.status.id == 1" v-bind:href="'/api/genQ.php?refQuotations=' + post.id + '&wellcome=false'" target="_new" @click="'Accounts'" class="navbar-toggler btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top">
											<i class="fas fa-file-pdf"></i>
										</a>
										
										<button title="Aprobar Propuesta" v-if="post.status.id == 0" @click="changeStatusQuotations($route.params.company_id, $route.params.request_id, post.id, 1)" class="navbar-toggler btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top">
											<i class="fas fa-check"></i>
										</button>
											</tfoot>
										</table>
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
						  v-bind:to="{name: 'Company-Requests-List', params: { company_id: this.$route.params.company_id }}">
							<i class="fa fa-home"></i> 
							Solicitudes & Proyectos
						</router-link>
						<router-link class="list-group-item list-group-item-action" 
						  v-bind:to="{name: 'Company-Invoices-List', params: { company_id: this.$route.params.company_id }}">
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
