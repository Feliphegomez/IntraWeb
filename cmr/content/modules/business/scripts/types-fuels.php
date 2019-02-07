<script>
	// ------------ TIPOS - COMBUSTIBLES INICIO ------------------------------------- 
	var Types_Fuels_List = Vue.extend({
	  template: '#page-TypesFuels',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		apiMV.get('/types_fuels').then(function (response) {
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

	var Types_Fuels_View = Vue.extend({
		template: '#view-TypesFuels',
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
			self.findTypesFuel();
		},
		methods: {
			findTypesFuel: function(){
				var self = this;
				var idTypesFuel = self.$route.params.type_fuel_id;
				
				apiMV.get('/types_fuels/' + idTypesFuel).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Fuels_Add = Vue.extend({
		template: '#add-TypesFuels',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createTypesFuel: function() {
				var post = this.post;
				apiMV.post('/types_fuels', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Fuels_Edit = Vue.extend({
		template: '#edit-TypesFuels',
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
			self.findTypesFuel();
		},
		methods: {
			updateTypesFuel: function () {
				var post = this.post;
				apiMV.put('/types_fuels/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesFuel: function(){
				var self = this;
				var idTypesFuel = self.$route.params.type_fuel_id;
				
				apiMV.get('/types_fuels/' + idTypesFuel).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Fuels_Delete = Vue.extend({
		template: '#delete-TypesFuels',
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
			self.findTypesFuel();
		},
		methods: {
			deleteTypesFuel: function () {
				var post = this.post;
				
				apiMV.delete('/types_fuels/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesFuel: function(){
				var self = this;
				var idTypesFuel = self.$route.params.type_fuel_id;
				
				apiMV.get('/types_fuels/' + idTypesFuel).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - COMBUSTIBLES FIN ------------------------------------- 


	var router = new VueRouter({routes:[
		{ path: '/', component: Types_Fuels_List, name: 'TypesFuels-List'},
		{ path: '/View/:type_fuel_id', component: Types_Fuels_View, name: 'TypesFuels-View'},
		{ path: '/Add', component: Types_Fuels_Add, name: 'TypesFuels-Add'},
		{ path: '/Edit/:type_fuel_id', component: Types_Fuels_Edit, name: 'TypesFuels-Edit'},
		{ path: '/Delete/:type_fuel_id', component: Types_Fuels_Delete, name: 'TypesFuels-Delete'},
		
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