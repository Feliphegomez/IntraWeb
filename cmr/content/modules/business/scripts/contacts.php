<script>
	// ------------ TIPOS - CLIENTES INICIO ------------------------------------- 
	var Contacts_List = Vue.extend({
	  template: '#page-Contacts',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		self.posts = [];
		apiMV.get('/contacts').then(function (response) {
			self.posts = response.data.records;
			$(document).ready(function() { $('#dataTable').DataTable(); });
		}).catch(function (error) {
			$.notify(error.response.data.code + error.response.data.message, "error");
		});
	  },
	  computed: {
		filteredposts: function () {
		  return this.posts.filter(function (post) {
			return this.searchKey=='' || post.identification_number.indexOf(this.searchKey) !== -1;
		  },this);
		}
	  }
	});

	var Contacts_View = Vue.extend({
		template: '#view-Contacts',
		data: function () {
			return {
				post: {
					id: 0,
					identification_type: {
						id: 0,
						name: '',
					},
					identification_number: '',
					first_name: '',
					second_name: '',
					surname: '',
					second_surname: '',
					phone: '',
					phone_mobile: '',
					mail: '',
					department: {
						id: 0,
						name: '',
					},
					city: {
						id: 0,
						name: '',
					},
					address: '',
					geo_address: '',
				},
				post_contacts: [],
			};
		},
		mounted: function () {
			var self = this;
			self.findContact();
		},
		methods: {
			findContact: function(){
				var self = this;
				var idContact = self.$route.params.contact_id;
				
				apiMV.get('/contacts/' + idContact, {
					params: {
						join: [
							'types_identifications',
							'geo_departments',
							'geo_citys',
						],
					}
				}).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");					
				});
			}
		}
	});

	var Contacts_Add = Vue.extend({
		template: '#add-Contacts',
		data: function () {
			return {
				selectOptions: {
					types_identifications: [],
					geo_departments: [],
					geo_citys: [
						{
							id: 0,
							name: 'Selecciona el department',
						},
					],
				},
				post: {
					id: 0,
					identification_type: 0,
					identification_number: '',
					first_name: '',
					second_name: '',
					surname: '',
					second_surname: '',
					phone: '',
					phone_mobile: '',
					mail: '',
					department: 0,
					city: 0,
					address: '',
					geo_address: '',
				}
			}
		},
		mounted: function(){
			var self = this;
			self.loadSelects();
		},
		methods: {
			loadSelects: function(){
				var self = this;
				
				apiMV.get('/types_identifications', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.types_identifications = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/geo_departments', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.geo_departments = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			},
			loadCitys: function(){
				var self = this;
				
				apiMV.get('/geo_citys', {
					params: {
						order: 'name,asc',
						filter: 'department,eq,' + self.post.department,
					}
				}).then(function (response) {
					self.selectOptions.geo_citys = response.data.records;
					
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			createContact: function() {
				var post = this.post;
				apiMV.post('/contacts', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Contacts_Edit = Vue.extend({
		template: '#edit-Contacts',
		data: function () {
			return {
				selectOptions: {
					types_identifications: [],
					geo_departments: [],
					geo_citys: [],
				},
				post: {
					id: 0,
					identification_type: 0,
					identification_number: '',
					first_name: '',
					second_name: '',
					surname: '',
					second_surname: '',
					phone: '',
					phone_mobile: '',
					mail: '',
					department: 0,
					city: 0,
					address: '',
					geo_address: '',
				}
			};
		},
		mounted: function () {
			var self = this;
			self.loadSelects();
			self.findContact();
		},
		methods: {
			loadSelects: function(){
				var self = this;
				
				apiMV.get('/types_identifications', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.types_identifications = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/geo_departments', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.geo_departments = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			loadCitys: function(){
				var self = this;
				
				apiMV.get('/geo_citys', {
					params: {
						order: 'name,asc',
						filter: 'department,eq,' + self.post.department,
					}
				}).then(function (response) {
					self.selectOptions.geo_citys = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			updateContact: function () {
				var post = this.post;
				apiMV.put('/contacts/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findContact: function(){
				var self = this;
				var idContact = self.$route.params.contact_id;
				
				apiMV.get('/contacts/' + idContact).then(function (response) {
					apiMV.get('/geo_citys', {
						params: {
							order: 'name,asc',
							filter: 'department,eq,' + response.data.department,
						}
					}).then(function (response2) {
						self.selectOptions.geo_citys = response2.data.records;
						self.post = response.data;
				
					}).catch(function (error) {
						$.notify(error.response.data.code + error.response.data.message, "error");
					});				
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Contacts_Delete = Vue.extend({
		template: '#delete-Contacts',
		data: function () {
			return {
				post: {
					id: 0,
					identification_type: 0,
					identification_number: '',
					first_name: '',
					second_name: '',
					surname: '',
					second_surname: '',
					phone: '',
					phone_mobile: '',
					mail: '',
					department: 0,
					city: 0,
					address: '',
					geo_address: '',
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findContact();
		},
		methods: {
			deleteContact: function () {
				var post = this.post;
				apiMV.delete('/contacts/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findContact: function(){
				var self = this;
				var idContact = self.$route.params.contact_id;
				apiMV.get('/contacts/' + idContact).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - CLIENTES FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: Contacts_List, name: 'Contacts-List'},
		{ path: '/View/:contact_id', component: Contacts_View, name: 'Contacts-View'},
		{ path: '/Add', component: Contacts_Add, name: 'Contacts-Add'},
		{ path: '/Edit/:contact_id', component: Contacts_Edit, name: 'Contacts-Edit'},
		{ path: '/Delete/:contact_id', component: Contacts_Delete, name: 'Contacts-Delete'},
		
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