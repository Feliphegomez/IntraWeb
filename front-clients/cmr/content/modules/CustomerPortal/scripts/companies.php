<script>
	// ------------ INICIO ------------------------------------- 
	var Sidebar_Clients_Component = Vue.component('component-sidebar-clients', {
		template: '#Sidebar-Clients-Component',
		props: [
			'company_id'
		],
	});

	var Company_Info_Edit = Vue.extend({
		template: '#page-Company-Info-View',
		data: function () {
			return {
				company_id: this.$route.params.company_id,
				post: {
					id: this.$route.params.company_id,
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

	var Company_Invoice_List = Vue.extend({
		template: '#page-Company-Invoices-List',
		data: function () {
			return {
				company_id: this.$route.params.company_id,
				post: {
					id: this.$route.params.company_id,
				},
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			
		},
	});

	var Company_Requests_List = Vue.extend({
		template: '#page-Company-Requests-List',
		data: function () {
			return {
				company_id: this.$route.params.company_id,
				post: {
					id: this.$route.params.company_id,
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
			
			apiMV.get('/accounts_clients/', {
				params: {
					filter: [
						'client,eq,' + self.company_id,
					],
					join: [
						'contacts',
						'contacts,types_identifications',
						'geo_departments',
						'services_clients',
						'services_clients,services',
						'attributes_services_clients',
						'quotations_clients',
					],
				}
			}).then(function (response) {
				self.posts = response.data.records;
			}).catch(function (error) {
				console.log(error);
				//$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	});

	var Company_Requests_View = Vue.extend({
		template: '#page-Company-Requests-View',
		data: function () {
			return {
				request_id: this.$route.params.request_id,
				company_id: this.$route.params.company_id,
				post: {
					id: this.$route.params.request_id,
					client: this.$route.params.company_id,
					name: '',
					contact: {
						id: 0,
						identification_type: {
							id: 0,
							name: ''
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
							code: '',
							name: ''
						},
						city: {
							id: 0,
							name: '',
							department: 0
						},
						address: '',
						geo_address: '',
						clients: []
					},
					address: '',
					observations: '',
					geo_address: '',
					address_invoices: '',
					geo_address_invoices: '',
					create: '',
					update: '',
					services_clients: [],
					quotations_clients: [],
					attributes_services_clients: [],
				},
				posts: [],
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			self.find();
		},
		methods: {
			find: function(){
				var self = this;
				
				apiMV.get('/accounts_clients/' + self.request_id + '/', {
					params: {
						filter: [
							'client,eq,' + self.company_id,
						],
						join: [
							'contacts',
							'contacts,types_identifications',
							'geo_departments',
							'services_clients',
							'services_clients,services',
							'attributes_services_clients',
							'quotations_clients',
							'contacts,geo_departments',
							'contacts,geo_citys',
							'services_clients,services,types_meditions',
							'attributes_services_clients,attributes',
							'attributes_services_clients,attributes,types_meditions',
							'quotations_clients,status_quotations',
						],
					}
				}).then(function (response) {
					self.post = response.data;
					self.normalizarJson();
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			normalizarJson: function (){	
				var self = this;
				var i;
				for (i = 0; i < self.post.quotations_clients.length; i++) {
					// self.post.quotations_clients[i].values = JSON.stringify(self.post.quotations_clients[i].values);
					var valTemp = self.post.quotations_clients[i].values;
					
					self.post.quotations_clients[i].values = JSON.parse(valTemp);
				}
			},
			sumarTodo: function (){
				var self = this;			
				var i;
				for (i = 0; i < self.post.services_clients.length; i++) {
					//text += cars[i];
					self.priceTotal = self.priceTotal + self.post.services_clients[i].service.price;
				}
				var i;
				for (i = 0; i < self.post.attributes_services_clients.length; i++) {
					//text += cars[i];
					self.priceTotal = self.priceTotal + self.post.attributes_services_clients[i].attribute.price;
				}
				
				self.priceTotal = self.$parent.formatMoney(self.priceTotal);
			},
		}
	});

	var Company_Quotations_View = Vue.extend({
		template: '#page-Company-Quotations-View',
		data: function () {
			return {
				request_id: this.$route.params.request_id,
				company_id: this.$route.params.company_id,
				quotation_id: this.$route.params.quotation_id,
				post: {
					id: this.$route.params.quotation_id,
					client: 0,
					account: {
						id: 0,
						client: 0,
						name: '',
						contact: 0,
						address: '',
						observations: '',
						geo_address: '',
						address_invoices: '',
						geo_address_invoices: '',
						create: '',
						update: ''
					},
					values: {
						services: [],
						attributes: [],
					},
					status: {
						id: 0,
						name: ''
					},
					create: '',
					update:'',
					validity: 0,
					accept: ''
				},
				posts: [],
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			self.find();
		},
		methods: {
			find: function(){
				var self = this;
					
				apiMV.get('/quotations_clients/' + self.quotation_id, {
					params: {
						join: [
							'accounts_clients',
							'status_quotations',
							'accounts_clients,contacts',
						],
					}
				}).then(function (response) {
					self.post = response.data;
					self.post.values = JSON.parse(self.post.values);
					
					
				}).catch(function (error) {
					console.log('Ok');
					// $.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			changeStatusQuotations: function(a,b,c,d){
				var self = this;
				var temp = {
					id: Number(c),
					status: Number(d),
				};
				bootbox.confirm({
					title: "Validacion de seguridad",
					message: "¿Quieres aprobar estó ahora? Un representante será notificado para que se ponga en contacto contigo en caso de ser necesario.",
					buttons: {
						cancel: {
							label: '<i class="fa fa-times"></i> Aprobar Luego'
						},
						confirm: {
							label: '<i class="fa fa-check"></i> Aprobar Ahora'
						}
					},
					callback: function (result) {
						console.log('This was logged in the callback: ' + result);
						
						if(result == true){
							apiMV.get('/quotations_clients/' + c, {
								params: {
									filter: [
										'client,eq,' + Number(a),
										'account,eq,' + Number(b),
									],
									join: [
									],
								}
							}).then(function (r) {
								if(r.data.id != undefined){
									console.log(temp);
									apiMV.put('/quotations_clients/' + temp.id, temp).then(function (u) {
										$.notify("Cambiado con éxito.", "success");
										console.log(u)
										console.log(temp)
										location.reload();
									}).catch(function (eu) {
										console.log(eu);
										console.log(eu.error);
										$.notify(eu.error.data.code + eu.error.data.message, "error");
									});
								}
							}).catch(function (er) {
								console.log(er);
								$.notify(er.r.data.code + er.r.data.message, "error");
							});
						}
					}
				});
			},
		}
	});

	var BASE = Vue.extend({
		template: '#page-Company-Quotations-View',
		data: function () {
			return {
				request_id: this.$route.params.request_id,
				company_id: this.$route.params.company_id,
				post: {
					id: this.$route.params.request_id,
					client: this.$route.params.company_id,
					name: '',
					contact: {
						id: 0,
						identification_type: {
							id: 0,
							name: ''
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
							code: '',
							name: ''
						},
						city: {
							id: 0,
							name: '',
							department: 0
						},
						address: '',
						geo_address: '',
						clients: []
					},
					address: '',
					observations: '',
					geo_address: '',
					address_invoices: '',
					geo_address_invoices: '',
					create: '',
					update: '',
					services_clients: [],
					quotations_clients: [],
					attributes_services_clients: [],
				},
				posts: [],
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			self.find();
		},
		methods: {
			find: function(){
				var self = this;
				
			},
			
		}
	});

	// ------------ FIN -------------------------------------
	var router = new VueRouter({routes:[
		{ path: '/:company_id', component: Company_Info_Edit, name: 'Company-Info-View'},
		{ path: '/:company_id/Invoices', component: Company_Invoice_List, name: 'Company-Invoices-List'},
		{ path: '/:company_id/Requests', component: Company_Requests_List, name: 'Company-Requests-List'},
		{ path: '/:company_id/Requests/View/:request_id', component: Company_Requests_View, name: 'Company-Requests-View'},
		{ path: '/:company_id/Requests/View/:request_id/Quotations/View/:quotation_id', component: Company_Quotations_View, name: 'Company-Quotations-View'},
	]});

	var appRender = new Vue({
		components: {
			'component-sidebar-clients': Sidebar_Clients_Component
		},
		data: function () {
			return {
			};
		},
		router:router,
		mounted: function () {
			var self = this;
		},
		methods: {
			zfill: function(number, width) {
				var numberOutput = Math.abs(number); /* Valor absoluto del número */
				var length = number.toString().length; /* Largo del número */ 
				var zero = "0"; /* String de cero */  
				
				if (width <= length) {
					if (number < 0) {
						 return ("-" + numberOutput.toString()); 
					} else {
						 return numberOutput.toString(); 
					}
				} else {
					if (number < 0) {
						return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
					} else {
						return ((zero.repeat(width - length)) + numberOutput.toString()); 
					}
				}
			},
			formatMoney: function(n, c, d, t){
				var c = isNaN(c = Math.abs(c)) ? 2 : c,
					d = d == undefined ? "." : d,
					t = t == undefined ? "," : t,
					s = n < 0 ? "-" : "",
					i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
					j = (j = i.length) > 3 ? j % 3 : 0;

				return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
			},
		}
	}).$mount('#app');

</script>