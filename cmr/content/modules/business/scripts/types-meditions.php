<script>
	// ------------ TIPOS - MEDICIONES INICIO ------------------------------------- 
	var Types_Meditions_List = Vue.extend({
	  template: '#page-TypesMeditions',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		apiMV.get('/types_meditions', {
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

	var Types_Meditions_View = Vue.extend({
		template: '#view-TypesMeditions',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
					code: '',
				},
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesMedition();
		},
		methods: {
			findTypesMedition: function(){
				var self = this;
				var idTypesMedition = self.$route.params.type_medition_id;
				
				apiMV.get('/types_meditions/' + idTypesMedition).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Meditions_Add = Vue.extend({
		template: '#add-TypesMeditions',
		data: function () {
			return {
				post: {
					name: '',
					code: '',
				}
			}
		},
		methods: {
			createTypesMedition: function() {
				var post = this.post;
				apiMV.post('/types_meditions', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Meditions_Edit = Vue.extend({
		template: '#edit-TypesMeditions',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
					code: '',
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesMedition();
		},
		methods: {
			updateTypesMedition: function () {
				var post = this.post;
				apiMV.put('/types_meditions/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesMedition: function(){
				var self = this;
				var idTypesMedition = self.$route.params.type_medition_id;
				
				apiMV.get('/types_meditions/' + idTypesMedition).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");					
				});
			}
		}
	});

	var Types_Meditions_Delete = Vue.extend({
		template: '#delete-TypesMeditions',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
					code: '',
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesMedition();
		},
		methods: {
			deleteTypesMedition: function () {
				var post = this.post;
				
				apiMV.delete('/types_meditions/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesMedition: function(){
				var self = this;
				var idTypesMedition = self.$route.params.type_medition_id;
				
				apiMV.get('/types_meditions/' + idTypesMedition).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - MEDICIONES FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: Types_Meditions_List, name: 'TypesMeditions-List'},
		{ path: '/View/:type_medition_id', component: Types_Meditions_View, name: 'TypesMeditions-View'},
		{ path: '/Add', component: Types_Meditions_Add, name: 'TypesMeditions-Add'},
		{ path: '/Edit/:type_medition_id', component: Types_Meditions_Edit, name: 'TypesMeditions-Edit'},
		{ path: '/Delete/:type_medition_id', component: Types_Meditions_Delete, name: 'TypesMeditions-Delete'},
			
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