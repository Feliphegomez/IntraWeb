<script>
	// ------------ ESTADOS -  VEHICULOS INICIO ------------------------------------- 
	var Status_Vehicles_List = Vue.extend({
	  template: '#page-StatusVehicles',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		self.posts = [];
		apiMV.get('/status_vehicles').then(function (response) {
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

	var Status_Vehicles_View = Vue.extend({
		template: '#view-StatusVehicles',
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
			self.findStatusVehicle();
		},
		methods: {
			findStatusVehicle: function(){
				var self = this;
				var idStatusVehicle = self.$route.params.status_vehicle_id;
				
				apiMV.get('/status_vehicles/' + idStatusVehicle).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Status_Vehicles_Add = Vue.extend({
		template: '#add-StatusVehicles',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createStatusVehicle: function() {
				var post = this.post;
				apiMV.post('/status_vehicles', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Status_Vehicles_Edit = Vue.extend({
		template: '#edit-StatusVehicles',
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
			self.findStatusVehicle();
		},
		methods: {
			updateStatusVehicle: function () {
				var post = this.post;
				apiMV.put('/status_vehicles/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findStatusVehicle: function(){
				var self = this;
				var idStatusVehicle = self.$route.params.status_vehicle_id;
				
				apiMV.get('/status_vehicles/' + idStatusVehicle).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Status_Vehicles_Delete = Vue.extend({
		template: '#delete-StatusVehicles',
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
			self.findStatusVehicle();
		},
		methods: {
			deleteStatusVehicle: function () {
				var post = this.post;
				
				apiMV.delete('/status_vehicles/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findStatusVehicle: function(){
				var self = this;
				var idStatusVehicle = self.$route.params.status_vehicle_id;
				
				apiMV.get('/status_vehicles/' + idStatusVehicle).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ ESTADOS -  VEHICULOS FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: Status_Vehicles_List, name: 'StatusVehicles-List'},
		{ path: '/View/:status_vehicle_id', component: Status_Vehicles_View, name: 'StatusVehicles-View'},
		{ path: '/Add', component: Status_Vehicles_Add, name: 'StatusVehicles-Add'},
		{ path: '/Edit/:status_vehicle_id', component: Status_Vehicles_Edit, name: 'StatusVehicles-Edit'},
		{ path: '/Delete/:status_vehicle_id', component: Status_Vehicles_Delete, name: 'StatusVehicles-Delete'},
		
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
