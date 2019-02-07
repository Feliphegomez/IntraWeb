<script>
	// ------------ GEO - DEPARTAMENTOS INICIO ------------------------------------- 
	var GEO_Departments_List = Vue.extend({
	  template: '#page-GEO-Departments',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		self.posts = [];
		apiMV.get('/geo_departments', {
			params: {
				order: [
					'name',
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

	var GEO_Departments_View = Vue.extend({
		template: '#view-GEO-Departments',
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
			self.findDepartmentGEO();
		},
		methods: {
			findDepartmentGEO: function(){
				var self = this;
				var idDepartmentGEO = self.$route.params.geo_department_id;
				
				apiMV.get('/geo_departments/' + idDepartmentGEO).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	
	var GEO_Departments_Add = Vue.extend({
		template: '#add-GEO-Departments',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createDepartmentGEO: function() {
				var post = this.post;
				apiMV.post('/geo_departments', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var GEO_Departments_Edit = Vue.extend({
		template: '#edit-GEO-Departments',
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
			self.findDepartmentGEO();
		},
		methods: {
			updateDepartmentGEO: function () {
				var post = this.post;
				apiMV.put('/geo_departments/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findDepartmentGEO: function(){
				var self = this;
				var idDepartmentGEO = self.$route.params.geo_department_id;
				
				apiMV.get('/geo_departments/' + idDepartmentGEO).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var GEO_Departments_Delete = Vue.extend({
		template: '#delete-GEO-Departments',
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
			self.findDepartmentGEO();
		},
		methods: {
			deleteDepartmentGEO: function () {
				var post = this.post;
				
				apiMV.delete('/geo_departments/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findDepartmentGEO: function(){
				var self = this;
				var idDepartmentGEO = self.$route.params.geo_department_id;
				
				apiMV.get('/geo_departments/' + idDepartmentGEO).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ GEO - DEPARTAMENTOS FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: GEO_Departments_List, name: 'DepartmentsGEO-List'},
		{ path: '/View/:geo_department_id', component: GEO_Departments_View, name: 'DepartmentsGEO-View'},
		{ path: '/Add', component: GEO_Departments_Add, name: 'DepartmentsGEO-Add'},
		{ path: '/Edit/:geo_department_id', component: GEO_Departments_Edit, name: 'DepartmentsGEO-Edit'},
		{ path: '/Delete/:geo_department_id', component: GEO_Departments_Delete, name: 'DepartmentsGEO-Delete'},
	
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
