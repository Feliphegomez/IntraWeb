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
<!-- // ------------ ESTADOS - SERVICIOS INICIO -------------------------------------  -->
<template id="page-StatusServices">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-success" v-bind:to="{ name: 'StatusServices-Add' }">
					<span class="fa fa-plus"></span>
					Nuevo
				</router-link> 
				Estados de Servicios
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Color</th>
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
							<td v-bind:style="'background-color: ' + post.color ">{{ post.color }}</td>
							<td>
								<router-link class="btn btn-info btn-md" v-bind:to="{name: 'StatusServices-View', params: { status_service_id: post.id }}"><i class="fas fa-eye"></i> </router-link>
								<router-link class="btn btn-warning btn-md" v-bind:to="{name: 'StatusServices-Edit', params: { status_service_id: post.id }}"><i class="fas fa-pencil-alt"></i> </router-link>
								<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'StatusServices-Delete', params: { status_service_id: post.id }}"><i class="fa fa-trash"></i> </router-link>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="view-StatusServices">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'StatusServices-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Estados de Servicios
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
						<td>COLOR</td>
						<td v-bind:style="'background-color: ' + post.color"></td>
					</tr>
					<tr>
						<td>COLOR CODE</td>
						<td>{{ post.color }}</td>
					</tr>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="add-StatusServices">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'StatusServices-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Estados de Servicios
			</div>
			<div class="card-body">
				<form v-on:submit="createStatusService">
					<div class="form-group">
						<label for="add-content">NOMBRE</label>
						<input class="form-control" type="text" v-model="post.name" />
					</div>
					<div class="form-group">
						<label for="add-content">COLOR</label>
						<input class="form-control" type="color" v-model="post.color" />
					</div>
					<button type="submit" class="btn btn-primary">Crear</button>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'StatusServices-List' }">Regresar</router-link>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="edit-StatusServices">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'StatusServices-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Estados de Servicios
			</div>
			<div class="card-body">
				<form v-on:submit="updateStatusService">
					<div class="form-group">
						<label for="edit-content">Nombre</label>
						<input class="form-control" id="edit-content" v-model="post.name" />
					</div>
					<div class="form-group">
						<label for="add-content">COLOR</label>
						<input class="form-control" type="color" v-model="post.color" />
					</div>
					<button type="submit" class="btn btn-primary">Guardar</button>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'StatusServices-List' }">Regresar</router-link>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete-StatusServices">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'StatusServices-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Estados de Servicios
			</div>
			<div class="card-body">
				<form v-on:submit="deleteStatusService">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'StatusServices-List' }">Cancelar</router-link>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
<!-- // ------------ ESTADOS - SERVICIOS FIN -------------------------------------  -->
