<script>
	// ------------ TIPOS - SOCIEDADES INICIO ------------------------------------- 
	var Types_Societys_List = Vue.extend({
		template: '#page-TypesSocietys',
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
			self.posts = [];
			
			apiMV.get('/types_societys', {
				params: {
					order: [
						'name,asc',
					],
				}
			}).then(function (response) {
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

	var Types_Societys_View = Vue.extend({
		template: '#view-TypesSocietys',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
					description: '',
				},
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesSociety();
		},
		methods: {
			findTypesSociety: function(){
				var self = this;
				var idTypesSocietys = self.$route.params.type_society_id;
				
				apiMV.get('/types_societys/' + idTypesSocietys).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Societys_Add = Vue.extend({
		template: '#add-TypesSocietys',
		data: function () {
			return {
				post: {
					name: '',
					description: '',
				}
			}
		},
		methods: {
			createTypesSociety: function() {
				var post = this.post;
				apiMV.post('/types_societys', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Societys_Edit = Vue.extend({
		template: '#edit-TypesSocietys',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
					description: '',
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesSociety();
		},
		methods: {
			updateTypesSociety: function () {
				var post = this.post;
				apiMV.put('/types_societys/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesSociety: function(){
				var self = this;
				var idTypesSocietys = self.$route.params.type_society_id;
				
				apiMV.get('/types_societys/' + idTypesSocietys).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Societys_Delete = Vue.extend({
		template: '#delete-TypesSocietys',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
					description: '',
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesSociety();
		},
		methods: {
			deleteTypesSociety: function () {
				var post = this.post;
				
				apiMV.delete('/types_societys/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesSociety: function(){
				var self = this;
				var idTypesSocietys = self.$route.params.type_society_id;
				
				apiMV.get('/types_societys/' + idTypesSocietys).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - SOCIEDADES FIN ------------------------------------- 


	var router = new VueRouter({routes:[
		{ path: '/', component: Types_Societys_List, name: 'TypesSocietys-List'},
		{ path: '/View/:type_society_id', component: Types_Societys_View, name: 'TypesSocietys-View'},
		{ path: '/Add', component: Types_Societys_Add, name: 'TypesSocietys-Add'},
		{ path: '/Edit/:type_society_id', component: Types_Societys_Edit, name: 'TypesSocietys-Edit'},
		{ path: '/Delete/:type_society_id', component: Types_Societys_Delete, name: 'TypesSocietys-Delete'},
		
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