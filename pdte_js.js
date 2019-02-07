
var SettingsApp_Edit = Vue.extend({
	template: '#page-SettingsApp-Edit',
	data: function () {
		return {
			post: {
				name: '',
				result: '',
			}
		};
	},
	mounted: function () {
		var self = this;
		
		self.find()
	},
	methods: {
		updateCartaPropuestas: function(){
			var post = this.post;
			apiMV.put('/config_options/' + post.name, post).then(function (response) {
				console.log(response.data);
				$.notify("Guardado...", "success");
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		find: function(){
			var self = this;
			apiMV.get('/config_options/' + self.$route.params.setting_name).then(function (response) {
				if(!response.data.name)
				{
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

// ------------ EMPLEADOS - INICIO ------------------------------------- 
var Employees_List = Vue.extend({
  template: '#page-Employees',
  data: function () {
    return {
		posts: [],
		searchKey: ''
	};
  },
  mounted: function () {
    var self = this;
    apiMV.get('/employees').then(function (response) {
		self.posts = response.data.records;
    }).catch(function (error) {
		$.notify(error.response.data.code + error.response.data.message, "error");
    });
  },
  computed: {
    filteredposts: function () {
      return this.posts.filter(function (post) {
        return this.searchKey=='' || post.first_name.indexOf(this.searchKey) !== -1;
      },this);
    }
  }
});

var Employees_View = Vue.extend({
	template: '#view-Employees',
	data: function () {
		return {
			post: {
				id: 0,
				first_name: '',
				second_name: '',
				surname: '',
				second_surname: '',
				identification_type: {
					id: 0,
					name: '',
				},
				identification_number: '',
				identification_date_expedition: '',
				birthdate: '',
				blood_type: {
					id: 0,
					name: '',
				},
				blood_rh: {
					id: 0,
					name: '',
				},
				mail: '',
				number_phone: '',
				number_mobile: '',
				company_date_entry: '',
				company_date_out: '',
				company_mail: '',
				company_number_phone: '',
				company_number_mobile: '',
				avatar: 0,
				status: {
					id: 0,
					name: '',
				},
				eps: {
					id: 0,
					name: '',
				},
				arl: {
					id: 0,
					name: '',
				},
				pension_fund: {
					id: 0,
					name: '',
				},
				compensation_fund: {
					id: 0,
					name: '',
				},
				severance_fund: {
					id: 0,
					name: '',
				},
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
				observations: '',
			},
			post_contacts: [],
			contracted_staff: [],
			performances_employees: [],
		};
	},
	mounted: function () {
		var self = this;
		self.findEmployee();
	},
	methods: {
		findEmployee: function(){
			var self = this;
			var idEmployee = self.$route.params.employee_id;
			
			apiMV.get('/employees/' + idEmployee, {
				params: {
					join: [
						'types_identifications',
						'types_bloods',
						'types_bloods_rhs',
						'status_employees',
						'eps',
						'arl',
						'funds_pensions',
						'funds_compensations',
						'funds_severances',
						'geo_departments',
						'geo_citys',
					],
				}
			}).then(function (response) {
				if(!response.data.id || !response.data.first_name)
				{
					router.push('/Employees');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Employees');
			});
			
			apiMV.get('/crew_employees', {
				params: {
					filter: 'employee,eq,' + idEmployee,
					join: [
						'contacts',
						'types_contacts',
					],
				}
			}).then(function (response) {
				self.post_contacts = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/contracted_staff', {
				params: {
					filter: 'employee,eq,' + idEmployee,
					join: [
						'contracts_employees',
						'types_charges',
						'contracts_employees,terms_contrats_employees',
					],
				}
			}).then(function (response) {
				self.contracted_staff = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/performances_employees', {
				params: {
					filter: 'employee,eq,' + idEmployee,
					join: [
						'reasons_performances_employees',
						'actions_performances_employees',
					],
				}
			}).then(function (response) {
				self.performances_employees = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Employees_Add = Vue.extend({
	template: '#add-Employees',
	data: function () {
		return {
			selectOptions: {
				types_identifications: [],
				types_bloods: [],
				types_bloods_rhs: [],
				status_employees: [],
				eps: [],
				arl: [],
				funds_pensions: [],
				funds_compensations: [],
				funds_severances: [],
				geo_departments: [],
				geo_citys: [],
			},
			post: {
				id: 0,
				first_name: '',
				second_name: '',
				surname: '',
				second_surname: '',
				identification_type: 0,
				identification_number: '',
				identification_date_expedition: '',
				birthdate: '',
				blood_type: 0,
				blood_rh: 0,
				mail: '',
				number_phone: '',
				number_mobile: '',
				company_date_entry: '',
				company_date_out: '',
				company_mail: '',
				company_number_phone: '',
				company_number_mobile: '',
				avatar: 0,
				status: 0,
				eps: 0,
				arl: 0,
				pension_fund: 0,
				compensation_fund: 0,
				severance_fund: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				observations: '',
			},
		}
	},
	methods: {
		createEmployee: function() {
			var post = this.post;
			apiMV.post('/employees', post).then(function (response) {
				post.id = response.data;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Employees');
		},
		loadSelects: function(){
			var self = this;
			
			apiMV.get('/types_identifications', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_identifications = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_bloods', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_bloods = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/types_bloods_rhs', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_bloods_rhs = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/status_employees', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.status_employees = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/eps', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.eps = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/arl', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.arl = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/funds_pensions', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.funds_pensions = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/funds_compensations', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.funds_compensations = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/funds_severances', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.funds_severances = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			
			apiMV.get('/geo_departments', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.geo_departments = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
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
	},
	mounted: function(){
		var self = this;
		self.loadSelects();
	},
});

var Employees_Edit = Vue.extend({
	template: '#edit-Employees',
	data: function () {
		return {
			selectOptions: {
				types_identifications: [],
				types_bloods: [],
				types_bloods_rhs: [],
				status_employees: [],
				eps: [],
				arl: [],
				funds_pensions: [],
				funds_compensations: [],
				funds_severances: [],
				geo_departments: [],
				geo_citys: [],
				contacts: [],
				types_contacts: [],
				contracted_staff: [],
				types_contracts: [],
				contracts_employees: [],
				reasons_performances_employees: [],
				actions_performances_employees: [],
			},
			post: {
				id: 0,
				name: ''
			},
			post_contacts: [],
			post_crew: {
				employee: this.$route.params.employee_id,
				contact: 0,
			},
			contracted_staff: [],
			post_contracted_staff: {
				employee: this.$route.params.employee_id,
				contract_employee: 0,
				type_charge: 0,
				date_start: '',
				date_end: '',
			},
			performances_employees: [],
			post_performances_employees: {
				employee: this.$route.params.employee_id,
				reason: 0,
				date_start: '',
				date_end: '',
				action_taken: 0,
				notes: '',
			},
		};
	},
	mounted: function () {
		var self = this;
		self.loadSelects();
		self.findEmployee();
	},
	methods: {
		includeContractEmployee: function () {
			var self = this;
			if(self.post_contracted_staff.date_end == '' || self.post_contracted_staff.date_end == 0){
				delete self.post_contracted_staff.date_end;
			}
			
			apiMV.post('/contracted_staff', self.post_contracted_staff).then(function (response) {
				// post.id = response.data;
				$("#includeContractEmployee-Fast").hide();
				self.findEmployee();
				self.contract_employee.type_charge = 0;
				self.contract_employee.date_start = '';
				self.contract_employee.date_end = '';
				self.contract_employee.contract_employee = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
		},
		includeCrewEmployee: function () {
			var self = this;
			
			apiMV.post('/crew_employees', self.post_crew).then(function (response) {
				// post.id = response.data;
				$("#includeCrewEmployee-Fast").hide();
				self.post_crew.contact = 0;
				self.findEmployee();
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
		},
		updateEmployee: function () {
			var post = this.post;
			apiMV.put('/employees/' + post.id, post).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Employees');
		},
		findEmployee: function(){
			var self = this;
			var idEmployee = self.$route.params.employee_id;
			
			apiMV.get('/employees/' + idEmployee).then(function (response) {
				if(!response.data.id || !response.data.first_name)
				{
					router.push('/Employees');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Employees');
			});
			
			apiMV.get('/crew_employees', {
				params: {
					filter: 'employee,eq,' + idEmployee,
					join: [
						'contacts',
						'types_contacts',
					],
				}
			}).then(function (response) {
				self.post_contacts = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/contracted_staff', {
				params: {
					filter: 'employee,eq,' + idEmployee,
					join: [
						'contracts_employees',
						'types_charges',
						'contracts_employees,terms_contrats_employees',
					],
				}
			}).then(function (response) {
				self.contracted_staff = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/performances_employees', {
				params: {
					filter: 'employee,eq,' + idEmployee,
					join: [
						'reasons_performances_employees',
						'actions_performances_employees',
					],
				}
			}).then(function (response) {
				self.performances_employees = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			$('#includeCrewEmployee-Fast').hide();
			$('#includeContractEmployee-Fast').hide();
			$('#includePerformancesEmployee-Fast').hide();
		},
		loadSelects: function(){
			var self = this;
			
			apiMV.get('/types_identifications', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_identifications = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_bloods', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_bloods = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/types_bloods_rhs', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_bloods_rhs = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/status_employees', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.status_employees = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/eps', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.eps = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/arl', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.arl = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/funds_pensions', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.funds_pensions = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/funds_compensations', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.funds_compensations = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/funds_severances', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.funds_severances = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
						
			apiMV.get('/geo_departments', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.geo_departments = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/geo_citys', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.geo_citys = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/contacts', { params: { order: 'identification_number,asc', } })
				.then(function (response) { self.selectOptions.contacts = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/types_contacts', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_contacts = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/contracted_staff', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.contracted_staff = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/types_charges', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_charges = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/contracts_employees', { params: { order: 'name,asc', join: 'terms_contrats_employees' } })
				.then(function (response) { self.selectOptions.contracts_employees = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/reasons_performances_employees', { params: { order: 'name,asc', join: 'terms_contrats_employees' } })
				.then(function (response) { self.selectOptions.reasons_performances_employees = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/actions_performances_employees', { params: { order: 'name,asc', join: 'terms_contrats_employees' } })
				.then(function (response) { self.selectOptions.actions_performances_employees = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
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
		includePerformancesEmployee: function () {
			var self = this;
			if(self.post_performances_employees.date_end == '' || self.post_performances_employees.date_end == 0){
				delete self.post_performances_employees.date_end;
			}
			
			apiMV.post('/performances_employees', self.post_performances_employees).then(function (response) {
				// post.id = response.data;
				$("#includePerformancesEmployee-Fast").hide();
				self.findEmployee();
				self.post_performances_employees.reason = 0;
				self.post_performances_employees.action_taken = 0;
				self.post_performances_employees.date_start = '';
				self.post_performances_employees.date_end = '';
				self.post_performances_employees.notes = '';
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
		},
	}
});

var Employees_Delete = Vue.extend({
	template: '#delete-Employees',
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
		self.findEmployee();
	},
	methods: {
		deleteEmployee: function () {
			var post = this.post;
			
			apiMV.delete('/employees/' + post.id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Employees');
			location.reload();
		},
		findEmployee: function(){
			var self = this;
			var idEmployee = self.$route.params.employee_id;
			
			apiMV.get('/employees/' + idEmployee).then(function (response) {
				if(!response.data.id || !response.data.first_name)
				{
					router.push('/Employees');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Employees');
			});
		}
	}
});

var Employees_Contacts_Delete = Vue.extend({
	template: '#delete-EmployeesContacts',
	data: function () {
		return {
			post: {
				id: 0,
				employee: '',
				contact: '',
			}
		};
	},
	mounted: function () {
		var self = this;
		self.findEmployeeContact();
	},
	methods: {
		deleteEmployeeContact: function () {
			var self = this;
			var post = this.post;
			
			apiMV.delete('/crew_employees/' + self.$route.params.employee_contact_id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Employees/' + self.$route.params.employee_id + '/Edit');
		},
		findEmployeeContact: function(){
			var self = this;
			var idEmployeeContact = self.$route.params.employee_contact_id;
			
			apiMV.get('/crew_employees/' + idEmployeeContact).then(function (response) {
				if(!response.data.id || !response.data.first_name)
				{
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var ContractedStaff_Delete = Vue.extend({
	template: '#delete-ContractedStaff',
	data: function () {
		return {
			post: {
				id: 0,
				employee: 0,
				contract_employee: 0,
				type_charge: 0,
				date_start: '',
				date_end: '',
			}
		};
	},
	mounted: function () {
		var self = this;
		self.findContractedStaff();
	},
	methods: {
		deleteContractedStaff: function () {
			var self = this;
			var post = this.post;
			
			apiMV.delete('/contracted_staff/' + self.$route.params.contracted_staff_id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Employees/' + self.$route.params.employee_id + '/Edit');
		},
		findContractedStaff: function(){
			var self = this;
			var idContractedStaff = self.$route.params.contracted_staff_id;
			
			apiMV.get('/contracted_staff/' + idContractedStaff).then(function (response) {
				if(!response.data.id || !response.data.first_name)
				{
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});
// ------------ EMPLEADOS - FIN ------------------------------------- 

// ------------ CLIENTES - INICIO ------------------------------------- 
var Clients_List = Vue.extend({
  template: '#page-Clients',
  data: function () {
    return {
		posts: [],
		searchKey: ''
	};
  },
  mounted: function () {
    var self = this;
    apiMV.get('/clients', {
		params: {
			join: [
				'types_clients',
				'types_identifications',
			]
		}
	}).then(function (response) {
		self.posts = response.data.records;
    }).catch(function (error) {
		$.notify(error.response.data.code + error.response.data.message, "error");
    });
  },
  computed: {
    filteredposts: function () {
      return this.posts.filter(function (post) {
        return this.searchKey=='' || post.social_reason.indexOf(this.searchKey) !== -1;
      },this);
    }
  }
});

var Clients_View = Vue.extend({
	template: '#view-Clients',
	data: function () {
		return {
			post: {
				type: {
					id: 0,
					name: '',
				},
				identification_type: {
					id: 0,
					name: '',
				},
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: {
					id: 0,
					name: '',
				},
				department: {
					id: 0,
					name: '',
				},
				city: {
					id: 0,
					department: 0,
					name: '',
				},
				address: '',
				geo_address: '',
				legal_representative: {
					id: 0,
					first_name: '',
					second_name: '',
					surname: '',
					second_surname: '',
					phone: '',
					phone_mobile: '',
					mail: '',
				},
				contact_principal: {
					id: 0,
					first_name: '',
					second_name: '',
					surname: '',
					second_surname: '',
					phone: '',
					phone_mobile: '',
					mail: '',
				},
				enable_audit: 0,
			},
			crew_clients: [],
			redicated_clients: [],
			auditors_clients: [],
			services_clients: [],
		};
	},
	mounted: function () {
		var self = this;
		self.findClients();
	},
	methods: {
		findClients: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient, {
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
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Clients');
			});
			
			apiMV.get('/crew_clients', {
				params: {
					filter: 'client,eq,' + idClient,
					join: [
						'contacts',
						'types_contacts',
					],
				}
			}).then(function (response) {
				self.crew_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/redicated_clients', {
				params: {
					filter: 'client,eq,' + idClient,
				}
			}).then(function (response) {
				self.redicated_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/auditors_clients', {
				params: {
					filter: 'client,eq,' + idClient,
					join: [
						'contacts',
					],
				}
			}).then(function (response) {
				self.auditors_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/services_clients', {
				params: {
					filter: 'client,eq,' + idClient,
					join: [
						'services',
						'attributes_services_clients',
						'attributes_services_clients,attributes',
					],
				}
			}).then(function (response) {
				self.services_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Clients_Add = Vue.extend({
	template: '#add-Clients',
	data: function () {
		return {
			selectOptions: {
				types_clients: this.$parent.selectOptions.types_clients,
				types_identifications: this.$parent.selectOptions.types_identifications,
				types_societys: this.$parent.selectOptions.types_societys,
				geo_departments: this.$parent.selectOptions.geo_departments,
				geo_citys: [],
				contacts: this.$parent.selectOptions.contacts,
			},
			post: {
				type: 0,
				identification_type: 0,
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				legal_representative: 0,
				contact_principal: 0,
				contact_alternative: 0,
				enable_audit: 0,
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
		createClient: function() {
			var post = this.post;
			apiMV.post('/clients', post).then(function (response) {
				post.id = response.data;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Clients');
		}
	}
});

var Clients_Info_Edit = Vue.extend({
	template: '#edit-Clients-Info',
	data: function () {
		return {
			selectOptions: {
				types_clients: this.$parent.selectOptions.types_clients,
				types_identifications: this.$parent.selectOptions.types_identifications,
				types_societys: this.$parent.selectOptions.types_societys,
				geo_departments: this.$parent.selectOptions.geo_departments,
				geo_citys: this.$parent.selectOptions.geo_citys,
				contacts: this.$parent.selectOptions.contacts,
				types_contacts: this.$parent.selectOptions.types_contacts,
				types_repeats_services_clients: this.$parent.selectOptions.types_repeats_services_clients,
			},
			post: {
				id: 0,
				type: 0,
				identification_type: 0,
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				legal_representative: 0,
				contact_principal: 0,
				contact_alternative: 0,
				enable_audit: 0,
			},
			crew_clients: [],
			redicated_clients: [],
			auditors_clients: [],
			accounts_clients: [],
			post_crew_clients: {
				client: this.$route.params.client_id,
				contact: 0,
				type_contact: 0,
			},
			post_redicated_clients: {
				client: this.$route.params.client_id,
				consecutive: '',
				name: '',
				object: '',
				description_service: '',
				date_start: '',
				date_end: '',
				additional_notes: '',
			},
			post_auditors_clients: {
				contact: 0,
				client: this.$route.params.client_id,
			},
			calc: {
				subService: 0,
				subTotalAttributes: 0,
			}
		};
	},
	mounted: function () {
		var self = this;
		//self.loadSelects();
		self.findClients();
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
		loadSelects: function(){
			var self = this;
			
			
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
				$.notify("Ciudades cargados.", "success");
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		updateClient: function () {
			var post = this.post;
			apiMV.put('/clients/' + post.id, post).then(function (response) {
				console.log(response.data);
				router.push('/Clients/' + self.$route.params.client_id + '/Info/Edit');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findClients: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient).then(function (response) {
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Clients');
			});
			
			
			$("#includeContactClient-Fast").hide();
			$("#includeRedicatedClient-Fast").hide();
			$("#includeAuditorClient-Fast").hide();
		},
		includeContactClient: function(){
			var self = this;
			
			apiMV.post('/crew_clients', self.post_crew_clients).then(function (response) {
				// post.id = response.data;
				$("#includeContactClient-Fast").hide();
				self.findClients();
				self.post_crew_clients.contact = 0;
				self.post_crew_clients.type_contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeRedicatedClient: function(){
			var self = this;
			
			apiMV.post('/redicated_clients', self.post_redicated_clients).then(function (response) {
				// post.id = response.data;
				$("#includeRedicatedClient-Fast").hide();
				self.findClients();
				self.post_redicated_clients.consecutive = '';
				self.post_redicated_clients.name = '';
				self.post_redicated_clients.object = '';
				self.post_redicated_clients.description_service = '';
				self.post_redicated_clients.date_start = '';
				self.post_redicated_clients.date_end = '';
				self.post_redicated_clients.additional_notes = '';
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeAuditorClient: function(){
			var self = this;
			
			apiMV.post('/auditors_clients', self.post_auditors_clients).then(function (response) {
				// post.id = response.data;
				$("#includeAuditorClient-Fast").hide();
				self.findClients();
				self.post_auditors_clients.contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	}
});

var Clients_Contacts_Edit = Vue.extend({
	template: '#edit-Clients-Contacts',
	data: function () {
		return {
			selectOptions: {
				types_clients: this.$parent.selectOptions.types_clients,
				types_identifications: this.$parent.selectOptions.types_identifications,
				types_societys: this.$parent.selectOptions.types_societys,
				geo_departments: this.$parent.selectOptions.geo_departments,
				geo_citys: this.$parent.selectOptions.geo_citys,
				contacts: this.$parent.selectOptions.contacts,
				types_contacts: this.$parent.selectOptions.types_contacts,
				types_repeats_services_clients: this.$parent.selectOptions.types_repeats_services_clients,
			},
			post: {
				id: 0,
				type: 0,
				identification_type: 0,
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				legal_representative: 0,
				contact_principal: 0,
				contact_alternative: 0,
				enable_audit: 0,
			},
			crew_clients: [],
			redicated_clients: [],
			auditors_clients: [],
			accounts_clients: [],
			post_crew_clients: {
				client: this.$route.params.client_id,
				contact: 0,
				type_contact: 0,
			},
			post_redicated_clients: {
				client: this.$route.params.client_id,
				consecutive: '',
				name: '',
				object: '',
				description_service: '',
				date_start: '',
				date_end: '',
				additional_notes: '',
			},
			post_auditors_clients: {
				contact: 0,
				client: this.$route.params.client_id,
			},
			calc: {
				subService: 0,
				subTotalAttributes: 0,
			}
		};
	},
	mounted: function () {
		var self = this;
		self.loadSelects();
		self.findClients();
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
		loadSelects: function(){
			var self = this;
			
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
		updateClient: function () {
			var post = this.post;
			apiMV.put('/clients/' + post.id, post).then(function (response) {
				console.log(response.data);
				router.push('/Clients/' + self.$route.params.client_id + '/Contacts/Edit');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findClients: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient).then(function (response) {
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Clients');
			});
			
			apiMV.get('/crew_clients', {
				params: {
					filter: 'client,eq,' + idClient,
					join: [
						'contacts',
						'types_contacts',
					],
				}
			}).then(function (response) {
				self.crew_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			
			$("#includeContactClient-Fast").hide();
			$("#includeRedicatedClient-Fast").hide();
			$("#includeAuditorClient-Fast").hide();
		},
		includeContactClient: function(){
			var self = this;
			
			apiMV.post('/crew_clients', self.post_crew_clients).then(function (response) {
				// post.id = response.data;
				$("#includeContactClient-Fast").hide();
				self.findClients();
				self.post_crew_clients.contact = 0;
				self.post_crew_clients.type_contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeRedicatedClient: function(){
			var self = this;
			
			apiMV.post('/redicated_clients', self.post_redicated_clients).then(function (response) {
				// post.id = response.data;
				$("#includeRedicatedClient-Fast").hide();
				self.findClients();
				self.post_redicated_clients.consecutive = '';
				self.post_redicated_clients.name = '';
				self.post_redicated_clients.object = '';
				self.post_redicated_clients.description_service = '';
				self.post_redicated_clients.date_start = '';
				self.post_redicated_clients.date_end = '';
				self.post_redicated_clients.additional_notes = '';
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeAuditorClient: function(){
			var self = this;
			
			apiMV.post('/auditors_clients', self.post_auditors_clients).then(function (response) {
				// post.id = response.data;
				$("#includeAuditorClient-Fast").hide();
				self.findClients();
				self.post_auditors_clients.contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	}
});

var Clients_Contracts_Edit = Vue.extend({
	template: '#edit-Clients-Contracts',
	data: function () {
		return {
			selectOptions: {
				types_clients: this.$parent.selectOptions.types_clients,
				types_identifications: this.$parent.selectOptions.types_identifications,
				types_societys: this.$parent.selectOptions.types_societys,
				geo_departments: this.$parent.selectOptions.geo_departments,
				geo_citys: this.$parent.selectOptions.geo_citys,
				contacts: this.$parent.selectOptions.contacts,
				types_contacts: this.$parent.selectOptions.types_contacts,
				types_repeats_services_clients: this.$parent.selectOptions.types_repeats_services_clients,
			},
			post: {
				id: 0,
				type: 0,
				identification_type: 0,
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				legal_representative: 0,
				contact_principal: 0,
				contact_alternative: 0,
				enable_audit: 0,
			},
			crew_clients: [],
			redicated_clients: [],
			auditors_clients: [],
			accounts_clients: [],
			post_crew_clients: {
				client: this.$route.params.client_id,
				contact: 0,
				type_contact: 0,
			},
			post_redicated_clients: {
				client: this.$route.params.client_id,
				consecutive: '',
				name: '',
				object: '',
				description_service: '',
				date_start: '',
				date_end: '',
				additional_notes: '',
			},
			post_auditors_clients: {
				contact: 0,
				client: this.$route.params.client_id,
			},
			calc: {
				subService: 0,
				subTotalAttributes: 0,
			}
		};
	},
	mounted: function () {
		var self = this;
		self.loadSelects();
		self.findClients();
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
		loadSelects: function(){
			var self = this;
			
			apiMV.get('/types_clients', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_clients = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_identifications', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_identifications = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_societys', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_societys = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/geo_departments', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.geo_departments = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/geo_citys', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.geo_citys = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/contacts', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.contacts = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_contacts', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_contacts = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
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
		updateClient: function () {
			var post = this.post;
			apiMV.put('/clients/' + post.id, post).then(function (response) {
				console.log(response.data);
				router.push('/Clients/' + self.$route.params.client_id + '/Contracts/Edit');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findClients: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient).then(function (response) {
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Clients');
			});
						
			apiMV.get('/redicated_clients', {
				params: {
					filter: 'client,eq,' + idClient,
				}
			}).then(function (response) {
				self.redicated_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			$("#includeContactClient-Fast").hide();
			$("#includeRedicatedClient-Fast").hide();
			$("#includeAuditorClient-Fast").hide();
		},
		includeContactClient: function(){
			var self = this;
			
			apiMV.post('/crew_clients', self.post_crew_clients).then(function (response) {
				// post.id = response.data;
				$("#includeContactClient-Fast").hide();
				self.findClients();
				self.post_crew_clients.contact = 0;
				self.post_crew_clients.type_contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeRedicatedClient: function(){
			var self = this;
			
			apiMV.post('/redicated_clients', self.post_redicated_clients).then(function (response) {
				// post.id = response.data;
				$("#includeRedicatedClient-Fast").hide();
				self.findClients();
				self.post_redicated_clients.consecutive = '';
				self.post_redicated_clients.name = '';
				self.post_redicated_clients.object = '';
				self.post_redicated_clients.description_service = '';
				self.post_redicated_clients.date_start = '';
				self.post_redicated_clients.date_end = '';
				self.post_redicated_clients.additional_notes = '';
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeAuditorClient: function(){
			var self = this;
			
			apiMV.post('/auditors_clients', self.post_auditors_clients).then(function (response) {
				// post.id = response.data;
				$("#includeAuditorClient-Fast").hide();
				self.findClients();
				self.post_auditors_clients.contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	}
});

var Clients_Auditors_Edit = Vue.extend({
	template: '#edit-Clients-Auditors',
	data: function () {
		return {
			selectOptions: {
				types_clients: [],
				types_identifications: [],
				types_societys: [],
				geo_departments: [],
				geo_citys: [],
				contacts: [],
				types_contacts: [],
				types_repeats_services_clients: [],
			},
			post: {
				id: 0,
				type: 0,
				identification_type: 0,
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				legal_representative: 0,
				contact_principal: 0,
				contact_alternative: 0,
				enable_audit: 0,
			},
			crew_clients: [],
			redicated_clients: [],
			auditors_clients: [],
			accounts_clients: [],
			post_crew_clients: {
				client: this.$route.params.client_id,
				contact: 0,
				type_contact: 0,
			},
			post_redicated_clients: {
				client: this.$route.params.client_id,
				consecutive: '',
				name: '',
				object: '',
				description_service: '',
				date_start: '',
				date_end: '',
				additional_notes: '',
			},
			post_auditors_clients: {
				contact: 0,
				client: this.$route.params.client_id,
			},
			calc: {
				subService: 0,
				subTotalAttributes: 0,
			}
		};
	},
	mounted: function () {
		var self = this;
		self.loadSelects();
		self.findClients();
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
		loadSelects: function(){
			var self = this;
			
			apiMV.get('/types_clients', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_clients = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_identifications', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_identifications = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_societys', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_societys = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/geo_departments', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.geo_departments = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/geo_citys', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.geo_citys = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/contacts', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.contacts = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_contacts', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_contacts = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
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
		updateClient: function () {
			var post = this.post;
			apiMV.put('/clients/' + post.id, post).then(function (response) {
				console.log(response.data);
				router.push('/Clients/' + self.$route.params.client_id + '/Auditors/Edit');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findClients: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient).then(function (response) {
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Clients');
			});
			
			apiMV.get('/auditors_clients', {
				params: {
					filter: 'client,eq,' + idClient,
					join: [
						'contacts',
					],
				}
			}).then(function (response) {
				self.auditors_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});

			
			$("#includeContactClient-Fast").hide();
			$("#includeRedicatedClient-Fast").hide();
			$("#includeAuditorClient-Fast").hide();
		},
		includeContactClient: function(){
			var self = this;
			
			apiMV.post('/crew_clients', self.post_crew_clients).then(function (response) {
				// post.id = response.data;
				$("#includeContactClient-Fast").hide();
				self.findClients();
				self.post_crew_clients.contact = 0;
				self.post_crew_clients.type_contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeRedicatedClient: function(){
			var self = this;
			
			apiMV.post('/redicated_clients', self.post_redicated_clients).then(function (response) {
				// post.id = response.data;
				$("#includeRedicatedClient-Fast").hide();
				self.findClients();
				self.post_redicated_clients.consecutive = '';
				self.post_redicated_clients.name = '';
				self.post_redicated_clients.object = '';
				self.post_redicated_clients.description_service = '';
				self.post_redicated_clients.date_start = '';
				self.post_redicated_clients.date_end = '';
				self.post_redicated_clients.additional_notes = '';
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeAuditorClient: function(){
			var self = this;
			
			apiMV.post('/auditors_clients', self.post_auditors_clients).then(function (response) {
				// post.id = response.data;
				$("#includeAuditorClient-Fast").hide();
				self.findClients();
				self.post_auditors_clients.contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	}
});

var Clients_Accounts_Edit = Vue.extend({
	template: '#edit-Clients-Accounts',
	data: function () {
		return {
			selectOptions: {
				crew_clients: [],
			},
			post: {
				id: 0,
				type: 0,
				identification_type: 0,
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				legal_representative: 0,
				contact_principal: 0,
				contact_alternative: 0,
				enable_audit: 0,
			},
			crew_clients: [],
			redicated_clients: [],
			auditors_clients: [],
			accounts_clients: [],
			post_crew_clients: {
				client: this.$route.params.client_id,
				contact: 0,
				type_contact: 0,
			},
			post_redicated_clients: {
				client: this.$route.params.client_id,
				consecutive: '',
				name: '',
				object: '',
				description_service: '',
				date_start: '',
				date_end: '',
				additional_notes: '',
			},
			post_auditors_clients: {
				contact: 0,
				client: this.$route.params.client_id,
			},
			calc: {
				subService: 0,
				subTotalAttributes: 0,
			},
			post_account: {
				client: Number(this.$route.params.client_id),
				name: '',
				contact: 0,
				address: '',
				address_invoices: '',
			},
		};
	},
	mounted: function () {
		var self = this;
		self.loadSelects();
		self.findClients();
	},
	methods: {
		generateQuotation: function(data, validity=0){
			var self = this;
			var fullAccount = data;
			var quotationClient = {
				client: fullAccount.client,
				account: fullAccount.id,
				values: JSON.stringify({
					services: fullAccount.services_clients,
					attributes: fullAccount.attributes_services_clients,
				}),
				validity: validity,
			};
			
			console.log(quotationClient);
			
			apiMV.post('/quotations_clients', quotationClient).then(function (response) {
				$.notify('Cotizacion Creada con éxito.', 'info');
				self.findClients();
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			/**/
		},
		createNewAccount: function(){			
			var self = this;
			
			console.log(self.post_account);
			
			apiMV.post('/accounts_clients', self.post_account).then(function (response) {
				post.id = response.data;	
				router.push('/Clients/' + self.$route.params.client_id + '/Accounts/Edit');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
		},
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
		loadSelects: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/crew_clients', {
				params: {
					filter: 'client,eq,' + idClient,
					join: [
						'contacts',
						'types_contacts',
					],
				}
			}).then(function (response) {
				self.selectOptions.crew_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			
			$("#includeAccountClient-Fast").hide();
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
		updateClient: function () {
			var post = this.post;
			apiMV.put('/clients/' + post.id, post).then(function (response) {
				console.log(response.data);
				router.push('/Clients/' + self.$route.params.client_id + '/Accounts/Edit');
			}).catch(function (error) {
				console.log(error.response);
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findClients: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient).then(function (response) {
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Clients');
			});
			
			apiMV.get('/crew_clients', {
				params: {
					filter: 'client,eq,' + idClient,
					join: [
						'contacts',
						'types_contacts',
					],
				}
			}).then(function (response) {
				self.crew_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/redicated_clients', {
				params: {
					filter: 'client,eq,' + idClient,
				}
			}).then(function (response) {
				self.redicated_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/auditors_clients', {
				params: {
					filter: 'client,eq,' + idClient,
					join: [
						'contacts',
					],
				}
			}).then(function (response) {
				self.auditors_clients = response.data.records;
				
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			apiMV.get('/accounts_clients', {
				params: {
					filter: 'client,eq,' + idClient,
					join: [
						'services_clients',
						'services_clients,types_meditions',
						'services_clients,services',
						'services_clients,services,types_meditions',
						'attributes_services_clients',
						'attributes_services_clients,attributes',
						'services_clients,types_repeats_services_clients',
						'quotations_clients',
					],
				}
			}).then(function (response) {
				self.accounts_clients = response.data.records;
				//self.sumarTodo();
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			$("#includeContactClient-Fast").hide();
			$("#includeRedicatedClient-Fast").hide();
			$("#includeAuditorClient-Fast").hide();
		},
		includeContactClient: function(){
			var self = this;
			
			apiMV.post('/crew_clients', self.post_crew_clients).then(function (response) {
				// post.id = response.data;
				$("#includeContactClient-Fast").hide();
				self.findClients();
				self.post_crew_clients.contact = 0;
				self.post_crew_clients.type_contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeRedicatedClient: function(){
			var self = this;
			
			apiMV.post('/redicated_clients', self.post_redicated_clients).then(function (response) {
				// post.id = response.data;
				$("#includeRedicatedClient-Fast").hide();
				self.findClients();
				self.post_redicated_clients.consecutive = '';
				self.post_redicated_clients.name = '';
				self.post_redicated_clients.object = '';
				self.post_redicated_clients.description_service = '';
				self.post_redicated_clients.date_start = '';
				self.post_redicated_clients.date_end = '';
				self.post_redicated_clients.additional_notes = '';
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeAuditorClient: function(){
			var self = this;
			
			apiMV.post('/auditors_clients', self.post_auditors_clients).then(function (response) {
				// post.id = response.data;
				$("#includeAuditorClient-Fast").hide();
				self.findClients();
				self.post_auditors_clients.contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		updateAccountClient: function(data){
			var self = this;
			var tempAccount = {
				id: data.id,
				client: data.client,
				name: data.name,
				contact: data.contact,
				address: data.address,
				address_invoices: data.address_invoices,
				observations: data.observations,
			};
			
			apiMV.put('/accounts_clients/' + tempAccount.id, tempAccount).then(function (response) {
				$.notify("Guardado con éxito.", "success");
				self.findClients();
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	}
});

var Clients_Invoices_Edit = Vue.extend({
	template: '#edit-Clients-Invoices',
	data: function () {
		return {
			selectOptions: {
				types_clients: [],
				types_identifications: [],
				types_societys: [],
				geo_departments: [],
				geo_citys: [],
				contacts: [],
				types_contacts: [],
				types_repeats_services_clients: [],
			},
			post: {
				id: 0,
				type: 0,
				identification_type: 0,
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				legal_representative: 0,
				contact_principal: 0,
				contact_alternative: 0,
				enable_audit: 0,
			},
			crew_clients: [],
			redicated_clients: [],
			auditors_clients: [],
			accounts_clients: [],
			post_crew_clients: {
				client: this.$route.params.client_id,
				contact: 0,
				type_contact: 0,
			},
			post_redicated_clients: {
				client: this.$route.params.client_id,
				consecutive: '',
				name: '',
				object: '',
				description_service: '',
				date_start: '',
				date_end: '',
				additional_notes: '',
			},
			post_auditors_clients: {
				contact: 0,
				client: this.$route.params.client_id,
			},
			calc: {
				subService: 0,
				subTotalAttributes: 0,
			}
		};
	},
	mounted: function () {
		var self = this;
		self.loadSelects();
		self.findClients();
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
		loadSelects: function(){
			var self = this;
			
			apiMV.get('/types_clients', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_clients = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_identifications', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_identifications = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_societys', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_societys = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/geo_departments', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.geo_departments = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/geo_citys', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.geo_citys = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/contacts', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.contacts = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
			apiMV.get('/types_contacts', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_contacts = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				
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
		updateClient: function () {
			var post = this.post;
			apiMV.put('/clients/' + post.id, post).then(function (response) {
				console.log(response.data);
				router.push('/Clients/' + self.$route.params.client_id + '/Invoices/Edit');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findClients: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient).then(function (response) {
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
			$("#includeContactClient-Fast").hide();
			$("#includeRedicatedClient-Fast").hide();
			$("#includeAuditorClient-Fast").hide();
		},
		includeContactClient: function(){
			var self = this;
			
			apiMV.post('/crew_clients', self.post_crew_clients).then(function (response) {
				// post.id = response.data;
				$("#includeContactClient-Fast").hide();
				self.findClients();
				self.post_crew_clients.contact = 0;
				self.post_crew_clients.type_contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeRedicatedClient: function(){
			var self = this;
			
			apiMV.post('/redicated_clients', self.post_redicated_clients).then(function (response) {
				// post.id = response.data;
				$("#includeRedicatedClient-Fast").hide();
				self.findClients();
				self.post_redicated_clients.consecutive = '';
				self.post_redicated_clients.name = '';
				self.post_redicated_clients.object = '';
				self.post_redicated_clients.description_service = '';
				self.post_redicated_clients.date_start = '';
				self.post_redicated_clients.date_end = '';
				self.post_redicated_clients.additional_notes = '';
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeAuditorClient: function(){
			var self = this;
			
			apiMV.post('/auditors_clients', self.post_auditors_clients).then(function (response) {
				// post.id = response.data;
				$("#includeAuditorClient-Fast").hide();
				self.findClients();
				self.post_auditors_clients.contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	}
});

var Clients_Quotations_Edit = Vue.extend({
	template: '#edit-Clients-Quotations',
	data: function () {
		return {
			selectOptions: {
				types_clients: [],
			},
			post: {
				id: 0,
				type: 0,
				identification_type: 0,
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				legal_representative: 0,
				contact_principal: 0,
				contact_alternative: 0,
				enable_audit: 0,
			},
			posts: [],
		};
	},
	mounted: function () {
		var self = this;
		
		self.loadSelects();
		self.find();
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
		loadSelects: function(){
			var self = this;
			/*
			apiMV.get('/types_clients', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_clients = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				*/
		},
		find: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient).then(function (response) {
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Clients');
			});
			
			apiMV.get('/quotations_clients', {
				params: {
					join: [
						'contracts_clients',
					],
					filter: [
						'status,eq,2',
						'client,eq,' + idClient,
					]
				}
			}).then(function (response) {
				self.posts = response.data.records;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
		},
		includeContactClient: function(){
			var self = this;
			
			apiMV.post('/crew_clients', self.post_crew_clients).then(function (response) {
				// post.id = response.data;
				$("#includeContactClient-Fast").hide();
				self.findClients();
				self.post_crew_clients.contact = 0;
				self.post_crew_clients.type_contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeRedicatedClient: function(){
			var self = this;
			
			apiMV.post('/redicated_clients', self.post_redicated_clients).then(function (response) {
				// post.id = response.data;
				$("#includeRedicatedClient-Fast").hide();
				self.findClients();
				self.post_redicated_clients.consecutive = '';
				self.post_redicated_clients.name = '';
				self.post_redicated_clients.object = '';
				self.post_redicated_clients.description_service = '';
				self.post_redicated_clients.date_start = '';
				self.post_redicated_clients.date_end = '';
				self.post_redicated_clients.additional_notes = '';
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		includeAuditorClient: function(){
			var self = this;
			
			apiMV.post('/auditors_clients', self.post_auditors_clients).then(function (response) {
				// post.id = response.data;
				$("#includeAuditorClient-Fast").hide();
				self.findClients();
				self.post_auditors_clients.contact = 0;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
	}
});

var Clients_ContractsServices_Edit = Vue.extend({
	template: '#edit-Clients-ContractsServices',
	data: function () {
		return {
			selectOptions: {
				types_clients: [],
			},
			post: {
				id: 0,
				type: 0,
				identification_type: 0,
				identification_number: '',
				social_reason: '',
				tradename: '',
				society_type: 0,
				department: 0,
				city: 0,
				address: '',
				geo_address: '',
				legal_representative: 0,
				contact_principal: 0,
				contact_alternative: 0,
				enable_audit: 0,
			},
			posts: [],
		};
	},
	mounted: function () {
		var self = this;
		
		self.loadSelects();
		self.find();
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
		loadSelects: function(){
			var self = this;
			/*
			apiMV.get('/types_clients', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.types_clients = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
				*/
		},
		find: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient).then(function (response) {
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Clients');
			});
			
			apiMV.get('/contracts_clients', {
				params: {
					join: [
						'quotations_clients',
					],
					filter: [
						'client,eq,' + idClient,
					]
				}
			}).then(function (response) {
				self.posts = response.data.records;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			
		},
	}
});

var Clients_Delete = Vue.extend({
	template: '#delete-Clients',
	data: function () {
		return {
			post: {
				id: 0,
				social_reason: ''
			}
		};
	},
	mounted: function () {
		var self = this;
		self.findClients();
	},
	methods: {
		deleteClient: function () {
			var post = this.post;
			
			apiMV.delete('/clients/' + post.id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Clients');
			location.reload();
		},
		findClients: function(){
			var self = this;
			var idClient = self.$route.params.client_id;
			
			apiMV.get('/clients/' + idClient).then(function (response) {
				if(!response.data.id || !response.data.social_reason)
				{
					router.push('/Clients');
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/Clients');
			});
		}
	}
});

var Clients_Contacts_Delete = Vue.extend({
	template: '#delete-ClientsContacts',
	data: function () {
		return {
			post: {
				id: 0,
				client: 0,
				contact: '',
			}
		};
	},
	mounted: function () {
		var self = this;
		self.findClientContact();
	},
	methods: {
		deleteClientsContacts: function () {
			var self = this;
			var post = this.post;
			
			apiMV.delete('/crew_clients/' + self.$route.params.client_contact_id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Clients/' + self.$route.params.client_id + '/Contacts/Edit');
		},
		findClientContact: function(){
			var self = this;
			var idClientContact = self.$route.params.client_contact_id;
			
			apiMV.get('/crew_clients/' + idClientContact).then(function (response) {
				if(!response.data.id || !response.data.contact)
				{
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Clients_Redicated_Delete = Vue.extend({
	template: '#delete-RedicatedClients',
	data: function () {
		return {
			post: {
				id: 0,
				client: 0,
				consecutive: '',
				name: '',
				object: '',
				description_service: '',
				date_start: '',
				date_end: '',
				additional_notes: '',
			}
		};
	},
	mounted: function () {
		var self = this;
		self.findRedicatedClients();
	},
	methods: {
		deleteRedicatedClients: function () {
			var self = this;
			var post = this.post;
			
			apiMV.delete('/redicated_clients/' + self.$route.params.redicated_client_id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Clients/' + self.$route.params.client_id + '/Contracts/Edit');
		},
		findRedicatedClients: function(){
			var self = this;
			var idRedicatedClients = self.$route.params.redicated_client_id;
			
			apiMV.get('/redicated_clients/' + idRedicatedClients).then(function (response) {
				if(!response.data.id || !response.data.contact)
				{
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Clients_Auditors_Delete = Vue.extend({
	template: '#delete-ClientsAuditors',
	data: function () {
		return {
			post: {
				id: 0,
				client: 0,
				contact: 0,
			}
		};
	},
	mounted: function () {
		var self = this;
		self.findClientsAuditors();
	},
	methods: {
		deleteClientsAuditors: function () {
			var self = this;
			var post = this.post;
			
			apiMV.delete('/auditors_clients/' + self.$route.params.auditor_client_id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Clients/' + self.$route.params.client_id + '/Auditors/Edit');
		},
		findClientsAuditors: function(){
			var self = this;
			var idClientsAuditors = self.$route.params.auditor_client_id;
			
			apiMV.get('/auditors_clients/' + idClientsAuditors).then(function (response) {
				if(!response.data.id || !response.data.contact)
				{
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Clients_Attributes_Services_Delete = Vue.extend({
	template: '#delete-AttributesServicesClients',
	data: function () {
		return {
			post: {
				id: 0,
				service_client: 0,
				attribute: 0,
				quantity: 0,
				date_start: '',
				date_end: '',
			}
		};
	},
	mounted: function () {
		var self = this;
		self.findClientsAttributesServices();
	},
	methods: {
		deleteClientsAttributesServices: function () {
			var self = this;
			var post = this.post;
			
			apiMV.delete('/attributes_services_clients/' + self.$route.params.client_attribute_service_id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Clients/' + self.$route.params.client_id + '/Accounts/Edit');
		},
		findClientsAttributesServices: function(){
			var self = this;
			var idClientsAttributesServices = self.$route.params.client_attribute_service_id;
			
			apiMV.get('/attributes_services_clients/' + idClientsAttributesServices).then(function (response) {
				if(!response.data.id)
				{
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Clients_Attributes_Services_Add = Vue.extend({
	template: '#add-AttributesServicesClients',
	data: function () {
		return {
			selectOptions: {
				attributes: [],
			},
			post: {
				account: this.$route.params.account_client_id,
				attribute: 0,
				quantity: 0,
				iva: 0,
				date_start: '',
				date_end: '',
			},
		}
	},
	mounted: function(){
		var self = this;
		
		self.loadSelects();
	},
	methods: {
		formatMoney: function(n, c, d, t){
			var c = isNaN(c = Math.abs(c)) ? 2 : c,
				d = d == undefined ? "." : d,
				t = t == undefined ? "," : t,
				s = n < 0 ? "-" : "",
				i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
				j = (j = i.length) > 3 ? j % 3 : 0;

			return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		},
		calulator_result: function(){
			var self = this;
			
			select.total;
		},
		loadSelects: function(){
			var self = this;
			
			apiMV.get('/attributes', { params: { order: 'name,asc', } })
				.then(function (response) { self.selectOptions.attributes = response.data.records; })
				.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
		},
		createAttributesServicesClients: function() {
			var self = this;
			var post = this.post;
			
			if(post.date_start == '' || post.date_start == 0){ delete post.date_start; };
			if(post.date_end == '' || post.date_end == 0){ delete post.date_end; };
			
			apiMV.post('/attributes_services_clients', post).then(function (response) {
				post.id = response.data;
				router.push('/Clients/' + self.$route.params.client_id + '/Accounts/Edit');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Clients_Services_Add = Vue.extend({
	template: '#add-ServicesClients',
	data: function () {
		return {
			selectOptions: {
				services: [],
				types_repeats_services_clients: [],
			},
			post: {
				account: this.$route.params.account_client_id,
				service: 0,
				quantity: 0,
				date_start: '',
				date_end: '',
			},
		}
	},
	mounted: function(){
		var self = this;
		self.loadSelects();
	},
	methods: {
		formatMoney: function(n, c, d, t){
			var c = isNaN(c = Math.abs(c)) ? 2 : c,
				d = d == undefined ? "." : d,
				t = t == undefined ? "," : t,
				s = n < 0 ? "-" : "",
				i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
				j = (j = i.length) > 3 ? j % 3 : 0;

			return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
		},
		loadSelects: function(){
			var self = this;
			
			apiMV.get('/services', {
				params: {
					join: [
					],
					order: 'name,asc',
				}
			})
			.then(function (response) { self.selectOptions.services = response.data.records; })
			.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
			
			apiMV.get('/types_repeats_services_clients', {
				params: {
					join: [
					],
					order: 'name,asc',
				}
			})
			.then(function (response) { self.selectOptions.types_repeats_services_clients = response.data.records; })
			.catch(function (error) { $.notify(error.response.data.code + error.response.data.message, "error"); });
		},
		createServicesClients: function() {
			var self = this;
			var post = this.post;
			
			if(post.date_start == '' || post.date_start == 0){ delete post.date_start; };
			if(post.date_end == '' || post.date_end == 0){ delete post.date_end; };
			
			apiMV.post('/services_clients', post).then(function (response) {
				post.id = response.data;
				
				router.push('/Clients/' + self.$route.params.client_id + '/Accounts/Edit');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Clients_Services_Delete = Vue.extend({
	template: '#delete-ServicesClients',
	data: function () {
		return {
			post: {
				id: 0,
				account: 0,
				service: 0,
				quantity: 0,
				date_start: '',
				date_end: '',
				repeat: 0,
				description: '',
			}
		};
	},
	mounted: function () {
		var self = this;
		self.findClientsServices();
	},
	methods: {
		deleteClientsServices: function () {
			var self = this;
			var post = this.post;
			
			apiMV.delete('/services_clients/' + self.$route.params.client_service_id).then(function (response) {
				console.log(response.data);
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
			router.push('/Clients/' + self.$route.params.client_id + '/Accounts/Edit');
		},
		findClientsServices: function(){
			var self = this;
			var idClientsServices = self.$route.params.client_service_id;
			
			apiMV.get('/services_clients/' + idClientsServices).then(function (response) {
				if(!response.data.id)
				{
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Clients_Accounts_Delete = Vue.extend({
	template: '#delete-AccountsClients',
	data: function () {
		return {
			post: {
				id: 0,
				client: 0,
			}
		};
	},
	mounted: function () {
		var self = this;
		self.findAccountsClients();
	},
	methods: {
		deleteAccountsClients: function () {
			var self = this;
			var post = this.post;
			
			apiMV.delete('/accounts_clients/' + self.$route.params.account_client_id).then(function (response) {
				console.log(response.data);
				$.notify("Eliminada", "success");
				router.push('/Clients/' + self.$route.params.client_id + '/Accounts/Edit');
			}).catch(function (error) {
				console.log(error.response);
				console.log(error.response.data.code);
				console.log(error.response.data.code);
				if(error.response.data.code == 1010){
					$.notify("La cuenta debe estar vacia para ser eliminada.", "error");
				}
				else{
					$.notify(error.response.data.code + error.response.data.message, "error");
					
				}
				
				
			});
		},
		findAccountsClients: function(){
			var self = this;
			var idClientsAccounts = self.$route.params.account_client_id;
			
			apiMV.get('/accounts_clients/' + idClientsAccounts).then(function (response) {
				if(!response.data.id)
				{
					
				}
				else
				{
					self.post = response.data;
				}
			}).catch(function (error) {
				console.log(error.response);
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

// ------------ CLIENTES - FIN ------------------------------------- 

var router = new VueRouter({routes:[
	
	{ path: '/Employees', component: Employees_List, name: 'Employees-List'},
	{ path: '/Employees/:employee_id', component: Employees_View, name: 'Employees-View'},
	{ path: '/Employees/add', component: Employees_Add, name: 'Employees-Add'},
	{ path: '/Employees/:employee_id/edit', component: Employees_Edit, name: 'Employees-Edit'},
	{ path: '/Employees/:employee_id/delete', component: Employees_Delete, name: 'Employees-Delete'},
	{ path: '/Employees/:employee_id/Contact/:employee_contact_id/delete', component: Employees_Contacts_Delete, name: 'EmployeesContacts-Delete'},
	{ path: '/Employees/:employee_id/ContractedStaff/:contracted_staff_id/delete', component: ContractedStaff_Delete, name: 'ContractedStaff-Delete'},
	
	{ path: '/Clients', component: Clients_List, name: 'Clients-List'},
	{ path: '/Clients/:client_id', component: Clients_View, name: 'Clients-View'},
	{ path: '/Client/add', component: Clients_Add, name: 'Clients-Add'},
	{ path: '/Clients/:client_id/Info/edit', component: Clients_Info_Edit, name: 'Clients-Info-Edit'},
	{ path: '/Clients/:client_id/Contacts/edit', component: Clients_Contacts_Edit, name: 'Clients-Contacts-Edit'},
	{ path: '/Clients/:client_id/Contracts/edit', component: Clients_Contracts_Edit, name: 'Clients-Contracts-Edit'},
	{ path: '/Clients/:client_id/Auditors/edit', component: Clients_Auditors_Edit, name: 'Clients-Auditors-Edit'},
	{ path: '/Clients/:client_id/Accounts/edit', component: Clients_Accounts_Edit, name: 'Clients-Accounts-Edit'},
	{ path: '/Clients/:client_id/Invoices/edit', component: Clients_Invoices_Edit, name: 'Clients-Invoices-Edit'},
	{ path: '/Clients/:client_id/Quotations/edit', component: Clients_Quotations_Edit, name: 'Clients-Quotations-Edit'},
	{ path: '/Clients/:client_id/ContractsServices/edit', component: Clients_ContractsServices_Edit, name: 'Clients-ContractsServices-Edit'},
	{ path: '/Clients/:client_id/delete', component: Clients_Delete, name: 'Clients-Delete'},
	{ path: '/Clients/:client_id/Contact/:client_contact_id/delete', component: Clients_Contacts_Delete, name: 'ClientsContacts-Delete'},
	{ path: '/Clients/:client_id/Redicated/:redicated_client_id/delete', component: Clients_Redicated_Delete, name: 'RedicatedClients-Delete'},
	{ path: '/Clients/:client_id/Auditors/:auditor_client_id/delete', component: Clients_Auditors_Delete, name: 'ClientsAuditors-Delete'},
	{ path: '/Clients/:client_id/Accounts/:account_client_id/Delete', component: Clients_Accounts_Delete, name: 'Clients-Accounts-Delete'},

	{ path: '/Accounts/:account_client_id/Clients/:client_id/Attributes/add', component: Clients_Attributes_Services_Add, name: 'AttributesServicesClients-Add'},
	{ path: '/Accounts/:account_client_id/Clients/:client_id/Attribute/:client_attribute_service_id/delete', component: Clients_Attributes_Services_Delete, name: 'AttributesServicesClients-Delete'},
	{ path: '/Accounts/:account_client_id/Clients/:client_id/Services/add', component: Clients_Services_Add, name: 'ServicesClients-Add'},
	{ path: '/Accounts/:account_client_id/Clients/:client_id/Service/:client_service_id/delete', component: Clients_Services_Delete, name: 'ServicesClients-Delete'},
	
	{ path: '/Employees/Actions/Performances/', component: Actions_Performance_Employees_List, name: 'Actions_Performance_Employees-List'},
	{ path: '/Employees/Actions/Performances/:action_performance_employee_id', component: Actions_Performance_Employees_View, name: 'Actions_Performance_Employees-View'},
	{ path: '/Employees/Actions/Performances/add', component: Actions_Performance_Employees_Add, name: 'Actions_Performance_Employees-Add'},
	{ path: '/Employees/Actions/Performances/:action_performance_employee_id/edit', component: Actions_Performance_Employees_Edit, name: 'Actions_Performance_Employees-Edit'},
	{ path: '/Employees/Actions/Performances/:action_performance_employee_id/delete', component: Actions_Performance_Employees_Delete, name: 'Actions_Performance_Employees-Delete'},
	
]});