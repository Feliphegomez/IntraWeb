<script>
	// ------------ TIPOS - IDENTIFICACIONES INICIO ------------------------------------- 
	var Types_Identifications_List = Vue.extend({
	  template: '#page-TypesIdentifications',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		apiMV.get('/types_identifications').then(function (response) {
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

	var Types_Identifications_View = Vue.extend({
		template: '#view-TypesIdentifications',
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
			self.findTypesIdentification();
		},
		methods: {
			findTypesIdentification: function(){
				var self = this;
				var idTypesIdentification = self.$route.params.type_identification_id;
				
				apiMV.get('/types_identifications/' + idTypesIdentification).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Identifications_Add = Vue.extend({
		template: '#add-TypesIdentifications',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createTypesIdentification: function() {
				var post = this.post;
				apiMV.post('/types_identifications', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Identifications_Edit = Vue.extend({
		template: '#edit-TypesIdentifications',
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
			self.findTypesIdentification();
		},
		methods: {
			updateTypesIdentification: function () {
				var post = this.post;
				apiMV.put('/types_identifications/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesIdentification: function(){
				var self = this;
				var idTypesIdentification = self.$route.params.type_identification_id;
				
				apiMV.get('/types_identifications/' + idTypesIdentification).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Identifications_Delete = Vue.extend({
		template: '#delete-TypesIdentifications',
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
			self.findTypesIdentification();
		},
		methods: {
			deleteTypesIdentification: function () {
				var post = this.post;
				
				apiMV.delete('/types_identifications/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesIdentification: function(){
				var self = this;
				var idTypesIdentification = self.$route.params.type_identification_id;
				
				apiMV.get('/types_identifications/' + idTypesIdentification).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
					
				});
			}
		}
	});
	// ------------ TIPOS - IDENTIFICACIONES FIN ------------------------------------- 


	var router = new VueRouter({routes:[
		{ path: '/', component: Types_Identifications_List, name: 'TypesIdentifications-List'},
		{ path: '/View/:type_identification_id', component: Types_Identifications_View, name: 'TypesIdentifications-View'},
		{ path: '/Add', component: Types_Identifications_Add, name: 'TypesIdentifications-Add'},
		{ path: '/Edit/:type_identification_id', component: Types_Identifications_Edit, name: 'TypesIdentifications-Edit'},
		{ path: '/Delete/:type_identification_id', component: Types_Identifications_Delete, name: 'TypesIdentifications-Delete'},
		
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