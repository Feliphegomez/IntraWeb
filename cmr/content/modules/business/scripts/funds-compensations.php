
<script>

	// ------------ CAJAS DE COMPENSACION INICIO ------------------------------------- 
	var FundsCompensation_List = Vue.extend({
		template: '#page-FundsCompensation',
		data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
		mounted: function () {
			var self = this;
			self.posts = [];
			apiMV.get('/funds_compensations').then(function (response) {
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

	var FundsCompensation_View = Vue.extend({
		template: '#view-FundsCompensation',
		data: function () {
			return {
				post: {
					id: 0,
					code: '',
					name: '',
				},
			};
		},
		mounted: function () {
			var self = this;
			self.findFundCompensation();
		},
		methods: {
			findFundCompensation: function(){
				var self = this;
				var idFundCompensation = self.$route.params.fund_compensation_id;
				
				apiMV.get('/funds_compensations/' + idFundCompensation).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var FundsCompensation_Add = Vue.extend({
		template: '#add-FundsCompensation',
		data: function () {
			return {
				post: {
					id: 0,
					code: '',
					name: ''
				}
			}
		},
		methods: {
			createFundCompensation: function() {
				var post = this.post;
				apiMV.post('/funds_compensations', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var FundsCompensation_Edit = Vue.extend({
		template: '#edit-FundsCompensation',
		data: function () {
			return {
				post: {
					id: 0,
					code: '',
					name: ''
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findFundCompensation();
		},
		methods: {
			updateFundCompensation: function () {
				var post = this.post;
				apiMV.put('/funds_compensations/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});				
			},
			findFundCompensation: function(){
				var self = this;
				var idFundCompensation = self.$route.params.fund_compensation_id;
				
				apiMV.get('/funds_compensations/' + idFundCompensation).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var FundsCompensation_Delete = Vue.extend({
		template: '#delete-FundsCompensation',
		data: function () {
			return {
				post: {
					id: 0,
					code: '',
					name: ''
				}
			};
		},
		mounted: function () {
			var self = this;
			self.findFundCompensation();
		},
		methods: {
			deleteFundCompensation: function () {
				var post = this.post;
				
				apiMV.delete('/funds_compensations/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findFundCompensation: function(){
				var self = this;
				var idFundCompensation = self.$route.params.fund_compensation_id;
				
				apiMV.get('/funds_compensations/' + idFundCompensation).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ CAJAS DE COMPENSACION FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: FundsCompensation_List, name: 'FundsCompensation-List'},
		{ path: '/View/:fund_compensation_id', component: FundsCompensation_View, name: 'FundsCompensation-View'},
		{ path: '/Add', component: FundsCompensation_Add, name: 'FundsCompensation-Add'},
		{ path: '/Edit/:fund_compensation_id', component: FundsCompensation_Edit, name: 'FundsCompensation-Edit'},
		{ path: '/Delete/:fund_compensation_id', component: FundsCompensation_Delete, name: 'FundsCompensation-Delete'},
		
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
