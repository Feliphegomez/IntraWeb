<script>
	// ------------ SERVICIOS - INICIO ------------------------------------- 
	var Services_List = Vue.extend({
	  template: '#page-Services',
	  data: function () {
		return {
			posts: [],
			searchKey: '',
		};
	  },
	  created: function () {
		var self = this;
		self.posts = [];
		apiMV.get('/services', {
		  params: {
			join:[
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

	var Services_View = Vue.extend({
		template: '#view-Services',
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
					price: '',
				},
			};
		},
		mounted: function () {
			var self = this;
			self.findService();
		},
		methods: {
			findService: function(){
				var self = this;
				var idService = self.$route.params.service_id;
				apiMV.get('/services/' + idService, {
					params: {
						join: 'types_meditions'
					}
				}).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Services_Add = Vue.extend({
		template: '#add-Services',
		data: function () {
			return {
				selectOptions: {
					types_meditions: [],
				},
				post: {
					name: '',
					description: '',
					type_medition: 0,
					price: '',
				}
			}
		},
		mounted: function () {
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
			createService: function() {
				var post = this.post;
				apiMV.post('/services', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Services_Edit = Vue.extend({
		template: '#edit-Services',
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
					price: '',
				}
			};
		},
		mounted: function () {
			var self = this;
			self.loadSelects();
			self.findService();
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
			updateService: function () {
				var post = this.post;
				apiMV.put('/services/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findService: function(){
				var self = this;
				var idService = self.$route.params.service_id;
				
				apiMV.get('/services/' + idService).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Services_Delete = Vue.extend({
		template: '#delete-Services',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
					description: '',
					type_medition: 0,
					price: '',
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findService();
		},
		methods: {
			deleteService: function () {
				var post = this.post;
				
				apiMV.delete('/services/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findService: function(){
				var self = this;
				var idService = self.$route.params.service_id;
				
				apiMV.get('/services/' + idService).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ SERVICIOS - FIN ------------------------------------- 


	var router = new VueRouter({routes:[
		{ path: '/', component: Services_List, name: 'Services-List'},
		{ path: '/View/:service_id', component: Services_View, name: 'Services-View'},
		{ path: '/Add', component: Services_Add, name: 'Services-Add'},
		{ path: '/Edit/:service_id', component: Services_Edit, name: 'Services-Edit'},
		{ path: '/Delete/:service_id', component: Services_Delete, name: 'Services-Delete'},
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