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
<!-- // ------------ CONTACTOS - INICIO -------------------------------------  -->
<template id="page-Contacts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-success" v-bind:to="{ name: 'Contacts-Add' }">
					<span class="fa fa-plus"></span>
					Nuevo
				</router-link> 
				Contactos
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Numero de identificacion</th>
							<th>Nombre Completo</th>
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
								<router-link class="btn btn-info btn-md" v-bind:to="{name: 'Contacts-View', params: { contact_id: post.id }}"><i class="fas fa-eye"></i> </router-link>
								<router-link class="btn btn-warning btn-md" v-bind:to="{name: 'Contacts-Edit', params: { contact_id: post.id }}"><i class="fas fa-pencil-alt"></i> </router-link>
								<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'Contacts-Delete', params: { contact_id: post.id }}"><i class="fa fa-trash"></i> </router-link>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="view-Contacts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Contacts-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Contactos
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<td>ID INTERNO</td>
						<td>{{ post.id }}</td>
					</tr>
					<tr>
						<td>TIPO DE IDENTIFICACION</td>
						<td>
							<table class="table table-bordered">
								<tr>
									<td>ID INTERNO</td>
									<td>{{ post.identification_type.id }}</td>
								</tr>
								<tr>
									<td>NOMBRE</td>
									<td>{{ post.identification_type.name }}</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td># IDENTIFICACION</td>
						<td>{{ post.identification_number }}</td>
					</tr>
					<tr>
						<td>PRIMER NOMBRE</td>
						<td>{{ post.first_name }}</td>
					</tr>
					<tr>
						<td>SEGUNDO NOMBRE</td>
						<td>{{ post.second_name }}</td>
					</tr>
					<tr>
						<td>PRIMER APELLIDO</td>
						<td>{{ post.surname }}</td>
					</tr>
					<tr>
						<td>SEGUNDO APELLIDO</td>
						<td>{{ post.second_surname }}</td>
					</tr>
					<tr>
						<td>TELEFONO FIJO</td>
						<td>{{ post.phone }}</td>
					</tr>
					<tr>
						<td>TELEFONO MOVIL</td>
						<td>{{ post.phone_mobile }}</td>
					</tr>
					<tr>
						<td>CORREO ELECTRONICO</td>
						<td>{{ post.mail }}</td>
					</tr>
					<tr>
						<td>DEPARTAMENTO</td>
						<td>
							<table class="table table-bordered">
								<tr>
									<td>ID INTERNO</td>
									<td>{{ post.department.id }}</td>
								</tr>
								<tr>
									<td>NOMBRE</td>
									<td>{{ post.department.name }}</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>CIUDAD</td>
						<td>
							<table class="table table-bordered">
								<tr>
									<td>ID INTERNO</td>
									<td>{{ post.city.id }}</td>
								</tr>
								<tr>
									<td>NOMBRE</td>
									<td>{{ post.city.name }}</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>DIRECCION DETALLADA</td>
						<td>{{ post.address }}</td>
					</tr>
					<tr>
						<td>DIRECCION NORMALIZADA</td>
						<td>{{ post.geo_address }}</td>
					</tr>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="add-Contacts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Contacts-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Contactos
			</div>
			<div class="card-body">
				<form v-on:submit="createContact">
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
						<label for="add-content">TELEFONO FIJO</label>
						<input class="form-control" type="text" v-model="post.phone" />
					</div>
					<div class="form-group">
						<label for="add-content">TELEFONO MOVIL</label>
						<input class="form-control" type="text" v-model="post.phone_mobile" />
					</div>
					<div class="form-group">
						<label for="add-content">DEPARTAMENTO</label>
						<select class="form-control" v-model="post.department" @change="loadCitys">
							<option v-for="item in selectOptions.geo_departments" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<div class="form-group">
						<label for="add-content">CIUDAD</label>
						<select class="form-control" v-model="post.city" >
							<option v-for="item in selectOptions.geo_citys" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<button type="submit" class="btn btn-success">Crear</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="edit-Contacts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Contacts-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Contactos
			</div>
			<div class="card-body">
				<form v-on:submit="updateContact" class="row">
					<div class="form-group col-md-4">
						<label for="add-content">TIPO DE IDENTIFICACION</label>
						<select class="form-control" v-model="post.identification_type">
							<option v-for="item in selectOptions.types_identifications" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="add-content"># IDENTIFICACION</label>
						<input class="form-control" type="text" v-model="post.identification_number" />
					</div>
					<div class="form-group col-md-4">
						<label for="add-content">PRIMER NOMBRE</label>
						<input class="form-control" type="text" v-model="post.first_name" />
					</div>
					<div class="form-group col-md-4">
						<label for="add-content">SEGUNDO NOMBRE</label>
						<input class="form-control" type="text" v-model="post.second_name" />
					</div>
					<div class="form-group col-md-4">
						<label for="add-content">PRIMER APELLIDO</label>
						<input class="form-control" type="text" v-model="post.surname" />
					</div>
					<div class="form-group col-md-4">
						<label for="add-content">SEGUNDO APELLIDO</label>
						<input class="form-control" type="text" v-model="post.second_surname" />
					</div>
					<div class="form-group col-md-3">
						<label for="add-content">TELEFONO FIJO</label>
						<input class="form-control" type="text" v-model="post.phone" />
					</div>
					<div class="form-group col-md-3">
						<label for="add-content">TELEFONO MOVIL</label>
						<input class="form-control" type="text" v-model="post.phone_mobile" />
					</div>
					<div class="form-group col-md-3">
						<label for="add-content">DEPARTAMENTO</label>
						<select class="form-control" v-model="post.department" @change="loadCitys">
							<option v-for="item in selectOptions.geo_departments" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label for="add-content">CIUDAD</label>
						<select class="form-control" v-model="post.city" >
							<option v-for="item in selectOptions.geo_citys" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<button type="submit" class="btn btn-success">Guardar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete-Contacts">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Contacts-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Contactos
			</div>
			<div class="card-body">
				<form v-on:submit="deleteContact">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
<!-- // ------------ CONTACTOS - FIN -------------------------------------  -->
