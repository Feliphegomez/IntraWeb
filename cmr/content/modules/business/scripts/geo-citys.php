<script>

	// ------------ GEO - CIUDADES INICIO ------------------------------------- 
	var GEO_Citys_List = Vue.extend({
	  template: '#page-GEO-Citys',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		
		self.posts = [];
		apiMV.get('/geo_citys?order=department,asc&order=name,asc', {
			params: {
				join: 'geo_departments',
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

	var GEO_Citys_View = Vue.extend({
		template: '#view-GEO-Citys',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
					department: 0,
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
				var idCityGEO = self.$route.params.geo_city_id;
				
				apiMV.get('/geo_citys/' + idCityGEO, {
					params: {
						join: 'geo_departments'
					}
				}).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var GEO_Citys_Add = Vue.extend({
		template: '#add-GEO-Citys',
		data: function () {
			return {
				selectOptions: {
					departments: [],
				},
				post: {
					department: 0,
					name: '',
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
				apiMV.get('/geo_departments', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.departments = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			createDepartmentGEO: function() {
				var post = this.post;
				apiMV.post('/geo_citys', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var GEO_Citys_Edit = Vue.extend({
		template: '#edit-GEO-Citys',
		data: function () {
			return {
				selectOptions: {
					departments: [],
				},
				post: {
					id: 0,
					department: 0,
					name: '',
				}
			};
		},
		mounted: function () {
			var self = this;
			self.loadSelects();
			self.findCityGEO();
		},
		methods: {
			loadSelects: function(){
				var self = this;
				apiMV.get('/geo_departments', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.departments = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			updateCityGEO: function () {
				var post = this.post;
				apiMV.put('/geo_citys/' + post.id, post).then(function (response) {
					console.log(response.data);
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				router.push('/');
			},
			findCityGEO: function(){
				var self = this;
				var idCityGEO = self.$route.params.geo_city_id;
				
				apiMV.get('/geo_citys/' + idCityGEO).then(function (response) {
					if(!response.data.id || !response.data.name)
					{
						router.push('/');
					}
					else
					{
						self.post = response.data;
					}
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
					router.push('/');
				});
			}
		}
	});

	var GEO_Citys_Delete = Vue.extend({
		template: '#delete-GEO-Citys',
		data: function () {
			return {
				post: {
					id: 0,
					department: 0,
					name: ''
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findCityGEO();
		},
		methods: {
			deleteCityGEO: function () {
				var post = this.post;
				
				apiMV.delete('/geo_citys/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findCityGEO: function(){
				var self = this;
				var idCityGEO = self.$route.params.geo_city_id;
				
				apiMV.get('/geo_citys/' + idCityGEO).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ GEO - CIUDADES FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: GEO_Citys_List, name: 'CitysGEO-List'},
		{ path: '/View/:geo_city_id', component: GEO_Citys_View, name: 'CitysGEO-View'},
		{ path: '/Add', component: GEO_Citys_Add, name: 'CitysGEO-Add'},
		{ path: '/Edit/:geo_city_id', component: GEO_Citys_Edit, name: 'CitysGEO-Edit'},
		{ path: '/Delete/:geo_city_id', component: GEO_Citys_Delete, name: 'CitysGEO-Delete'},
		
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