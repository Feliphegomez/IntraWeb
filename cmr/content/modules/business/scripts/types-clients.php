<script>

	// ------------ TIPOS - CLIENTES INICIO ------------------------------------- 
	var Types_Clients_List = Vue.extend({
	  template: '#page-TypesClients',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		apiMV.get('/types_clients').then(function (response) {
			self.posts = response.data.records;
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

	var Types_Clients_View = Vue.extend({
		template: '#view-TypesClients',
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
			self.findTypesClient();
		},
		methods: {
			findTypesClient: function(){
				var self = this;
				var idTypesClient = self.$route.params.type_client_id;
				
				apiMV.get('/types_clients/' + idTypesClient).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Clients_Add = Vue.extend({
		template: '#add-TypesClients',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createTypesClient: function() {
				var post = this.post;
				apiMV.post('/types_clients', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Clients_Edit = Vue.extend({
		template: '#edit-TypesClients',
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
			self.findTypesClient();
		},
		methods: {
			updateTypesClient: function () {
				var post = this.post;
				apiMV.put('/types_clients/' + post.id, post).then(function (response) {
					console.log(response.data);
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				router.push('/');
			},
			findTypesClient: function(){
				var self = this;
				var idTypesClient = self.$route.params.type_client_id;
				
				apiMV.get('/types_clients/' + idTypesClient).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Clients_Delete = Vue.extend({
		template: '#delete-TypesClients',
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
			self.findTypesClient();
		},
		methods: {
			deleteTypesClient: function () {
				var post = this.post;
				
				apiMV.delete('/types_clients/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			},
			findTypesClient: function(){
				var self = this;
				var idTypesClient = self.$route.params.type_client_id;
				
				apiMV.get('/types_clients/' + idTypesClient).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - CLIENTES FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: Types_Clients_List, name: 'TypesClients-List'},
		{ path: '/View/:type_client_id', component: Types_Clients_View, name: 'TypesClients-View'},
		{ path: '/Add', component: Types_Clients_Add, name: 'TypesClients-Add'},
		{ path: '/Edit/:type_client_id/edit', component: Types_Clients_Edit, name: 'TypesClients-Edit'},
		{ path: '/Delete/:type_client_id/delete', component: Types_Clients_Delete, name: 'TypesClients-Delete'},
	
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