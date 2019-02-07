<script>
	// ------------ ESTADOS -  EMPLEADOS INICIO ------------------------------------- 
	var Status_Employees_List = Vue.extend({
	  template: '#page-StatusEmployees',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		self.posts = [];
		
		apiMV.get('/status_employees').then(function (response) {
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

	var Status_Employees_View = Vue.extend({
		template: '#view-StatusEmployees',
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
			self.findStatusEmployee();
		},
		methods: {
			findStatusEmployee: function(){
				var self = this;
				var idStatusEmployee = self.$route.params.status_employee_id;
				
				apiMV.get('/status_employees/' + idStatusEmployee).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Status_Employees_Add = Vue.extend({
		template: '#add-StatusEmployees',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createStatusEmployee: function() {
				var post = this.post;
				apiMV.post('/status_employees', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});			
			}
		}
	});

	var Status_Employees_Edit = Vue.extend({
		template: '#edit-StatusEmployees',
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
			self.findStatusEmployee();
		},
		methods: {
			updateStatusEmployee: function () {
				var post = this.post;
				apiMV.put('/status_employees/' + post.id, post).then(function (response) {
					console.log(response.data);
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				router.push('/');
			},
			findStatusEmployee: function(){
				var self = this;
				var idStatusEmployee = self.$route.params.status_employee_id;
				
				apiMV.get('/status_employees/' + idStatusEmployee).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Status_Employees_Delete = Vue.extend({
		template: '#delete-StatusEmployees',
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
			self.findStatusEmployee();
		},
		methods: {
			deleteStatusEmployee: function () {
				var post = this.post;
				
				apiMV.delete('/status_employees/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findStatusEmployee: function(){
				var self = this;
				var idStatusEmployee = self.$route.params.status_employee_id;
				
				apiMV.get('/status_employees/' + idStatusEmployee).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ ESTADOS -  EMPLEADOS FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: Status_Employees_List, name: 'StatusEmployees-List'},
		{ path: '/View/:status_employee_id', component: Status_Employees_View, name: 'StatusEmployees-View'},
		{ path: '/Add', component: Status_Employees_Add, name: 'StatusEmployees-Add'},
		{ path: '/Edit/:status_employee_id', component: Status_Employees_Edit, name: 'StatusEmployees-Edit'},
		{ path: '/Delete/:status_employee_id', component: Status_Employees_Delete, name: 'StatusEmployees-Delete'},
		
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