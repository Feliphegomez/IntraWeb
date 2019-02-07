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
<!-- // ------------ CONCEPTOS - INICIO -------------------------------------  -->
<template id="page-Attributes">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-success" v-bind:to="{ name: 'Attributes-Add' }">
					<span class="fa fa-plus"></span>
					Nuevo
				</router-link> 
				Tipos de Sangre
			</div>
			<div class="card-body">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Descvripcion</th>
							<th>Valor</th>
							<th>Tipo de Medicion</th>
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
							<td>{{ post.description }}</td>
							<td>{{ post.price }}</td>
							<td>{{ post.type_medition.code }}</td>
							<td>
							<router-link class="btn btn-info btn-md" v-bind:to="{name: 'Attributes-View', params: { attribute_id: post.id }}"><i class="fas fa-eye"></i> </router-link>
							<router-link class="btn btn-warning btn-md" v-bind:to="{name: 'Attributes-Edit', params: { attribute_id: post.id }}"><i class="fas fa-pencil-alt"></i> </router-link>
							<router-link class="btn btn-danger btn-md" v-bind:to="{name: 'Attributes-Delete', params: { attribute_id: post.id }}"><i class="fa fa-trash"></i> </router-link>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="view-Attributes">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Attributes-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Conceptos Addicionales de Servicios
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
						<td>DESCRIPCION</td>
						<td>{{ post.description }}</td>
					</tr>
					<tr>
						<td>TIPO DE MEDICION</td>
						<td>
							<table class="table  table-responsive">
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
					<tr>
						<td>PRECIO</td>
						<td>{{ post.price }}</td>
					</tr>
				</table>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>		  
</template>

<template id="add-Attributes">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Attributes-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Tipos de Sangre
			</div>
			<div class="card-body">
			<form v-on:submit="createAttribute">
				<div class="form-group">
					<label for="add-content">NOMBRE</label>
					<input class="form-control" type="text" v-model="post.name" />
				</div>
				<div class="form-group">
					<label for="add-content">DESCRIPCION</label>
					<input class="form-control" type="text" v-model="post.description" />
				</div>
				<div class="form-group">
					<label for="add-content">TIPO DE MEDICION</label>
					<select class="form-control" v-model="post.type_medition">
						<option v-for="item in selectOptions.types_meditions" :value="item.id">{{ item.name }}</option>
					</select>
				</div>
				<div class="form-group">
					<label for="add-content">PRECIO</label>
					<input class="form-control" type="number" v-model="post.price" step="0.01" />
				</div>
				<button type="submit" class="btn btn-primary">Crear</button>
				<router-link class="btn btn-primary" v-bind:to="{ name: 'Attributes-List' }">Regresar</router-link>
			</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="edit-Attributes">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Attributes-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Tipos de Sangre
			</div>
			<div class="card-body">
				<form v-on:submit="updateAttribute">
					<div class="form-group">
						<label for="edit-content">Nombre</label>
						<input class="form-control" id="edit-content" v-model="post.name" />
					</div>
					<div class="form-group">
						<label for="add-content">DESCRIPCION</label>
						<input class="form-control" type="text" v-model="post.description" />
					</div>
					<div class="form-group">
						<label for="add-content">TIPO DE MEDICION</label>
						<select class="form-control" v-model="post.type_medition">
							<option v-for="item in selectOptions.types_meditions" :value="item.id">{{ item.name }}</option>
						</select>
					</div>
					<div class="form-group">
						<label for="add-content">PRECIO</label>
						<input class="form-control" type="number" v-model="post.price" step="0.01" />
					</div>
					<button type="submit" class="btn btn-primary">Guardar</button>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Attributes-List' }">Regresar</router-link>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>

<template id="delete-Attributes">
	<div>
		<div class="card mb-3">
			<div class="card-header">
				<router-link class="btn btn-secondary" v-bind:to="{ name: 'Attributes-List' }">
					<span class="fa fa-window-close"></span>
					<!-- <span class="badge badge-default">Cerrar </span> -->
					Cerrar
				</router-link>  
				Tipos de Sangre
			</div>
			<div class="card-body">
				<form v-on:submit="deleteAttribute">
					<p>The action cannot be undone.</p>
					<button type="submit" class="btn btn-danger">Eliminar</button>
					<router-link class="btn btn-primary" v-bind:to="{ name: 'Attributes-List' }">Cancelar</router-link>
				</form>
			</div>
			<div class="card-footer small text-muted"></div>
		</div>
	</div>
</template>
<!-- // ------------ CONCEPTOS - FIN -------------------------------------  -->
