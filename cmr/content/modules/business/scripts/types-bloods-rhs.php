<script>

	// ------------ TIPOS - SANGRE INICIO ------------------------------------- 
	var Types_BloodsRH_List = Vue.extend({
	  template: '#page-TypesBloodsRH',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		self.posts = [];
		apiMV.get('/types_bloods_rhs', {
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

	var Types_BloodsRH_View = Vue.extend({
		template: '#view-TypesBloodsRH',
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
			self.findTypesBloodRH();
		},
		methods: {
			findTypesBloodRH: function(){
				var self = this;
				var idTypesBloodRH = self.$route.params.type_blood_rh_id;
				
				apiMV.get('/types_bloods_rhs/' + idTypesBloodRH).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
					router.push('/');
				});
			}
		}
	});

	var Types_BloodsRH_Add = Vue.extend({
		template: '#add-TypesBloodsRH',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createTypesBloodRH: function() {
				var post = this.post;
				apiMV.post('/types_bloods_rhs', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_BloodsRH_Edit = Vue.extend({
		template: '#edit-TypesBloodsRH',
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
			self.findTypesBloodRH();
		},
		methods: {
			updateTypesBloodRH: function () {
				var post = this.post;
				apiMV.put('/types_bloods_rhs/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesBloodRH: function(){
				var self = this;
				var idTypesBloodRH = self.$route.params.type_blood_rh_id;
				
				apiMV.get('/types_bloods_rhs/' + idTypesBloodRH).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_BloodsRH_Delete = Vue.extend({
		template: '#delete-TypesBloodsRH',
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
			self.findTypesBloodRH();
		},
		methods: {
			deleteTypesBloodRH: function () {
				var post = this.post;
				
				apiMV.delete('/types_bloods_rhs/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesBloodRH: function(){
				var self = this;
				var idTypesBloodRH = self.$route.params.type_blood_rh_id;
				
				apiMV.get('/types_bloods_rhs/' + idTypesBloodRH).then(function (response) {
					self.post = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - SANGRE FIN ------------------------------------- 


	var router = new VueRouter({routes:[
		{ path: '/', component: Types_BloodsRH_List, name: 'TypesBloodsRH-List'},
		{ path: '/View/:type_blood_rh_id', component: Types_BloodsRH_View, name: 'TypesBloodsRH-View'},
		{ path: '/Add', component: Types_BloodsRH_Add, name: 'TypesBloodsRH-Add'},
		{ path: '/Edit/:type_blood_rh_id', component: Types_BloodsRH_Edit, name: 'TypesBloodsRH-Edit'},
		{ path: '/Delete/:type_blood_rh_id', component: Types_BloodsRH_Delete, name: 'TypesBloodsRH-Delete'},
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