<script>

	// ------------ CONCEPTOS - INICIO ------------------------------------- 
	var Attributes_List = Vue.extend({
		template: '#page-Attributes',
		data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
		mounted: function () {
			var self = this;
			self.posts = [];
			apiMV.get('/attributes', {
				params: {
					join: [
						'types_meditions',
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

	var Attributes_View = Vue.extend({
		template: '#view-Attributes',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
					description: '',
					type_medition: {
						id: 0,
						name: '',
						code: '',
					},
					price: 1.0,
				},
			};
		},
		mounted: function () {	
			var self = this;
			self.findAttribute();
		},
		methods: {
			findAttribute: function(){
				var self = this;
				var idAttribute = self.$route.params.attribute_id;
				
				apiMV.get('/attributes/' + idAttribute, {
					params: {
						join: [
							'types_meditions',
						]
					}
				}).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Attributes_Add = Vue.extend({
		template: '#add-Attributes',
		data: function () {
			return {
				selectOptions: {
					types_meditions: [],
				},
				post: {
					id: 0,
					name: '',
					description: '',
					type_medition: 0,
					price: 0,
				}
			}
		},
		mounted: function(){
			var self = this;
			
			self.loadSelects();
		},
		methods: {
			loadSelects: function(){
				var self = this;
				apiMV.get('/types_meditions', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.types_meditions = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			createAttribute: function() {
				var post = this.post;
				apiMV.post('/attributes', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Attributes_Edit = Vue.extend({
		template: '#edit-Attributes',
		data: function () {
			return {
				selectOptions: {
					types_meditions: [],
				},
				post: {
					id: 0,
					name: '',
					description: '',
					type_medition: 0,
					price: 0,
				}
			};
		},
		mounted: function () {
			var self = this;
			self.loadSelects();
			self.findAttribute();
		},
		methods: {
			loadSelects: function(){
				var self = this;
				apiMV.get('/types_meditions', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.types_meditions = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			updateAttribute: function () {
				var post = this.post;
				apiMV.put('/attributes/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findAttribute: function(){
				var self = this;
				var idAttribute = self.$route.params.attribute_id;
				
				apiMV.get('/attributes/' + idAttribute).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Attributes_Delete = Vue.extend({
		template: '#delete-Attributes',
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
			self.findAttribute();
		},
		methods: {
			deleteAttribute: function () {
				var post = this.post;
				
				apiMV.delete('/attributes/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findAttribute: function(){
				var self = this;
				var idAttribute = self.$route.params.attribute_id;
				
				apiMV.get('/attributes/' + idAttribute).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ CONCEPTOS - FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: Attributes_List, name: 'Attributes-List'},
		{ path: '/View/:attribute_id', component: Attributes_View, name: 'Attributes-View'},
		{ path: '/Add', component: Attributes_Add, name: 'Attributes-Add'},
		{ path: '/Edit/:attribute_id', component: Attributes_Edit, name: 'Attributes-Edit'},
		{ path: '/Delete/:attribute_id', component: Attributes_Delete, name: 'Attributes-Delete'},
		
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
