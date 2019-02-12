
<script>
	// ------------ INICIO ------------------------------------- 
	var Company_Info_View = Vue.extend({
		template: '#page-Company-Info-View',
		data: function () {
			return {
				post: {
					id_encode: (this.$route.params.company_id),
					id: atob(this.$route.params.company_id),
					type: {
						id: 0,
						name: ''
					},
					identification_type: {
						id: 0,
						name: ''
					},
					identification_number: '',
					social_reason: '',
					tradename: '',
					society_type: {
						id: 0,
						name: '',
						description: ''
					},
					department: {
						id: 0,
						code: '',
						name: ''
					},
					city: {
						id: 0,
						name: '',
						department: ''
					},
					address: '',
					geo_address: '',
					legal_representative: {
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
						geo_address:''
					},
					contact_principal: {
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
						geo_address:''
					},
					enable_audit: 0,
					accounts_clients: [],
				},
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			console.log("Creado");
			
			apiMV.get('/clients/' + self.post.id, {
				params: {
					join: [
						'types_clients',
						'types_identifications',
						'types_societys',
						'geo_departments',
						'geo_citys',
						'contacts',
					],
				}
			}).then(function (response) {
				self.post = response.data;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	});
	
	var Company_Invoice_View = Vue.extend({
		template: '#page-Company-Invoices-View',
		data: function () {
			return {
				post: {
					id_encode: (this.$route.params.company_id),
					id: atob(this.$route.params.company_id),
					type: {
						id: 0,
						name: ''
					},
					identification_type: {
						id: 0,
						name: ''
					},
					identification_number: '',
					social_reason: '',
					tradename: '',
					society_type: {
						id: 0,
						name: '',
						description: ''
					},
					department: {
						id: 0,
						code: '',
						name: ''
					},
					city: {
						id: 0,
						name: '',
						department: ''
					},
					address: '',
					geo_address: '',
					legal_representative: {
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
						geo_address:''
					},
					contact_principal: {
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
						geo_address:''
					},
					enable_audit: 0,
					accounts_clients: [],
				},
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			console.log("Creado");
			
			apiMV.get('/clients/' + self.post.id, {
				params: {
					join: [
						'types_clients',
						'types_identifications',
						'types_societys',
						'geo_departments',
						'geo_citys',
						'contacts',
					],
				}
			}).then(function (response) {
				self.post = response.data;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	});
	
	var Company_Requests_View = Vue.extend({
		template: '#page-Company-Requests-View',
		data: function () {
			return {
				post: {
					id_encode: (this.$route.params.company_id),
					id: atob(this.$route.params.company_id),
					type: {
						id: 0,
						name: ''
					},
					identification_type: {
						id: 0,
						name: ''
					},
					identification_number: '',
					social_reason: '',
					tradename: '',
					society_type: {
						id: 0,
						name: '',
						description: ''
					},
					department: {
						id: 0,
						code: '',
						name: ''
					},
					city: {
						id: 0,
						name: '',
						department: ''
					},
					address: '',
					geo_address: '',
					legal_representative: {
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
						geo_address:''
					},
					contact_principal: {
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
						geo_address:''
					},
					enable_audit: 0,
					accounts_clients: [],
				},
				posts: [],
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			console.log("Creado");
			
			apiMV.get('/accounts_clients/', {
				params: {
					filter: [
						'client,eq,' + self.post.id,
					],
					join: [
					],
				}
			}).then(function (response) {
				self.posts = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	});
	// ------------ FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/:company_id', component: Company_Info_View, name: 'Company-Info-View'},
		{ path: '/:company_id/Invoices', component: Company_Invoice_View, name: 'Company-Invoices-View'},
		{ path: '/:company_id/Requests', component: Company_Requests_View, name: 'Company-Requests-View'},
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
	
	/*
	var router = new VueRouter({routes:[
		{ path: '/Add', component: ARL_Add, name: 'ARL-Add'},
		{ path: '/View/:arl_id', component: ARL_View, name: 'ARL-View'},
		{ path: '/Edit/:arl_id', component: ARL_Edit, name: 'ARL-Edit'},
		{ path: '/Delete/:arl_id', component: ARL_Delete, name: 'ARL-Delete'},
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
	*/
</script>