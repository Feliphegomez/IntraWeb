<div>
	<div id="app">
		<div>
			<div id="preload"></div>
			<div class="container_not">
				<main>
					<router-view></router-view>
				</main>
			</div>
		</div>
	</div>
</div>
<!-- // ------------ EMPLEADOS INICIO -------------------------------------  -->
<template id="page-Employees">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-success" v-bind:to="{ name: 'Employees-Add' }">
					<span class="fa fa-plus"></span>
					Nuevo
				</router-link>
				Empleados
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th># Identificacion</th>
								<th>Nombre completo</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr v-if="posts===null">
								<td colspan="4">Loading...</td>
							</tr>
							<tr v-else v-for="post in filteredposts">
								<td>{{ post.id }}</td>
								<td>{{ post.identification_number }}</td>
								<td>{{ post.first_name }} {{ post.second_name }} {{ post.surname }} {{ post.second_surname }}</td>
								<td>
									<router-link class="btn btn-info btn-md" v-bind:to="{name: 'Employees-View', params: { employee_id: post.id }}"><i class="fas fa-eye"></i> </router-link>
									<router-link class="btn btn-warning btn-md" v-bind:to="{name: 'Employees-Edit', params: { employee_id: post.id }}"><i class="fas fa-pencil-alt"></i> </router-link>
									<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'Employees-Delete', params: { employee_id: post.id }}"><i class="fa fa-trash"></i> </router-link>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="add-Employees">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-Add' }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Add' }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Add' }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Add' }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Add' }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<div class="container emp-profile">
					<form v-on:submit="createEmployee">
						<div class="row">
							<div class="col-md-4">
								<div class="profile-img">
									<img id="myImg" v-bind:src="'data:image/jpeg;base64,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zXoSx2WaYtnjkad+im10L93npw0cO2o5cQ77ayxOyXDuHbbSzslgrpXVhdG4Fr2MaAwgjmCX6+iCsyAgICAgICAgICAgILNbJuJ44sN4httVOyKChmbWB8jgAxj2kOJJ5AFmvqg4DO3NyozQvcNmsolkssMwbBHG079bNroH7vPTjo0d9Tz4BPOR2U7MtcPmWrax99rWh1VI3j7IcxE0+A6nqewCCTEBAQEBAQEBAQEBAQEELZ65FNxtHJfLHGyK/Rt+LDwa2saBwBPR4HI9eR6EBVS41FwAht9c+cfl+/DHTT6g0+rtXMAPy+9x0QYaAgICAgICAgICAgIMy3VFwLZrfQvnP5huQyU0GpNRo7VrCB83vcdEFq8isim4Jjjvl8jZLfpG/Ch+ZtG08wD1eep6ch1JCaUBAQEBAQEBAQEBAQEBAQRnmzkdasyonVcRbbb61ujK1jdRLpybKB8w78x5cEFScY4GvWA7maG80T6Z5J9nKPeimHix/I+XMdQEGhQEBAQEBAQEBAQb7B2Br1jy5iis1E+peCPaSn3YoR4vfyHlzPQFBbbKbI61ZaxNq5S25X17dH1r26CPXm2IfujvzPlwQSYgICAgICAgICAgICAgICAgIMC92G3Ykt0tBdKOGupJPmhnYHNPfse44oIAx3snse6SqwpXiLXU/l9e4lvkyTmPJwPmggvFGA8Q4MlLLzaKqhaDoJnM3oneUjdWn6oNADqNRxHig+oCAgIPhOg1PAeKDf4XwHiHGcoZZrRVVzSdDM1m7E3zkdo0fVBOmBNk9jHR1WK68S6aH8voHEN8nycz5NA80E/2Sw27DduioLXRw0NJH8sMDA1o79z3PFBnoCAgICAgICAgICAgICAgICAgICDxJEyZjmPaHscNC1w1BHcIOIv+SGCcRufJU4fpopnc5aTWB2vj7hAPqEHDXLZJwzUEmiul0oif3XPZK0fVoP3QaWXY9iJ+FiqUDwfQg/o8IEWx7ED8XFUpHgyhA/V5Qbq27JOGacg1t0ulaR+617Imn6NJ+6DubBkhgnDjmSU2H6aWZvKWr1ndr4++SB6BB28cTIWNYxoYxo0DWjQAdgg9oCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICD/2Q=='" v-bind:data-src="'data:image/jpeg;base64,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zXoSx2WaYtnjkad+im10L93npw0cO2o5cQ77ayxOyXDuHbbSzslgrpXVhdG4Fr2MaAwgjmCX6+iCsyAgICAgICAgICAgILNbJuJ44sN4httVOyKChmbWB8jgAxj2kOJJ5AFmvqg4DO3NyozQvcNmsolkssMwbBHG079bNroH7vPTjo0d9Tz4BPOR2U7MtcPmWrax99rWh1VI3j7IcxE0+A6nqewCCTEBAQEBAQEBAQEBAQEELZ65FNxtHJfLHGyK/Rt+LDwa2saBwBPR4HI9eR6EBVS41FwAht9c+cfl+/DHTT6g0+rtXMAPy+9x0QYaAgICAgICAgICAgIMy3VFwLZrfQvnP5huQyU0GpNRo7VrCB83vcdEFq8isim4Jjjvl8jZLfpG/Ch+ZtG08wD1eep6ch1JCaUBAQEBAQEBAQEBAQEBAQRnmzkdasyonVcRbbb61ujK1jdRLpybKB8w78x5cEFScY4GvWA7maG80T6Z5J9nKPeimHix/I+XMdQEGhQEBAQEBAQEBAQb7B2Br1jy5iis1E+peCPaSn3YoR4vfyHlzPQFBbbKbI61ZaxNq5S25X17dH1r26CPXm2IfujvzPlwQSYgICAgICAgICAgICAgICAgIMC92G3Ykt0tBdKOGupJPmhnYHNPfse44oIAx3snse6SqwpXiLXU/l9e4lvkyTmPJwPmggvFGA8Q4MlLLzaKqhaDoJnM3oneUjdWn6oNADqNRxHig+oCAgIPhOg1PAeKDf4XwHiHGcoZZrRVVzSdDM1m7E3zkdo0fVBOmBNk9jHR1WK68S6aH8voHEN8nycz5NA80E/2Sw27DduioLXRw0NJH8sMDA1o79z3PFBnoCAgICAgICAgICAgICAgICAgICDxJEyZjmPaHscNC1w1BHcIOIv+SGCcRufJU4fpopnc5aTWB2vj7hAPqEHDXLZJwzUEmiul0oif3XPZK0fVoP3QaWXY9iJ+FiqUDwfQg/o8IEWx7ED8XFUpHgyhA/V5Qbq27JOGacg1t0ulaR+617Imn6NJ+6DubBkhgnDjmSU2H6aWZvKWr1ndr4++SB6BB28cTIWNYxoYxo0DWjQAdgg9oCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICD/2Q=='" /> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="profile-head">
									<h5>
										{{ post.first_name }} {{ post.second_name }} {{ post.surname }} {{ post.second_surname }}
									</h5>
									<h6>
										{{ post.identification_number }}
									</h6>
									<p class="proile-rating">ID EMPLEADO : <span>{{ post.id }}</span></p>
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informacion Básica</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Informacion Corporativa</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-2">
								<input type="submit" class="profile-edit-btn btn-default" value="Crear"/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="profile-work">
									<!-- //
										<p>WORK LINK</p>
										<a href="">Website Link</a><br/>
										<a href="">Bootsnipp Profile</a><br/>
										<a href="">Bootply Profile</a>
										<p>SKILLS</p>
										<a href="">Web Designer</a><br/>
										<a href="">Web Developer</a><br/>
										<a href="">WordPress</a><br/>
										<a href="">WooCommerce</a><br/>
										<a href="">PHP, .Net</a><br/>
									-->
								</div>
							</div>
							<div class="col-md-8">
								<div class="tab-content profile-tab" id="myTabContent">
									<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										<div class="row">
											<div class="col-md-6">
												<label>User Id</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.id }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TIPO DE IDENTIFICACION</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.identification_type">
														<option v-for="item in selectOptions.types_identifications" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label># IDENTIFICACION</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="text" v-model="post.identification_number" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>PRIMER NOMBRE</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.first_name" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>SEGUNDO NOMBRE</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.second_name" />													
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>PRIMER APELLIDO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.surname" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>SEGUNDO APELLIDO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.second_surname" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>F. EXPED. DOCUMENTO</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="date" v-model="post.identification_date_expedition" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>F. NACIMIENTO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="date" v-model="post.birthdate" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TIPO DE SANGRE</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.blood_type">
														<option v-for="item in selectOptions.types_bloods" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TIPO DE RH</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.blood_rh">
														<option v-for="item in selectOptions.types_bloods_rhs" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CORREO ELECTRONICO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.mail" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TELEFONO FIJO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.number_phone" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>MOVIL</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.number_mobile" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>DEPARTAMENTO</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.department" @change="loadCitys">
														<option v-for="item in selectOptions.geo_departments" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CIUDAD</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.city">
														<option v-for="item in selectOptions.geo_citys" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>DIRECCION DETALLADA</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.address" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>DIRECCION NORMALIZADA</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.geo_address" />
												</p>
											</div>
										</div>									
									</div>
									<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
										<div class="row">
											<div class="col-md-6">
												<label>ESTADO</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.status">
														<option v-for="item in selectOptions.status_employees" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<label>F. ENTRADA A LA EMPRESA</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="date" v-model="post.company_date_entry" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>F. SALIDA DE LA EMPRESA</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="date" v-model="post.company_date_out" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CORREO EMPRESARIAL</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="text" v-model="post.company_mail" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>EXTENSION</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="text" v-model="post.company_number_phone" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>MOVIL EMPRESARIAL</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="text" v-model="post.company_number_mobile" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>EPS</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.eps">
														<option v-for="item in selectOptions.eps" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>ARL</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.arl">
														<option v-for="item in selectOptions.arl" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>FONDO DE PENSION</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.pension_fund">
														<option v-for="item in selectOptions.funds_pensions" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CAJA DE COMPENSACION</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.compensation_fund">
														<option v-for="item in selectOptions.funds_compensations" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>FONDO DE CESANTIAS</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.severance_fund">
														<option v-for="item in selectOptions.funds_severances" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>OBSERVACIONES</label><br/>
												<p><textarea class="form-control" v-model="post.observations" rows="8"></textarea></p>
											</div>
										</div>	
									</div>
								</div>
							</div>
						</div>
					</form>           
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>


