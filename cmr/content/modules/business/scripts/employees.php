<style>
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
.profile-img img{
    width: 70%;
    height: 100%;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}
.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}
.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
</style>

<script>
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
			$(document).ready(function() { $('#dataTable').DataTable(); });
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
				router.push('/');
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
				
				apiMV.get('/arls', { params: { order: 'name,asc', } })
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
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			}
		}
	});

	var Employees_View_Contacts = Vue.extend({
		template: '#view-Employees-Contacts',
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
					$(document).ready(function() { $('#dataTable').DataTable(); });					
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			}
		}
	});

	var Employees_View_Contracts = Vue.extend({
		template: '#view-Employees-Contracts',
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
					$(document).ready(function() { $('#dataTable').DataTable(); });
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			}
		}
	});

	var Employees_View_Performances = Vue.extend({
		template: '#view-Employees-Performances',
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
					$(document).ready(function() { $('#dataTable').DataTable(); });
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Employees_View_PaymentStubs = Vue.extend({
		template: '#view-Employees-PaymentStubs',
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
				
			}
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
				router.push('/');
				location.reload();
			},
			findEmployee: function(){
				var self = this;
				var idEmployee = self.$route.params.employee_id;
				
				apiMV.get('/employees/' + idEmployee).then(function (response) {
					if(!response.data.id || !response.data.first_name)
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
				router.push('//' + self.$route.params.employee_id + '/Edit');
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
				router.push('//' + self.$route.params.employee_id + '/Edit');
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
					id: this.$route.params.employee_id,
					avatar: 0,
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
			updateAvatarEmployee: function(e){
				var self = this;
				var image = e;
				var file = image.target.files[0];
				var reader = new FileReader();
				// Set preview image into the popover data-content

				reader.onload = function (e) {
					var image_preview = {};
					image_preview.name = file.name;
					image_preview.size = file.size;
					image_preview.data = e.target.result;
					image_preview.type = file.type;
				
					apiMV.post('/pictures', image_preview).then(function (response) {
						var imageId = response.data;
						var tempInsert = {};
						self.post.avatar = imageId;
						self.updateEmployee();
					}).catch(function (error) {
						$.notify(error.response.data.code + error.response.data.message, "error");
					});
				}        
				reader.readAsDataURL(file);
			},
			updateEmployee: function () {
				var post = this.post;
				apiMV.put('/employees/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/Edit/' + post.id);
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findEmployee: function(){
				var self = this;
				var idEmployee = self.$route.params.employee_id;
				
				apiMV.get('/employees/' + idEmployee).then(function (response) {
					if(!response.data.id || !response.data.first_name)
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
				
				apiMV.get('/arls', { params: { order: 'name,asc', } })
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

	var Employees_Edit_Contacts = Vue.extend({
		template: '#edit-Employees-Contacts',
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
				router.push('/');
			},
			findEmployee: function(){
				var self = this;
				var idEmployee = self.$route.params.employee_id;
				
				apiMV.get('/employees/' + idEmployee).then(function (response) {
					if(!response.data.id || !response.data.first_name)
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
				
				apiMV.get('/arls', { params: { order: 'name,asc', } })
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

	var Employees_Edit_Contracts = Vue.extend({
		template: '#edit-Employees-Contracts',
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
				router.push('/');
			},
			findEmployee: function(){
				var self = this;
				var idEmployee = self.$route.params.employee_id;
				
				self.contracted_staff = [];
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
					$(document).ready(function() { $('#dataTable').DataTable(); });
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
				
				apiMV.get('/arls', { params: { order: 'name,asc', } })
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

	var Employees_Edit_Performances = Vue.extend({
		template: '#edit-Employees-Performances',
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
				router.push('/');
			},
			findEmployee: function(){
				var self = this;
				var idEmployee = self.$route.params.employee_id;
				
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
				
				apiMV.get('/arls', { params: { order: 'name,asc', } })
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

	var Employees_Edit_PaymentStubs = Vue.extend({
		template: '#edit-Employees-PaymentStubs',
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
				router.push('/');
			},
			findEmployee: function(){
				var self = this;
				var idEmployee = self.$route.params.employee_id;
				
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
				
				apiMV.get('/arls', { params: { order: 'name,asc', } })
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

	var router = new VueRouter({routes:[
		{ path: '/', component: Employees_List, name: 'Employees-List'},
		{ path: '/Add', component: Employees_Add, name: 'Employees-Add'},
		{ path: '/Delete/:employee_id', component: Employees_Delete, name: 'Employees-Delete'},
		
		{ path: '/View/:employee_id', component: Employees_View, name: 'Employees-View'},
		{ path: '/View/:employee_id/Contacts', component: Employees_View_Contacts, name: 'Employees-View-Contacts'},
		{ path: '/View/:employee_id/Contracts', component: Employees_View_Contracts, name: 'Employees-View-Contracts'},
		{ path: '/View/:employee_id/Performances', component: Employees_View_Performances, name: 'Employees-View-Performances'},
		{ path: '/View/:employee_id/PaymentStubs', component: Employees_View_PaymentStubs, name: 'Employees-View-PaymentStubs'},
		
		{ path: '/Edit/:employee_id', component: Employees_Edit, name: 'Employees-Edit'},
		{ path: '/Edit/:employee_id/Contacts', component: Employees_Edit_Contacts, name: 'Employees-Edit-Contacts'},
		{ path: '/Edit/:employee_id/Contracts', component: Employees_Edit_Contracts, name: 'Employees-Edit-Contracts'},
		{ path: '/Edit/:employee_id/Performances', component: Employees_Edit_Performances, name: 'Employees-Edit-Performances'},
		{ path: '/Edit/:employee_id/PaymentStubs', component: Employees_Edit_PaymentStubs, name: 'Employees-Edit-PaymentStubs'},
		
		{ path: '/Edit/:employee_id/Contact/:employee_contact_id/delete', component: Employees_Contacts_Delete, name: 'EmployeesContacts-Delete'},
		{ path: '/Edit/:employee_id/ContractedStaff/:contracted_staff_id/delete', component: ContractedStaff_Delete, name: 'ContractedStaff-Delete'},
		
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
