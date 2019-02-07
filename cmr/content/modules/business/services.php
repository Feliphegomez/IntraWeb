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
<!-- // ------------ SERVICIOS - INICIO -------------------------------------  -->
<template id="page-Services">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-success" v-bind:to="{ name: 'Services-Add' }">
					<span class="fa fa-plus"></span>
					Nuevo
				</router-link> 
				Servicios
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Medicion</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="posts===null">
							<td colspan="4">Loading...</td>
						</tr>
						<tr v-else v-for="post in filteredposts">
							<td>{{ post.id }}</td>
							<td>{{ post.name }}</td>
							<td>{{ post.price }}</td>
							<td>{{ post.type_medition.name }}</td>
							<td>
								<router-link class="btn btn-info btn-md" v-bind:to="{name: 'Services-View', params: { service_id: post.id }}"><i class="fas fa-eye"></i> </router-link>
								<router-link class="btn btn-warning btn-md" v-bind:to="{name: 'Services-Edit', params: { service_id: post.id }}"><i class="fas fa-pencil-alt"></i> </router-link>
								<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'Services-Delete', params: { service_id: post.id }}"><i class="fa fa-trash"></i> </router-link>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="view-Services">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Services-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Servicios
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<td>ID INTERNO</td>
						<td>{{ post.id }}</td>
					</tr>
					<tr>
						<td>NOMBRE</td>
						<td>{{ post.name }}</td>
					</tr>
					<tr>
						<td>PRECIO</td>
						<td>{{ post.price }}</td>
					</tr>
					<tr>
						<td>DESCRIPCION</td>
						<td>{{ post.description }}</td>
					</tr>
					<tr>
						<td>TIPO DE MEDICION</td>
						<td>
							<table class="table  table-bordered">
								<tr>
									<td>ID INTERNO</td>
									<td>{{ post.type_medition.id }}</td>
								</tr>
								<tr>
									<td>NOMBRE</td>
									<td>{{ post.type_medition.name }}</td>
								</tr>
								<tr>
									<td>CODIGO</td>
									<td>{{ post.type_medition.code }}</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="add-Services">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Services-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Servicios
			</div>
			<div class="card-body">
				<form v-on:submit="createService">
					<div class="form-group">
						<label for="add-content">NOMBRE</label>
						<input class="form-control" type="text" v-model="post.name" />
					</div>
					<div class="form-group">
						<label for="add-content">PRECIO</label>
						<input class="form-control" type="text" v-model="post.price" />
					</div>
					<div class="form-group">
						<label for="add-content">MEDICION</label>
						<select class="form-control" v-model="post.type_medition">
							<option v-for="item in selectOptions.types_meditions" :value="item.id">{{ item.name }} - {{ item.code }}</option>
						</select>
					</div>
					<div class="form-group">
						<label for="add-content">DESCRIPCION</label>
						<textarea class="form-control" type="text" v-model="post.description" rows="8"></textarea>
					</div>
					<button type="submit" class="btn btn-success">Crear</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="edit-Services">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Services-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Servicios
			</div>
			<div class="card-body">
				<form v-on:submit="updateService">
					<div class="form-group">
						<label for="add-content">NOMBRE</label>
						<input class="form-control" type="text" v-model="post.name" />
					</div>
					<div class="form-group">
						<label for="add-content">PRECIO</label>
						<input class="form-control" type="text" v-model="post.price" />
					</div>
					<div class="form-group">
						<label for="add-content">MEDICION</label>
						<select class="form-control" v-model="post.type_medition">
							<option v-for="item in selectOptions.types_meditions" :value="item.id">{{ item.name }} - {{ item.code }}</option>
						</select>
					</div>
					<div class="form-group">
						<label for="add-content">DESCRIPCION</label>
						<textarea class="form-control" type="text" v-model="post.description" rows="8"></textarea>
					</div>
					<button type="submit" class="btn btn-success">Crear</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete-Services">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Services-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Servicios
			</div>
			<div class="card-body">
				<form v-on:submit="deleteService">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
<!-- // ------------ SERVICIOS - FIN -------------------------------------  -->
