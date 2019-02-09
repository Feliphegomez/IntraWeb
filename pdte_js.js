
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

var router = new VueRouter({routes:[
	{ path: '/Employees/Actions/Performances/', component: Actions_Performance_Employees_List, name: 'Actions_Performance_Employees-List'},
	{ path: '/Employees/Actions/Performances/:action_performance_employee_id', component: Actions_Performance_Employees_View, name: 'Actions_Performance_Employees-View'},
	{ path: '/Employees/Actions/Performances/add', component: Actions_Performance_Employees_Add, name: 'Actions_Performance_Employees-Add'},
	{ path: '/Employees/Actions/Performances/:action_performance_employee_id/edit', component: Actions_Performance_Employees_Edit, name: 'Actions_Performance_Employees-Edit'},
	{ path: '/Employees/Actions/Performances/:action_performance_employee_id/delete', component: Actions_Performance_Employees_Delete, name: 'Actions_Performance_Employees-Delete'},
	
]});