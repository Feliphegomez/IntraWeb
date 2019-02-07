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
<!-- // ------------ GEO - CIUDADES INICIO -------------------------------------  -->
<template id="page-GEO-Citys">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-success" v-bind:to="{ name: 'CitysGEO-Add' }">
					<span class="fa fa-plus"></span>
					Nuevo
				</router-link> 
				Ciudades
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Departamento</th>
							<th>Nombre</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="posts===null">
							<td colspan="4">Loading...</td>
						</tr>
						<tr v-else v-for="post in filteredposts">
							<td>{{ post.id }}</td>
							<td>{{ post.department.name }}</td>
							<td>{{ post.name }}</td>
							<td>
								<router-link class="btn btn-info btn-md" v-bind:to="{name: 'CitysGEO-View', params: { geo_city_id: post.id }}"><i class="fas fa-eye"></i> </router-link>
								<router-link class="btn btn-warning btn-md" v-bind:to="{name: 'CitysGEO-Edit', params: { geo_city_id: post.id }}"><i class="fas fa-pencil-alt"></i> </router-link>
								<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'CitysGEO-Delete', params: { geo_city_id: post.id }}"><i class="fa fa-trash"></i> </router-link>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
	
<template id="view-GEO-Citys">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'CitysGEO-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Ciudades
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr>
						<td>ID INTERNO</td>
						<td>{{ post.id }}</td>
					</tr>
					<tr>
						<td>DEPARTAMENTO</td>
						<td>
							<table class="table  table-bordered">
								<tr>
									<td>ID INTERNO</td>
									<td>{{ post.department.id }}</td>
								</tr>
								<tr>
									<td>CODIGO</td>
									<td>{{ post.department.code }}</td>
								</tr>
								<tr>
									<td>NOMBRE</td>
									<td>{{ post.department.name }}</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>NOMBRE</td>
						<td>{{ post.name }}</td>
					</tr>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="add-GEO-Citys">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'CitysGEO-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Ciudades
			</div>
			<div class="card-body">
				<form v-on:submit="createDepartmentGEO">
					<div class="form-group">
						<label for="add-content">DEPARTAMENTO</label>
						<select class="form-control" v-model="post.department">
							<option v-for="item in selectOptions.departments" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<div class="form-group">
						<label for="add-content">NOMBRE</label>
						<input class="form-control" type="text" v-model="post.name" />
					</div>
					<button type="submit" class="btn btn-success">Crear</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="edit-GEO-Citys">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'CitysGEO-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Ciudades
			</div>
			<div class="card-body">
				<form v-on:submit="updateCityGEO">
					<div class="form-group">
						<label for="edit-content">DEPARTAMENTO</label>
						<select class="form-control" v-model="post.department">
							<option v-for="item in selectOptions.departments" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<div class="form-group">
						<label for="edit-content">NOMBRE</label>
						<input class="form-control" id="edit-content" v-model="post.name" />
					</div>
					<button type="submit" class="btn btn-success">Guardar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete-GEO-Citys">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'CitysGEO-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Ciudades
			</div>
			<div class="card-body">
				<form v-on:submit="deleteCityGEO">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
<!-- // ------------ GEO - CIUDADES FIN -------------------------------------  -->
