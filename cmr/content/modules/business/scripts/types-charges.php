<script>
	// ------------ TIPOS - CARGOS - INICIO ------------------------------------- 
	var Types_Charges_List = Vue.extend({
	  template: '#page-TypesCharges',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		self.posts = [];
		apiMV.get('/types_charges').then(function (response) {
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

	var Types_Charges_View = Vue.extend({
		template: '#view-TypesCharges',
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
			self.findTypesCharge();
		},
		methods: {
			findTypesCharge: function(){
				var self = this;
				var idTypesCharge = self.$route.params.type_charge_id;
				
				apiMV.get('/types_charges/' + idTypesCharge).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Charges_Add = Vue.extend({
		template: '#add-TypesCharges',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createTypesCharge: function() {
				var post = this.post;
				apiMV.post('/types_charges', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Charges_Edit = Vue.extend({
		template: '#edit-TypesCharges',
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
			self.findTypesCharge();
		},
		methods: {
			updateTypesCharge: function () {
				var post = this.post;
				apiMV.put('/types_charges/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesCharge: function(){
				var self = this;
				var idTypesCharge = self.$route.params.type_charge_id;
				
				apiMV.get('/types_charges/' + idTypesCharge).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Charges_Delete = Vue.extend({
		template: '#delete-TypesCharges',
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
			self.findTypesCharge();
		},
		methods: {
			deleteTypesCharge: function () {
				var post = this.post;
				
				apiMV.delete('/types_charges/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesCharge: function(){
				var self = this;
				var idTypesCharge = self.$route.params.type_charge_id;
				
				apiMV.get('/types_charges/' + idTypesCharge).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - CARGOS - FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: Types_Charges_List, name: 'TypesCharges-List'},
		{ path: '/View/:type_charge_id', component: Types_Charges_View, name: 'TypesCharges-View'},
		{ path: '/Add', component: Types_Charges_Add, name: 'TypesCharges-Add'},
		{ path: '/Edit/:type_charge_id', component: Types_Charges_Edit, name: 'TypesCharges-Edit'},
		{ path: '/Delete/:type_charge_id', component: Types_Charges_Delete, name: 'TypesCharges-Delete'},
		
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