<template id="view-Employees">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-View' }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Contacts' }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Contracts' }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Performances' }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-PaymentStubs' }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<div class="container emp-profile">
					<form method="post">
						<div class="row">
							<div class="col-md-4">
								<div class="profile-img">
									<img width="100%" id="myImg" data-toggle="modal" data-target="#myModal" v-bind:src="'/media/images/' + post.avatar" v-bind:data-src="'/media/images/' + post.avatar" /> 
								</div>
							</div>
							<div class="col-md-6">
								<div class="profile-head">
									<h5>
										{{ post.first_name }} {{ post.second_name }} {{ post.surname }} {{ post.second_surname }}
									</h5>
									<h6>
										{{ post.identification_type.name }}: {{ post.identification_number }}
									</h6>
									<p class="proile-rating">ID EMPLEADO : <span>{{ post.id }}</span></p>
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informacion Básica</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Informacion Corporativa</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-2">
								<!-- // <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/> -->
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="profile-work">
									<!-- //
										<p>LINK</p>
										<a href="">Website Link</a><br/>
										<a href="">Bootsnipp Profile</a><br/>
										<a href="">Bootply Profile</a>
										<p>SKILLS</p>
										<a href="">Web Designer</a><br/>
										<a href="">Web Developer</a><br/>
										<a href="">WordPress</a><br/>
										<a href="">WooCommerce</a><br/>
										<a href="">PHP, .Net</a><br/>
									-->
								</div>
							</div>
							<div class="col-md-8">
								<div class="tab-content profile-tab" id="myTabContent">
									<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										<div class="row">
											<div class="col-md-6">
												<label>ID INTERNO</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.id }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TIPO DE IDENTIFICACION</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.identification_type.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>IDENTIFICACION</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.identification_number }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>F. EXPEDICION DEL DOCUMENTO</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.identification_date_expedition }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>F. NACIMIENTO</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.birthdate }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TIPO DE SANGRE</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.blood_type.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TIPO DE RH</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.blood_rh.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CORREO ELECTRONICO</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.mail }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TELEFONO FIJO</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.number_phone }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TELEFONO MOVIL</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.number_mobile }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>DEPARTAMENTO</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.department.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CIUDAD</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.city.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>DIRECCION DETALLADA</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.address }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>DIRECCION NORMALIZADA</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.geo_address }}</p>
											</div>
										</div>
										
									</div>
									<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
										<div class="row">
											<div class="col-md-6">
												<label>F. ENTRADA A LA EMPRESA</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.company_date_entry }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>F. SALIDA DE LA EMPRESA</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.company_date_out }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CORREO ELECTRONICO EMPRESARIAL</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.company_mail }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TEL. FIJO/EXTENSION EMPRESARIAL</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.company_number_phone }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TELEFONO MOVIL EMPRESARIAL</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.company_number_mobile }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>ESTADO</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.status.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>EPS</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.eps.code }} - {{ post.eps.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>ARL</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.arl.code }} - {{ post.arl.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>FONDO DE PENSION</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.pension_fund.code }} - {{ post.pension_fund.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CAJA DE COMPENSACION</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.compensation_fund.code }} - {{ post.compensation_fund.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>FONDO DE CESANTIAS</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.severance_fund.code }} - {{ post.severance_fund.name }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>OBSERVACIONES</label><br/>
												<p>{{ post.observations }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>           
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
		
	</div>		  
</template>

<template id="view-Employees-Contacts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View' }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-View-Contacts' }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Contracts' }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Performances' }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-PaymentStubs' }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<h3>Contactos</h3>
				<hr>
				<div class="col-md-12">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td>ID</td>
								<td>Nombre Completo</td>
								<td>Parentesco</td>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in post_contacts">
								<td>{{ item.id }}</td>
								<td>{{ item.contact.first_name }} {{ item.contact.second_name }} {{ item.contact.surname }} {{ item.contact.second_surname }}</td>
								<td>{{ item.type_contact.name }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="view-Employees-Contracts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View' }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Contacts' }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-View-Contracts' }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Performances' }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-PaymentStubs' }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<h3>Contratos</h3>
				<hr>
				<div class="col-md-12">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td>ID</td>
								<td>Contrato</td>
								<td>Termino</td>
								<td>Salario Básico</td>
								<td>Descripcion</td>
								<td>Cargo</td>
								<td>Fecha Inicio</td>
								<td>Fecha Termino</td>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in contracted_staff">
								<td>{{ item.id }}</td>
								<td>{{ item.contract_employee.name }}</td>
								<td>{{ item.contract_employee.term.name }}</td>
								<td>{{ item.contract_employee.basic_salary }}</td>
								<td>{{ item.contract_employee.description }}</td>
								<td>{{ item.type_charge.name }}</td>
								<td>{{ item.date_start }}</td>
								<td>{{ item.date_end }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="view-Employees-Performances">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View' }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Contacts' }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Contracts' }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-View-Performances' }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-PaymentStubs' }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<h3>Desempeño</h3>
				<hr>
				<div class="col-md-12">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td>ID</td>
								<td>Motivo</td>
								<td>Fecha Inicio</td>
								<td>Fecha Fin</td>
								<td>Accion Tomada</td>
								<td>Notas</td>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in performances_employees">
								<td>{{ item.id }}</td>
								<td>{{ item.reason.name }}</td>
								<td>{{ item.date_start }}</td>
								<td>{{ item.date_end }}</td>
								<td>{{ item.action_taken.name }}</td>
								<td>{{ item.notes }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="view-Employees-PaymentStubs">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View' }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Contacts' }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Contracts' }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-View-Performances' }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-View-PaymentStubs' }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
					<h3>Colillas</h3>
					<hr>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>


<template id="delete-Employees">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contacts', params: { employee_id: this.$route.params.employee_id } }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<form v-on:submit="deleteEmployee">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-List' }">Cancelar</router-link>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete-EmployeesContacts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contacts', params: { employee_id: this.$route.params.employee_id } }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<form v-on:submit="deleteEmployeeContact">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete-ContractedStaff">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contracts', params: { employee_id: this.$route.params.employee_id } }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<form v-on:submit="deleteContractedStaff">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
<!-- // ------------ EMPLEADOS FIN -------------------------------------  -->

