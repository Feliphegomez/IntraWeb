<script>
	// ------------ TIPOS - VEHICULOS - INICIO ------------------------------------- 
	var Types_Vehicles_List = Vue.extend({
		template: '#page-TypesVehicles',
		data: function () {
			return {
				posts: [],
				searchKey: ''
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			apiMV.get('/types_vehicles').then(function (response) {
				self.posts = response.data.records;
				$(document).ready(function() { $('#dataTable').DataTable(); });
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		computed: {
			filteredposts: function () {
				return this.posts.filter(function (post) {
					return this.searchKey=='' || post.name.indexOf(this.searchKey) !== -1;
				},this);
			}
		}
	});

	var Types_Vehicles_View = Vue.extend({
		template: '#view-TypesVehicles',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
				},
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesVehicle();
		},
		methods: {
			findTypesVehicle: function(){
				var self = this;
				var idTypesVehicles = self.$route.params.type_vehicle_id;
				
				apiMV.get('/types_vehicles/' + idTypesVehicles).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
					router.push('/');
				});
			}
		}
	});

	var Types_Vehicles_Add = Vue.extend({
		template: '#add-TypesVehicles',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createTypesVehicle: function() {
				var post = this.post;
				apiMV.post('/types_vehicles', post).then(function (response) {
					post.id = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				router.push('/');
			}
		}
	});

	var Types_Vehicles_Edit = Vue.extend({
		template: '#edit-TypesVehicles',
		data: function () {
			return {
				post: {
					id: 0,
					name: ''
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesVehicle();
		},
		methods: {
			updateTypesVehicle: function () {
				var post = this.post;
				apiMV.put('/types_vehicles/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesVehicle: function(){
				var self = this;
				var idTypesVehicles = self.$route.params.type_vehicle_id;
				
				apiMV.get('/types_vehicles/' + idTypesVehicles).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
					router.push('/');
				});
			}
		}
	});

	var Types_Vehicles_Delete = Vue.extend({
		template: '#delete-TypesVehicles',
		data: function () {
			return {
				post: {
					id: 0,
					name: ''
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesVehicle();
		},
		methods: {
			deleteTypesVehicle: function () {
				var post = this.post;
				
				apiMV.delete('/types_vehicles/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesVehicle: function(){
				var self = this;
				var idTypesVehicles = self.$route.params.type_vehicle_id;
				
				apiMV.get('/types_vehicles/' + idTypesVehicles).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - VEHICULOS - FIN ------------------------------------- 


	var router = new VueRouter({routes:[
	{ path: '/', component: Types_Vehicles_List, name: 'TypesVehicles-List'},
	{ path: '/View/:type_vehicle_id', component: Types_Vehicles_View, name: 'TypesVehicles-View'},
	{ path: '/Add', component: Types_Vehicles_Add, name: 'TypesVehicles-Add'},
	{ path: '/Edit/:type_vehicle_id', component: Types_Vehicles_Edit, name: 'TypesVehicles-Edit'},
	{ path: '/Delete/:type_vehicle_id', component: Types_Vehicles_Delete, name: 'TypesVehicles-Delete'},
		
	]});

	var appRender = new Vue({
		data: function () {
			return {
			};
		},
		router:router,
		mounted: function () {
			var self = this;
		},
	}).$mount('#app');
</script>