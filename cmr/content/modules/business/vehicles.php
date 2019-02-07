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
<!-- // ------------ VEHICULOS - INICIO -------------------------------------  -->
<template id="page-Vehicles">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-success" v-bind:to="{ name: 'Vehicles-Add' }">
					<span class="fa fa-plus"></span>
					Nuevo
				</router-link> 
				Vehiculos
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Placa</th>
							<th>Tipo de Vehículo</th>
							<th >Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="posts===null">
							<td colspan="4">Loading...</td>
						</tr>
						<tr v-else v-for="post in filteredposts">
							<td>{{ post.id }}</td>
							<td>{{ post.license_plate }}</td>
							<td>{{ post.type_vehicle.name }}</td>
							<td>
								<router-link class="btn btn-info btn-md" v-bind:to="{name: 'Vehicles-View', params: { vehicle_id: post.id }}"><i class="fas fa-eye"></i> </router-link>
								<router-link class="btn btn-warning btn-md" v-bind:to="{name: 'Vehicles-Edit', params: { vehicle_id: post.id }}"><i class="fas fa-pencil-alt"></i> </router-link>
								<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'Vehicles-Delete', params: { vehicle_id: post.id }}"><i class="fa fa-trash"></i> </router-link>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="view-Vehicles">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Vehicles-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Vehiculos
			</div>
			<div class="card-body">
				<div class="card-header">
					<ul class="nav nav-tabs">
					  <li class="btn btn-default active"><a data-toggle="tab" href="#home">Infomacion Basica</a></li>
					  <li class="btn btn-default"><a data-toggle="tab" href="#menu1">Tripulantes</a></li>
					  <li class="btn btn-default"><a data-toggle="tab" href="#menu2">Galeria</a></li>
					</ul>
				</div>
				<hr>
				<div class="tab-content">
				  <div id="home" class="tab-pane fade in active show">
					<h3>Infomacion Basica</h3>
					<table class="table table-bordered">
						<tr>
							<td>ID INTERNO</td>
							<td>{{ post.id }}</td>
						</tr>
						<tr>
							<td>PLACA</td>
							<td>{{ post.license_plate }}</td>
						</tr>
						<tr>
							<td>MARCA</td>
							<td>{{ post.brand }}</td>
						</tr>
						<tr>
							<td>TIPO DE VEHICULO</td>
							<td>
								<table class="table  table-bordered">
									<tr>
										<td>ID</td>
										<td>{{ post.type_vehicle.id }}</td>
									</tr>
									<tr>
										<td>NOMBRE</td>
										<td>{{ post.type_vehicle.name }}</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>CAPACIDAD DE PASAJEROS</td>
							<td>{{ post.passangers_capacity }}</td>
						</tr>
						<tr>
							<td>TIPO DE COMBUSTIBLE</td>
							<td>
								<table class="table  table-bordered">
									<tr>
										<td>ID</td>
										<td>{{ post.type_fuel.id }}</td>
									</tr>
									<tr>
										<td>NOMBRE</td>
										<td>{{ post.type_fuel.name }}</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>CILINDRAJE</td>
							<td>{{ post.cilindraje }}</td>
						</tr>
						<tr>
							<td>TITULAR</td>
							<td>
								<table class="table  table-bordered">
									<tr>
										<td>NOMBRE COMPLETO</td>
										<td>{{ post.holder.first_name }} {{ post.holder.second_name }} {{ post.holder.surname }} {{ post.holder.second_surname }}</td>
									</tr>
									<tr>
										<td>TELEFONO FIJO</td>
										<td>{{ post.holder.phone }}</td>
									</tr>
									<tr>
										<td>TELEFONO MOVIL</td>
										<td>{{ post.holder.phone_mobile }}</td>
									</tr>
									<tr>
										<td>CORREO ELECTRONICO</td>
										<td>{{ post.holder.mail }}</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>PROPIETARIO</td>
							<td>
								<table class="table  table-bordered">
									<tr>
										<td>NOMBRE COMPLETO</td>
										<td>{{ post.propietary.first_name }} {{ post.propietary.second_name }} {{ post.propietary.surname }} {{ post.propietary.second_surname }}</td>
									</tr>
									<tr>
										<td>TELEFONO FIJO</td>
										<td>{{ post.propietary.phone }}</td>
									</tr>
									<tr>
										<td>TELEFONO MOVIL</td>
										<td>{{ post.propietary.phone_mobile }}</td>
									</tr>
									<tr>
										<td>CORREO ELECTRONICO</td>
										<td>{{ post.propietary.mail }}</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td># TARJETA DE PROPIEDAD</td>
							<td>{{ post.card_propiety_number }}</td>
						</tr>
						<tr>
							<td># CHASIS</td>
							<td>{{ post.chassis_number }}</td>
						</tr>
						<tr>
							<td># SOAT</td>
							<td>{{ post.soat_number }}</td>
						</tr>
						<tr>
							<td># POLIZA DE TERCEROS</td>
							<td>{{ post.third_party_number }}</td>
						</tr>
						<tr>
							<td>FECHA VENCIMIENTO POLIZA SOAT</td>
							<td>{{ post.soat_date_expiration }}</td>
						</tr>
						<tr>
							<td>FECHA VENCIMIENTO POLIZA TERCEROS</td>
							<td>{{ post.third_party_date_expiration }}</td>
						</tr>
						<tr>
							<td>CAPACIDAD CON REALCE</td>
							<td>{{ post.capacity_with_enhancement }}</td>
						</tr>
						<tr>
							<td>CAPACIDAD SIN REALCE</td>
							<td>{{ post.capacity_without_enhancement }}</td>
						</tr>
						<tr>
							<td>PESO BASE</td>
							<td>{{ post.base_weight }}</td>
						</tr>
						<tr>
							<td>COSTO DE RENTA</td>
							<td>{{ post.rent_cost }}</td>
						</tr>
						<tr>
							<td>ESTADO</td>
							<td>
								<table class="table  table-bordered">
									<tr>
										<td>ID</td>
										<td>{{ post.status.id }}</td>
									</tr>
									<tr>
										<td>NOMBRE</td>
										<td>{{ post.status.name }}</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				  </div>
				  <div id="menu1" class="tab-pane fade">
						<h3>Tripulantes</h3>
						<table class="table table-bordered">
							<thead>
								<tr>
									<td>ID</td>
									<td>Cargo</td>
									<td>Empleado</td>
								</tr>
							</thead>
							<tbody>
								<tr v-for="item in crew">
									<td>{{ item.charge.id }}</td>
									<td>{{ item.charge.name }}</td>
									<td>{{ item.employee.first_name }} {{ item.employee.second_name }} {{ item.employee.surname }} {{ item.employee.second_surname }}</td>
								</tr>
							</tbody>
						</table>
				  </div>
				  <div id="menu2" class="tab-pane fade">
						<h3>Galeria</h3>
						<div class="card card-default">
							<div class="card-body">
								<div class="row">
									<div class="col-lg-3" v-for="img in galery_vehicles" style="min-height: 350px;height:350px;">
										<img width="100%" class="image img-thumbnail" id="myImg" data-toggle="modal" data-target="#myModal" v-bind:src="'/media/images/' + img.picture" v-bind:data-src="'/media/images/' + img.picture" />
									</div>
								</div>
							</div>
						</div>
				  </div>
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="add-Vehicles">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Vehicles-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Vehiculos
			</div>
			<div class="card-body">
				<form v-on:submit="createVehicle" class="row">
					<div class="form-group col-sm-2">
						<label for="add-content">PLACA</label>
						<input class="form-control" type="text" v-model="post.license_plate" />
					</div>
					<div class="form-group col-sm-3">
						<label for="add-content">MARCA</label>
						<input class="form-control" type="text" v-model="post.brand" />
					</div>
					<div class="form-group col-sm-3">
						<label for="add-content">MODELO</label>
						<input class="form-control" type="text" v-model="post.model" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content">TIPO DE VEHICULO</label>
						<select class="form-control" v-model="post.type_vehicle">
							<option v-for="item in selectOptions.types_vehicles" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<div class="form-group col-sm-2">
						<label for="add-content">CAP. PASAJEROS</label>
						<input class="form-control" type="text" v-model="post.passangers_capacity" />
					</div>
					<div class="form-group col-sm-2">
						<label for="add-content">TIPO DE COMBUSTIBLE</label>
						<select class="form-control" v-model="post.type_fuel">
							<option v-for="item in selectOptions.types_fuels" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<div class="form-group col-sm-2">
						<label for="add-content">CILINDRAJE</label>
						<input class="form-control" type="text" v-model="post.cilindraje" />
					</div>
					<div class="form-group col-sm-6">
						<label for="add-content">TITULAR</label>
						<select class="form-control" v-model="post.holder">
							<option v-for="item in selectOptions.contacts" :value="item.id">{{ item.identification_number }} - {{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
						</select>
					</div>
					<div class="form-group col-sm-6">
						<label for="add-content">PROPIETARIO</label>
						<select class="form-control" v-model="post.propietary">
							<option v-for="item in selectOptions.contacts" :value="item.id">{{ item.identification_number }} - {{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
						</select>
					</div>
					<div class="form-group col-sm-3">
						<label for="add-content"># TARJETA DE PROPIEDAD</label>
						<input class="form-control" type="text" v-model="post.card_propiety_number" />
					</div>
					<div class="form-group col-sm-3">
						<label for="add-content"># TARJETA DE CHASIS</label>
						<input class="form-control" type="text" v-model="post.chassis_number" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content"># SOAT</label>
						<input class="form-control" type="text" v-model="post.soat_number" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content">F. DE VENC. SOAT</label>
						<input class="form-control" type="date" v-model="post.soat_date_expiration" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content"># POLIZA DE TERCEROS</label>
						<input class="form-control" type="text" v-model="post.third_party_number" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content">F. DE VENC. POLIZA DE TERCEROS</label>
						<input class="form-control" type="date" v-model="post.third_party_date_expiration" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content">CAPACIDAD CON REALCE</label>
						<input class="form-control" type="text" v-model="post.capacity_with_enhancement" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content">CAPACIDAD SIN REALCE</label>
						<input class="form-control" type="text" v-model="post.capacity_without_enhancement" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content">PESO BASE</label>
						<input class="form-control" type="text" v-model="post.base_weight" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content">COSTO DE RENTA</label>
						<input class="form-control" type="text" v-model="post.rent_cost" />
					</div>
					<div class="form-group col-sm-4">
						<label for="add-content">ESTADO</label>
						<select class="form-control" v-model="post.status">
							<option v-for="item in selectOptions.status_vehicles" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<div class="form-group col-lg-12">
						<button type="submit" class="btn btn-success">Crear</button>
					</div>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="edit-Vehicles">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Vehicles-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Vehiculos
			</div>
			<div class="card-body">
				<div class="card-header">
					<ul class="nav nav-tabs">
						<li class="btn btn-default active"><a data-toggle="tab" href="#home">Infomacion Basica</a></li>
						<li class="btn btn-default"><a data-toggle="tab" href="#menu1">Tripulantes</a></li>
						<li class="btn btn-default"><a data-toggle="tab" href="#menu2">Galeria</a></li>
					</ul>
				</div>
				<hr>
				<div class="tab-content">
					<div id="home" class="tab-pane fade in active show">
						<h3>Infomacion Basica</h3>
						<form v-on:submit="updateVehicle" class=" row">
							<div class="form-group col-lg-2">
								<label for="edit-content">PLACA</label>
								<input class="form-control" id="edit-content" v-model="post.license_plate" />
							</div>
							<div class="form-group col-lg-3">
								<label for="add-content">MARCA</label>
								<input class="form-control" type="text" v-model="post.brand" />
							</div>
							<div class="form-group col-lg-3">
								<label for="add-content">MODELO</label>
								<input class="form-control" type="text" v-model="post.model" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content">TIPO DE VEHICULO</label>
								<select class="form-control" v-model="post.type_vehicle">
									<option v-for="item in selectOptions.types_vehicles" :value="item.id">{{ item.name }}</option>
								</select>
							</div>
							<div class="form-group col-lg-2">
								<label for="add-content">CAP. PASAJEROS</label>
								<input class="form-control" type="text" v-model="post.passangers_capacity" />
							</div>
							<div class="form-group col-lg-2">
								<label for="add-content">TIPO DE COMBUSTIBLE</label>
								<select class="form-control" v-model="post.type_fuel">
									<option v-for="item in selectOptions.types_fuels" :value="item.id">{{ item.name }}</option>
								</select>
							</div>
							<div class="form-group col-lg-2">
								<label for="add-content">CILINDRAJE</label>
								<input class="form-control" type="text" v-model="post.cilindraje" />
							</div>
							<div class="form-group col-lg-6">
								<label for="add-content">TITULAR</label>
								<select class="form-control" v-model="post.holder">
									<option v-for="item in selectOptions.contacts" :value="item.id">{{ item.identification_number }} - {{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
								</select>
							</div>
							<div class="form-group col-lg-6">
								<label for="add-content">PROPIETARIO</label>
								<select class="form-control" v-model="post.propietary">
									<option v-for="item in selectOptions.contacts" :value="item.id">{{ item.identification_number }} - {{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
								</select>
							</div>
							<div class="form-group col-lg-3">
								<label for="add-content"># TARJETA DE PROPIEDAD</label>
								<input class="form-control" type="text" v-model="post.card_propiety_number" />
							</div>
							<div class="form-group col-lg-3">
								<label for="add-content"># TARJETA DE CHASIS</label>
								<input class="form-control" type="text" v-model="post.chassis_number" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content"># SOAT</label>
								<input class="form-control" type="text" v-model="post.soat_number" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content">F. VENC. SOAT</label>
								<input class="form-control" type="date" v-model="post.soat_date_expiration" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content"># POLIZA DE TERCEROS</label>
								<input class="form-control" type="text" v-model="post.third_party_number" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content">F. VENC. POLIZA DE TERCEROS</label>
								<input class="form-control" type="date" v-model="post.third_party_date_expiration" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content">CAPACIDAD CON REALCE</label>
								<input class="form-control" type="text" v-model="post.capacity_with_enhancement" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content">CAPACIDAD SIN REALCE</label>
								<input class="form-control" type="text" v-model="post.capacity_without_enhancement" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content">PESO BASE</label>
								<input class="form-control" type="text" v-model="post.base_weight" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content">COSTO DE RENTA</label>
								<input class="form-control" type="text" v-model="post.rent_cost" />
							</div>
							<div class="form-group col-lg-4">
								<label for="add-content">ESTADO</label>
								<select class="form-control" v-model="post.status">
									<option v-for="item in selectOptions.status_vehicles" :value="item.id">{{ item.name }}</option>
								</select>
							</div>
							<div class="form-group col-lg-12">
								<button type="submit" class="btn btn-success">Guardar</button>
							</div>
						</form>
					</div>
					<div id="menu1" class="tab-pane fade">
						<h3>Tripulantes</h3>
						<div class="row">
							<div class="form-group col-sm-12 text-right">
								<div class="actions">
									<button class="btn btn-primary" onclick="javascript: $('#includeCrewVehicle-Fast').show();">
										<span class="fa fa-plus"></span>
										Agregar
									</button>
								</div>
							</div>
						</div>
						<div class="col-md-12" id="includeCrewVehicle-Fast" class="hide">
							<form class="row" v-on:submit="includeCrewVehicle"> 
								<div class="form-group col-md-6">
									<label for="edit-content">CARGO</label>
									<select class="form-control" v-model="post_crew.charge">
										<option v-for="item in selectOptions.types_charges" :value="item.id">{{ item.name }}</option>
									</select>
								</div>
								<div class="form-group col-md-6">
									<label for="add-content">EMPLEADO</label>
									<select class="form-control" v-model="post_crew.employee">
										<option v-for="item in selectOptions.employees" :value="item.id">{{ item.identification_number }} - {{ item.first_name }} {{ item.second_name }} {{ item.surname }} {{ item.second_surname }}</option>
									</select>
								</div>
								<button type="submit" class="btn btn-primary">Agregar</button>
							</form>
							<hr>
						</div>
						<div class="col-md-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<td>ID</td>
										<td>Cargo</td>
										<td>Empleado</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<tr v-for="item in crew">
										<td>{{ item.charge.id }}</td>
										<td>{{ item.charge.name }}</td>
										<td>{{ item.employee.first_name }} {{ item.employee.second_name }} {{ item.employee.surname }} {{ item.employee.second_surname }}</td>
										<td>
											<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'includeCrewVehicle-Delete', params: { vehicle_id: post.id, crew_vehicle_id: item.id }}"><i class="fa fa-trash"></i> </router-link>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div id="menu2" class="tab-pane fade row">
						<h3>Galeria</h3>
						<div class="card-body row">
							<div class="col-lg-2 col-sm-12" style="display:nones;">
								<div class="card card-default">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-2">
												<input v-model="image_preview.name" type="hidden" class="form-control" />
											</div>
											<div class="col-lg-3">
												<input v-model="image_preview.type" type="hidden" class="form-control" readonly="" />
											</div>
											<div class="col-lg-3">
												<input v-model="image_preview.size" type="hidden" class="form-control" readonly="" />
											</div>
											<div class="col-lg-12">
												<input v-model="image_preview.data" type="hidden" class="form-control image-preview-filename" readonly="" />
											</div>
											<div class="col-lg-12">
												<div class="input-group image-preview">
													<img id="dynamic" width="100%" v-bind:src="image_preview.data" />
												</div>
											</div>
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="form-group col-sm-12 text-right">
										<div class="input-group image-preview" style="float-right">
											<div class="btn btn-default image-preview-input">
												<span class="glyphicon glyphicon-folder-open"></span>
												<span class="image-preview-input-title"> <i class="fa fa-camera"></i> </span>
												<input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview" @change="changeImage" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-10 col-sm-12" style="display:nones;">
								<div class="card card-default">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-3" v-for="img in galery_vehicles" style="min-height: 350px;height:350px;">
												<img width="100%" class="image image-responsive" v-bind:src="'/media/images/' + img.picture" />
												<hr>
												<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'GaleryVehicles-delete', params: { vehicle_id: post.id, galery_vehicles_id: img.id }}">
													<i class="fa fa-trash"></i> Eliminar
												</router-link>
												<a class="btn btn-info btn-md" target="_new" v-bind:href="'/media/images/' + img.picture"><i class="fa fa-eye"></i> Ver</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete-Vehicles">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Vehicles-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Vehiculos
			</div>
			<div class="card-body">
				<form v-on:submit="deleteVehicle">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete-includeCrewVehicle">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Vehicles-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Vehiculos
			</div>
			<div class="card-body">
				<form v-on:submit="deleteCrewVehicle">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="GaleryVehicles-delete">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Vehicles-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Vehiculos
			</div>
			<div class="card-body">
				<form v-on:submit="deletegalery_vehicles" method="POST">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
  </div>
</template>
<!-- // ------------ VEHICULOS - FIN -------------------------------------  -->
