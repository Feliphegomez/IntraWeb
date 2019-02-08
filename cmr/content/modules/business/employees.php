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
		<h2>EMPLEADOS - Crear</h2>
		<form v-on:submit="createEmployee">
			<div class="form-group">
				<label for="add-content">PRIMER NOMBRE</label>
				<input class="form-control" type="text" v-model="post.first_name" />
			</div>
			<div class="form-group">
				<label for="add-content">SEGUNDO NOMBRE</label>
				<input class="form-control" type="text" v-model="post.second_name" />
			</div>
			<div class="form-group">
				<label for="add-content">PRIMER APELLIDO</label>
				<input class="form-control" type="text" v-model="post.surname" />
			</div>
			<div class="form-group">
				<label for="add-content">SEGUNDO APELLIDO</label>
				<input class="form-control" type="text" v-model="post.second_surname" />
			</div>
			<div class="form-group">
				<label for="add-content">TIPO DE IDENTIFICACION</label>
				<select class="form-control" v-model="post.identification_type">
					<option v-for="item in selectOptions.types_identifications" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content"># IDENTIFICACION</label>
				<input class="form-control" type="text" v-model="post.identification_number" />
			</div>
			<div class="form-group">
				<label for="add-content">F. EXPEDICION DEL DOCUMENTO</label>
				<input class="form-control" type="date" v-model="post.identification_date_expedition" />
			</div>
			<div class="form-group">
				<label for="add-content">F. NACIMIENTO</label>
				<input class="form-control" type="date" v-model="post.birthdate" />
			</div>
			<div class="form-group">
				<label for="add-content">TIPO DE SANGRE</label>
				<select class="form-control" v-model="post.blood_type">
					<option v-for="item in selectOptions.types_bloods" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">TIPO DE RH</label>
				<select class="form-control" v-model="post.blood_rh">
					<option v-for="item in selectOptions.types_bloods_rhs" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">CORREO ELECTRONICO</label>
				<input class="form-control" type="text" v-model="post.mail" />
			</div>
			<div class="form-group">
				<label for="add-content">TELEFONO FIJO</label>
				<input class="form-control" type="text" v-model="post.number_phone" />
			</div>
			<div class="form-group">
				<label for="add-content">TELEFONO MOVIL</label>
				<input class="form-control" type="text" v-model="post.number_mobile" />
			</div>
			<div class="form-group">
				<label for="add-content">F. ENTRADA A LA EMPRESA</label>
				<input class="form-control" type="date" v-model="post.company_date_entry" />
			</div>
			<div class="form-group">
				<label for="add-content">F. SALIDA DE LA EMPRESA</label>
				<input class="form-control" type="date" v-model="post.company_date_out" />
			</div>
			<div class="form-group">
				<label for="add-content">CORREO ELECTRONICO EMPRESARIAL</label>
				<input class="form-control" type="text" v-model="post.company_mail" />
			</div>
			<div class="form-group">
				<label for="add-content">TEL. FIJO/EXTENSION EMPRESARIAL</label>
				<input class="form-control" type="text" v-model="post.company_number_phone" />
			</div>
			<div class="form-group">
				<label for="add-content">TELEFONO MOVIL EMPRESARIAL</label>
				<input class="form-control" type="text" v-model="post.company_number_mobile" />
			</div>
			<div class="form-group">
				<label for="add-content">ESTADO</label>
				<select class="form-control" v-model="post.status">
					<option v-for="item in selectOptions.status_employees" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">EPS</label>
				<select class="form-control" v-model="post.eps">
					<option v-for="item in selectOptions.eps" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">ARL</label>
				<select class="form-control" v-model="post.arl">
					<option v-for="item in selectOptions.arl" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">FONDO DE PENSION</label>
				<select class="form-control" v-model="post.pension_fund">
					<option v-for="item in selectOptions.funds_pensions" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">CAJA DE COMPENSACION</label>
				<select class="form-control" v-model="post.compensation_fund">
					<option v-for="item in selectOptions.funds_compensations" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">FONDO DE CESANTIAS</label>
				<select class="form-control" v-model="post.severance_fund">
					<option v-for="item in selectOptions.funds_severances" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">DEPARTAMENTO</label>
				<select class="form-control" v-model="post.department" @change="loadCitys">
					<option v-for="item in selectOptions.geo_departments" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">CIUDAD</label>
				<select class="form-control" v-model="post.city">
					<option v-for="item in selectOptions.geo_citys" :value="item.id">{{ item.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="add-content">DIRECCION DETALLADA</label>
				<input class="form-control" type="text" v-model="post.address" />
			</div>
			<div class="form-group">
				<label for="add-content">DIRECCION NORMALIZADA</label>
				<input class="form-control" type="text" v-model="post.geo_address" />
			</div>
			<div class="form-group">
				<label for="add-content">OBSERVACIONES</label>
				<input class="form-control" type="text" v-model="post.observations" />
			</div>
			<button type="submit" class="btn btn-primary">Crear</button>
			<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-List' }">Regresar</router-link>
		</form>
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
		<h2>EMPLEADOS - Eliminar</h2>
		<form v-on:submit="deleteEmployee">
			<p>The action cannot be undone.</p>
			<button type="submit" class="btn btn-danger">Eliminar</button>
			<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-List' }">Cancelar</router-link>
		</form>
	</div>
</template>

<template id="delete-EmployeesContacts">
	<div>
		<h2>CONTACTOS - Eliminar</h2>
		<form v-on:submit="deleteEmployeeContact">
			<p>The action cannot be undone.</p>
			<button type="submit" class="btn btn-danger">Eliminar</button>
			<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-List' }">Cancelar</router-link>
		</form>
	</div>
</template>

<template id="delete-ContractedStaff">
	<div>
		<h2>CONTACTOS - Eliminar</h2>
		<form v-on:submit="deleteContractedStaff">
			<p>The action cannot be undone.</p>
			<button type="submit" class="btn btn-danger">Eliminar</button>
			<router-link class="btn btn-primary" v-bind:to="{ name: 'Employees-List' }">Cancelar</router-link>
		</form>
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
					<table class="table table-bordered">
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
