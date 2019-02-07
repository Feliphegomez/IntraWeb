<script>
	// ------------ ESTADOS -  SERVICIOS INICIO ------------------------------------- 
	var Status_Services_List = Vue.extend({
	  template: '#page-StatusServices',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		self.posts = [];
		apiMV.get('/status_services').then(function (response) {
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

	var Status_Services_View = Vue.extend({
		template: '#view-StatusServices',
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
			self.findStatusService();
		},
		methods: {
			findStatusService: function(){
				var self = this;
				var idStatusService = self.$route.params.status_service_id;
				
				apiMV.get('/status_services/' + idStatusService).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Status_Services_Add = Vue.extend({
		template: '#add-StatusServices',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createStatusService: function() {
				var post = this.post;
				apiMV.post('/status_services', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Status_Services_Edit = Vue.extend({
		template: '#edit-StatusServices',
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
			self.findStatusService();
		},
		methods: {
			updateStatusService: function () {
				var post = this.post;
				apiMV.put('/status_services/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findStatusService: function(){
				var self = this;
				var idStatusService = self.$route.params.status_service_id;
				
				apiMV.get('/status_services/' + idStatusService).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Status_Services_Delete = Vue.extend({
		template: '#delete-StatusServices',
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
			self.findStatusService();
		},
		methods: {
			deleteStatusService: function () {
				var post = this.post;
				
				apiMV.delete('/status_services/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});				
			},
			findStatusService: function(){
				var self = this;
				var idStatusService = self.$route.params.status_service_id;
				
				apiMV.get('/status_services/' + idStatusService).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ ESTADOS -  SERVICIOS FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: Status_Services_List, name: 'StatusServices-List'},
		{ path: '/View/:status_service_id', component: Status_Services_View, name: 'StatusServices-View'},
		{ path: '/Add', component: Status_Services_Add, name: 'StatusServices-Add'},
		{ path: '/Edit/:status_service_id', component: Status_Services_Edit, name: 'StatusServices-Edit'},
		{ path: '/Delete/:status_service_id', component: Status_Services_Delete, name: 'StatusServices-Delete'},
		
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