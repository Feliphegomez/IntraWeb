<script>
	// ------------ TIPOS - SANGRE INICIO ------------------------------------- 
	var Types_Bloods_List = Vue.extend({
	  template: '#page-ActionsPerformancesEmployees',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		apiMV.get('/actions_performances_employees').then(function (response) {
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

	var Types_Bloods_View = Vue.extend({
		template: '#view-ActionsPerformancesEmployees',
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
			self.find();
		},
		methods: {
			find: function(){
				var self = this;
				var idActionPerformanceEmployee = self.$route.params.action_performance_employee_id;
				
				apiMV.get('/actions_performances_employees/' + idActionPerformanceEmployee).then(function (response) {
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

	var Types_Bloods_Add = Vue.extend({
		template: '#add-ActionsPerformancesEmployees',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createTypesBlood: function() {
				var post = this.post;
				apiMV.post('/actions_performances_employees', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Bloods_Edit = Vue.extend({
		template: '#edit-ActionsPerformancesEmployees',
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
			self.find();
		},
		methods: {
			updateTypesBlood: function () {
				var post = this.post;
				apiMV.put('/actions_performances_employees/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			},
			find: function(){
				var self = this;
				var idActionPerformanceEmployee = self.$route.params.action_performance_employee_id;
				
				apiMV.get('/actions_performances_employees/' + idActionPerformanceEmployee).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Bloods_Delete = Vue.extend({
		template: '#delete-ActionsPerformancesEmployees',
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
			self.find();
		},
		methods: {
			deleteTypesBlood: function () {
				var post = this.post;
				
				apiMV.delete('/actions_performances_employees/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			find: function(){
				var self = this;
				var idActionPerformanceEmployee = self.$route.params.action_performance_employee_id;
				
				apiMV.get('/actions_performances_employees/' + idActionPerformanceEmployee).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - SANGRE FIN ------------------------------------- 


	var router = new VueRouter({routes:[
		
		{ path: '/', component: Types_Bloods_List, name: 'ActionsPerformancesEmployees-List'},
		{ path: '/View/:action_performance_employee_id', component: Types_Bloods_View, name: 'ActionsPerformancesEmployees-View'},
		{ path: '/Add', component: Types_Bloods_Add, name: 'ActionsPerformancesEmployees-Add'},
		{ path: '/Edit/:action_performance_employee_id', component: Types_Bloods_Edit, name: 'ActionsPerformancesEmployees-Edit'},
		{ path: '/Delete/:action_performance_employee_id', component: Types_Bloods_Delete, name: 'ActionsPerformancesEmployees-Delete'},

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