<template id="edit-Employees">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-Edit', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contacts', params: { employee_id: this.$route.params.employee_id } }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contracts', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Performances', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-PaymentStubs', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<div class="container emp-profile">
					<form method="post" v-on:submit="updateEmployee">
						<div class="row">
							<div class="col-md-4">
								<div class="profile-img">
									<img id="myImg" data-toggle="modal" data-target="#myModal" v-bind:src="'/media/images/' + post.avatar" v-bind:data-src="'/media/images/' + post.avatar" /> 
									<div class="file btn btn-lg btn-primary">
										Cambiar Foto
										<input type="file" name="file" @change="updateAvatarEmployee" accept="image/png, image/jpeg, image/gif"  name="input-file-preview" />
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="profile-head">
									<h5>
										{{ post.first_name }} {{ post.second_name }} {{ post.surname }} {{ post.second_surname }}
									</h5>
									<h6>
										{{ post.identification_number }}
									</h6>
									<p class="proile-rating">ID EMPLEADO : <span>{{ post.id }}</span></p>
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informacion Básica</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Informacion Corporativa</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-2">
								<input type="submit" class="profile-edit-btn btn-default" name="btnAddMore" value="Guardar"/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="profile-work">
									<!-- //
										<p>WORK LINK</p>
										<a href="">Website Link</a><br/>
										<a href="">Bootsnipp Profile</a><br/>
										<a href="">Bootply Profile</a>
										<p>SKILLS</p>
										<a href="">Web Designer</a><br/>
										<a href="">Web Developer</a><br/>
										<a href="">WordPress</a><br/>
										<a href="">WooCommerce</a><br/>
										<a href="">PHP, .Net</a><br/>
									-->
								</div>
							</div>
							<div class="col-md-8">
								<div class="tab-content profile-tab" id="myTabContent">
									<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										<div class="row">
											<div class="col-md-6">
												<label>User Id</label>
											</div>
											<div class="col-md-6">
												<p>{{ post.id }}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TIPO DE IDENTIFICACION</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.identification_type">
														<option v-for="item in selectOptions.types_identifications" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label># IDENTIFICACION</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="text" v-model="post.identification_number" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>PRIMER NOMBRE</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.first_name" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>SEGUNDO NOMBRE</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.second_name" />													
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>PRIMER APELLIDO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.surname" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>SEGUNDO APELLIDO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.second_surname" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>F. EXPED. DOCUMENTO</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="date" v-model="post.identification_date_expedition" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>F. NACIMIENTO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="date" v-model="post.birthdate" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TIPO DE SANGRE</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.blood_type">
														<option v-for="item in selectOptions.types_bloods" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TIPO DE RH</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.blood_rh">
														<option v-for="item in selectOptions.types_bloods_rhs" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CORREO ELECTRONICO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.mail" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>TELEFONO FIJO</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.number_phone" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>MOVIL</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.number_mobile" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>DEPARTAMENTO</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.department" @change="loadCitys">
														<option v-for="item in selectOptions.geo_departments" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CIUDAD</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.city">
														<option v-for="item in selectOptions.geo_citys" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>DIRECCION DETALLADA</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.address" />
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>DIRECCION NORMALIZADA</label>
											</div>
											<div class="col-md-6">
												<p>
													<input class="form-control" type="text" v-model="post.geo_address" />
												</p>
											</div>
										</div>									
									</div>
									<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
										<div class="row">
											<div class="col-md-6">
												<label>ESTADO</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.status">
														<option v-for="item in selectOptions.status_employees" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<label>F. ENTRADA A LA EMPRESA</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="date" v-model="post.company_date_entry" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>F. SALIDA DE LA EMPRESA</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="date" v-model="post.company_date_out" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CORREO EMPRESARIAL</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="text" v-model="post.company_mail" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>EXTENSION</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="text" v-model="post.company_number_phone" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>MOVIL EMPRESARIAL</label>
											</div>
											<div class="col-md-6">
												<p><input class="form-control" type="text" v-model="post.company_number_mobile" /></p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>EPS</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.eps">
														<option v-for="item in selectOptions.eps" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>ARL</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.arl">
														<option v-for="item in selectOptions.arl" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>FONDO DE PENSION</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.pension_fund">
														<option v-for="item in selectOptions.funds_pensions" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>CAJA DE COMPENSACION</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.compensation_fund">
														<option v-for="item in selectOptions.funds_compensations" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<label>FONDO DE CESANTIAS</label>
											</div>
											<div class="col-md-6">
												<p>
													<select class="form-control" v-model="post.severance_fund">
														<option v-for="item in selectOptions.funds_severances" :value="item.id">{{ item.name }}</option>
													</select>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<label>OBSERVACIONES</label><br/>
												<p><textarea class="form-control" v-model="post.observations" rows="8"></textarea></p>
											</div>
										</div>
										
													
									</div>
								</div>
							</div>
						</div>
					</form>           
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="edit-Employees-Contacts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-Edit-Contacts', params: { employee_id: this.$route.params.employee_id } }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contracts', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Performances', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-PaymentStubs', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<h3>Contactos</h3>
				<hr>
				
				<div class="col-md-12">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td>ID</td>
								<td>Nombre Completo</td>
								<td>Parentesco</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in post_contacts">
								<td>{{ item.id }}</td>
								<td>{{ item.contact.first_name }} {{ item.contact.second_name }} {{ item.contact.surname }} {{ item.contact.second_surname }}</td>
								<td>{{ item.type_contact.name }}</td>
								<td>
									<a class="btn btn-success btn-md" target="_new" v-bind:href="'/business/contacts/#/View/' + item.contact.id"><i class="fa fa-eye"></i> </a>
									<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'EmployeesContacts-Delete', params: { employee_id: item.employee, employee_contact_id: item.id }}"><i class="fa fa-trash"></i> </router-link>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted">
				<div class="row">
					<div class="form-group col-sm-12 text-right">
						<div class="actions">
							<button class="btn btn-primary" onclick="javascript: $('#includeCrewEmployee-Fast').show();">
								<span class="fa fa-plus"></span>
								Agregar
							</button>
						</div>
					</div>
				</div>
				<div class="col-md-12" id="includeCrewEmployee-Fast">
					<form class="row" v-on:submit="includeCrewEmployee"> 
						<div class="form-group col-md-6">
							<label for="add-content">CONTACTO</label>
							<select class="form-control" v-model="post_crew.contact">
								<option v-for="item in selectOptions.contacts" :value="item.id">{{ item.identification_number }} - {{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="edit-content">PARENTESCO</label>
							<select class="form-control" v-model="post_crew.type_contact">
								<option v-for="item in selectOptions.types_contacts" :value="item.id">{{ item.name }}</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary col-md-12">Agregar</button>
					</form>
					<hr>
				</div>
			</div>
		</div>
	</div>
</template>

<template id="edit-Employees-Contracts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contacts', params: { employee_id: this.$route.params.employee_id } }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-Edit-Contracts', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Performances', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-PaymentStubs', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<h3>Contratos</h3>
				<hr>				
				<div class="col-md-12">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<td>ID</td>
								<td>Contrato</td>
								<td>Termino</td>
								<td>Salario Básico</td>
								<td>Descripcion</td>
								<td>Cargo</td>
								<td>Fecha Inicio</td>
								<td>Fecha Termino</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in contracted_staff">
								<td>{{ item.id }}</td>
								<td>{{ item.contract_employee.name }}</td>
								<td>{{ item.contract_employee.term.name }}</td>
								<td>{{ item.contract_employee.basic_salary }}</td>
								<td>{{ item.contract_employee.description }}</td>
								<td>{{ item.type_charge.name }}</td>
								<td>{{ item.date_start }}</td>
								<td>{{ item.date_end }}</td>
								<td><router-link class="btn btn-danger btn-md" v-bind:to="{name: 'ContractedStaff-Delete', params: { employee_id: item.employee, contracted_staff_id: item.id }}"><i class="fa fa-trash"></i> </router-link></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted">
				<div class="row">
					<div class="form-group col-sm-12 text-right">
						<div class="actions">
							<button class="btn btn-primary" onclick="javascript: $('#includeContractEmployee-Fast').show();">
								<span class="fa fa-plus"></span>
								Agregar
							</button>
						</div>
					</div>
				</div>
				<div class="col-md-12" id="includeContractEmployee-Fast">
					<form class="row" v-on:submit="includeContractEmployee"> 
						<div class="form-group col-md-3">
							<label for="add-content">CONTRATO</label>
							<select class="form-control" v-model="post_contracted_staff.contract_employee">
								<option v-for="item in selectOptions.contracts_employees" :value="item.id">{{ item.name }} - {{ item.term.name }} - {{ item.basic_salary }}</option>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="edit-content">CARGO</label>
							<select class="form-control" v-model="post_contracted_staff.type_charge">
								<option v-for="item in selectOptions.types_charges" :value="item.id">{{ item.name }}</option>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="add-content">FECHA INICIO</label>
							<input class="form-control" type="date" v-model="post_contracted_staff.date_start" />
						</div>
						<div class="form-group col-md-3">
							<label for="add-content">FECHA FIN</label>
							<input class="form-control" type="date" v-model="post_contracted_staff.date_end" />
						</div>
						<button type="submit" class="btn btn-primary col-md-12">Agregar</button>
					</form>
					<hr>
				</div>
			</div>
		</div>
	</div>
</template>

<template id="edit-Employees-Performances">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contacts', params: { employee_id: this.$route.params.employee_id } }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contracts', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-Edit-Performances', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-PaymentStubs', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
			</div>
			<div class="card-body">
				<h3>Desempeño</h3>
				<hr>				
				<div class="col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td>ID</td>
								<td>Motivo</td>
								<td>Fecha Inicio</td>
								<td>Fecha Fin</td>
								<td>Accion Tomada</td>
								<td>Notas</td>
							</tr>
						</thead>
						<tbody>
							<tr v-for="item in performances_employees">
								<td>{{ item.id }}</td>
								<td>{{ item.reason.name }}</td>
								<td>{{ item.date_start }}</td>
								<td>{{ item.date_end }}</td>
								<td>{{ item.action_taken.name }}</td>
								<td>{{ item.notes }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer small text-muted">
				<div class="row">
					<div class="form-group col-sm-12 text-right">
						<div class="actions">
							<button class="btn btn-primary" onclick="javascript: $('#includePerformancesEmployee-Fast').show();">
								<span class="fa fa-plus"></span>
								Agregar
							</button>
						</div>
					</div>
					<div class="col-md-12" id="includePerformancesEmployee-Fast">
						<form class="row" v-on:submit="includePerformancesEmployee"> 
							<div class="form-group col-md-3">
								<label for="add-content">MOTIVO</label>
								<select class="form-control" v-model="post_performances_employees.reason">
									<option v-for="item in selectOptions.reasons_performances_employees" :value="item.id">{{ item.name }}</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label for="add-content">FECHA INICIO</label>
								<input class="form-control" type="date" v-model="post_performances_employees.date_start" />
							</div>
							<div class="form-group col-md-3">
								<label for="add-content">FECHA FIN</label>
								<input class="form-control" type="date" v-model="post_performances_employees.date_end" />
							</div>
							<div class="form-group col-md-3">
								<label for="edit-content">ACCION TOMADA</label>
								<select class="form-control" v-model="post_performances_employees.action_taken">
									<option v-for="item in selectOptions.actions_performances_employees" :value="item.id">{{ item.name }}</option>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label for="edit-content">NOTAS</label>
								<textarea class="form-control" v-model="post_performances_employees.notes"></textarea>
							</div>
							<button type="submit" class="btn btn-primary col-md-12">Agregar</button>
						</form>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<template id="edit-Employees-PaymentStubs">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				Empleados
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-user-circle"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Infomacion Basica
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contacts', params: { employee_id: this.$route.params.employee_id } }">
						<span class="fas fa-users"></span>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contactos
					</router-link>  
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Contracts', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-file-contract"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Contratos
					</router-link>
					<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-Edit-Performances', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-poll-h"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Desempeño
					</router-link>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-Edit-PaymentStubs', params: { employee_id: this.$route.params.employee_id } }">
						<i class="fas fa-ticket-alt"></i>
						<!-- <span class="badge badge-default">Cerrar </span> -->
						Pagos
					</router-link>
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Employees-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link> 
				</router-link> 
			</div>
			<div class="card-body">
				<h3>Colillas</h3>
				<hr>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
			
	</div>
</template>
