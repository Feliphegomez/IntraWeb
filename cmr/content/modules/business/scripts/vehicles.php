<script>
	// ------------ VEHICULOS INICIO ------------------------------------- 
	var Vehicles_List = Vue.extend({
	  template: '#page-Vehicles',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		apiMV.get('/vehicles', {
			params: {
				join: [
					'types_vehicles',
					'types_fuels',
					'contacts',
					'status_vehicles',
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
			return this.searchKey=='' || post.license_plate.indexOf(this.searchKey) !== -1;
		  },this);
		}
	  }
	});

	var Vehicles_View = Vue.extend({
		template: '#view-Vehicles',
		data: function () {
			return {
				post: {
					id: 0,
					license_plate: '',
					brand: '',
					model: '',
					type_vehicle: {
						id: 0,
						name: '',
					},
					passangers_capacity: 0,
					type_fuel: {
						id: 0,
						name: '',
					},
					cilindraje: '',
					holder: {
						id: 0,
						first_name: '',
						second_name: '',
						surname: '',
						second_surname: '',
						phone: '',
						phone_mobile: '',
						mail: '',
					},
					propietary: {
						id: 0,
						first_name: '',
						second_name: '',
						surname: '',
						second_surname: '',
						phone: '',
						phone_mobile: '',
						mail: '',
					},
					card_propiety_number: '',
					chassis_number: '',
					soat_number: '',
					third_party_number: '',
					soat_date_expiration: '',
					third_party_date_expiration: '',
					capacity_with_enhancement: '',
					capacity_without_enhancement: '',
					base_weight: '',
					rent_cost: '',
					status: {
						id: 0,
						name: '',
					},
				},
				galery_vehicles: [],
				crew: [],
			};
		},
		mounted: function () {
			var self = this;
			self.findVehicle();
		},
		methods: {
			findVehicle: function(){
				var self = this;
				var idVehicles = self.$route.params.vehicle_id;
				
				apiMV.get('/vehicles/' + idVehicles, {
					params: {
						join: [
							'types_vehicles',
							'types_fuels',
							'contacts',
							'status_vehicles',
						],
					}
				}).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/crew_vehicles', {
					params: {
						filter: [
							'vehicle,eq,' + idVehicles,
						],
						join: [
							'employees',
							'types_charges',
						],
					}
				}).then(function (response) {
					self.crew = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/galery_vehicles', {
					params: {
						filter: [
							'vehicle,eq,' + idVehicles,
						],
						join: [
							//'pictures',
						],
					}
				}).then(function (response) {
					self.galery_vehicles = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			}
		}
	});

	var Vehicles_Add = Vue.extend({
		template: '#add-Vehicles',
		data: function () {
			return {
				selectOptions: {
					types_vehicles: [],
					types_fuels: [],
					contacts: [],
					status_vehicles: [],
				},
				post: {
					license_plate: '',
					brand: '',
					model: '',
					type_vehicle: 0,
					passangers_capacity: 0,
					type_fuel: 0,
					cilindraje: '',
					holder: 0,
					propietary: 0,
					card_propiety_number: '',
					chassis_number: '',
					soat_number: '',
					third_party_number: '',
					soat_date_expiration: '',
					third_party_date_expiration: '',
					capacity_with_enhancement: '',
					capacity_without_enhancement: '',
					base_weight: '',
					rent_cost: '',
					status: 0,
				},
			}
		},
		mounted: function(){
			var self = this;
			self.loadSelects();
		},
		methods: {
			loadSelects: function(){
				var self = this;
				apiMV.get('/types_vehicles', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.types_vehicles = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/types_fuels', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.types_fuels = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/contacts', {
					params: {
						order: 'identification_number,asc',
					}
				}).then(function (response) {
					self.selectOptions.contacts = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/status_vehicles', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.status_vehicles = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			createVehicle: function() {
				var post = this.post;
				apiMV.post('/vehicles', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});				
			}
		}
	});

	var Vehicles_Edit = Vue.extend({
		template: '#edit-Vehicles',
		data: function () {
			return {
				selectOptions: {
					types_vehicles: [],
					types_fuels: [],
					contacts: [],
					employees: [],
					status_vehicles: [],
					types_charges: [],
				},
				post_crew: {
					vehicle: 0,
					charge: 0,
					employee: 0,
				},
				post: {
					id: 0,
					license_plate: '',
					brand: '',
					model: '',
					type_vehicle: 0,
					passangers_capacity: 0,
					type_fuel: 0,
					cilindraje: '',
					holder: 0,
					propietary: 0,
					card_propiety_number: '',
					chassis_number: '',
					soat_number: '',
					third_party_number: '',
					soat_date_expiration: '',
					third_party_date_expiration: '',
					capacity_with_enhancement: '',
					capacity_without_enhancement: '',
					base_weight: '',
					rent_cost: '',
					status: 0,
				},
				crew: [],
				image_preview: {
					name: '',
					size: 0,
					data: '',
					type: '',
				},
				galery_vehicles: [],
			};
		},
		mounted: function () {
			var self = this;
			self.loadSelects();
			self.findVehicle();
		},
		methods: {
			loadSelects: function(){
				var self = this;
				apiMV.get('/types_vehicles', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.types_vehicles = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/types_fuels', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.types_fuels = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/types_charges', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.types_charges = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/contacts', {
					params: {
						order: 'identification_number,asc',
					}
				}).then(function (response) {
					self.selectOptions.contacts = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/employees', {
					params: {
						
					}
				}).then(function (response) {
					self.selectOptions.employees = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/status_vehicles', {
					params: {
						order: 'name,asc',
					}
				}).then(function (response) {
					self.selectOptions.status_vehicles = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			updateVehicle: function () {
				var post = this.post;
				apiMV.put('/vehicles/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			includeCrewVehicle: function () {
				var self = this;
				console.log(self.post_crew);
				
				apiMV.post('/crew_vehicles', self.post_crew).then(function (response) {
					// post.id = response.data;
					$("#includeCrewVehicle-Fast").hide();
					self.post_crew.charge = 0;
					self.post_crew.employee = 0;
					self.findVehicle();
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			},
			findVehicle: function(){
				var self = this;
				var idVehicles = self.$route.params.vehicle_id;
				
				apiMV.get('/vehicles/' + idVehicles).then(function (response) {				
					self.post = response.data;
					self.post_crew.vehicle = response.data.id;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/crew_vehicles', {
					params: {
						filter: [
							'vehicle,eq,' + idVehicles,
						],
						join: [
							'employees',
							'types_charges',
						],
					}
				}).then(function (response) {
					self.crew = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
				apiMV.get('/galery_vehicles', {
					params: {
						filter: [
							'vehicle,eq,' + idVehicles,
						],
						join: [
							//'pictures',
						],
					}
				}).then(function (response) {
					self.galery_vehicles = response.data.records;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			changeImage: function(e){
				var self = this;
				var image = e;
				var file = image.target.files[0];
				var reader = new FileReader();
				// Set preview image into the popover data-content

				reader.onload = function (e) {
					self.image_preview.name = file.name;
					self.image_preview.size = file.size;
					self.image_preview.data = e.target.result;
					self.image_preview.type = file.type;
					//img.attr('src', e.target.result);
					///$(".image-preview-filename").val(file.name);
					$(".image-preview-input-title").text("Subir Otra");

					//$(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");


					apiMV.post('/pictures', self.image_preview).then(function (response) {
						var imageId = response.data;
						var tempInsert = {};
						
						tempInsert.picture = imageId;
						tempInsert.vehicle = self.post.id;
						
						apiMV.post('/galery_vehicles', tempInsert).then(function (response) {
							var imageId = response.data;
							//location.reload();
							self.findVehicle();
						}).catch(function (error) {
							$.notify(error.response.data.code + error.response.data.message, "error");
						});
					}).catch(function (error) {
						$.notify(error.response.data.code + error.response.data.message, "error");
					});
				}        
				reader.readAsDataURL(file);
			}
		}
	});

	var Vehicles_Delete = Vue.extend({
		template: '#delete-Vehicles',
		data: function () {
			return {
				post: {
					id: 0,
					license_plate: ''
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findVehicle();
		},
		methods: {
			deleteVehicle: function () {
				var post = this.post;
				
				apiMV.delete('/vehicles/' + post.id).then(function (response) {
					// console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findVehicle: function(){
				var self = this;
				var idVehicles = self.$route.params.vehicle_id;
				
				apiMV.get('/vehicles/' + idVehicles).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Crew_Vehicle_Delete = Vue.extend({
		template: '#delete-includeCrewVehicle',
		data: function () {
			return {
				post: {
					id: 0,
					charge: 0,
					vehicle: 0,
					employee: 0,
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findCrewVehicle();
		},
		methods: {
			deleteCrewVehicle: function () {
				var self = this;
				var idCrewVehicles = self.$route.params.vehicle_id;
				var post = this.post;
				
				apiMV.delete('/crew_vehicles/' + post.id).then(function (response) {
					router.push('/Edit/' + idCrewVehicles);
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findCrewVehicle: function(){
				var self = this;
				var idCrewVehicles = self.$route.params.crew_vehicle_id;
				
				apiMV.get('/crew_vehicles/' + idCrewVehicles).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Galery_Vehicles_Delete = Vue.extend({
		template: '#GaleryVehicles-delete',
		data: function () {
			return {
				vehicle_id: this.$route.params.vehicle_id,
				post: {
					id: 0,
				},
				vehicle_id: this.$route.params.vehicle_id,
				galery_vehicles_id: this.$route.params.galery_vehicles_id,
			};
		},
		methods: {
			deletegalery_vehicles: function () {
			  var self = this;
			  var galery_vehiclesId = self.galery_vehicles_id;          
			  
			  apiMV.delete('/galery_vehicles/' + galery_vehiclesId).then(function (response) {
				router.push('/Edit/' + self.vehicle_id);
			  }).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			  });
			}
		},
		mounted: function(){
			var self = this;		
			apiMV.get('/vehicles?join=galery_vehicles,employee_charges&join=crew_vehicles,employee_charges,persons', {
				params: {
					filter: [
						'id,eq,' + self.$route.params.vehicle_id
					],
				}
			}).then(function (response) {
			  self.post = response.data.records[0];
			}).catch(function (error) {
			  $.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	});
	// ------------ VEHICULOS FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: Vehicles_List, name: 'Vehicles-List'},
		{ path: '/View/:vehicle_id', component: Vehicles_View, name: 'Vehicles-View'},
		{ path: '/Add', component: Vehicles_Add, name: 'Vehicles-Add'},
		{ path: '/Edit/:vehicle_id', component: Vehicles_Edit, name: 'Vehicles-Edit'},
		{ path: '/Delete/:vehicle_id', component: Vehicles_Delete, name: 'Vehicles-Delete'},
		{ path: '/Edit/:vehicle_id/crew/:crew_vehicle_id', component: Crew_Vehicle_Delete, name: 'includeCrewVehicle-Delete'},
		{ path: '/Edit/:vehicle_id/picture/:galery_vehicles_id', component: Galery_Vehicles_Delete, name: 'GaleryVehicles-delete'},
		
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
