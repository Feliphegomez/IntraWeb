
<script>
	// ------------ CAJAS DE CESANTIAS INICIO ------------------------------------- 
	var FundsSeverances_List = Vue.extend({
		template: '#page-FundSeverances',
		data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
		mounted: function () {
			var self = this;
			self.posts = [];
			apiMV.get('/funds_severances').then(function (response) {
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

	var FundsSeverances_View = Vue.extend({
		template: '#view-FundSeverances',
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
			self.findFundSeverances();
		},
		methods: {
			findFundSeverances: function(){
				var self = this;
				var idFundSeverances = self.$route.params.fund_severances_id;
				
				apiMV.get('/funds_severances/' + idFundSeverances).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var FundsSeverances_Add = Vue.extend({
		template: '#add-FundSeverances',
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
			createFundSeverance: function() {
				var post = this.post;
				apiMV.post('/funds_severances', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			}
		}
	});

	var FundsSeverances_Edit = Vue.extend({
		template: '#edit-FundSeverances',
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
			self.findFundSeverances();
		},
		methods: {
			updateFundSeverance: function () {
				var post = this.post;
				apiMV.put('/funds_severances/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findFundSeverances: function(){
				var self = this;
				var idFundSeverances = self.$route.params.fund_severances_id;
				
				apiMV.get('/funds_severances/' + idFundSeverances).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var FundsSeverances_Delete = Vue.extend({
		template: '#delete-FundSeverances',
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
			self.findFundSeverances();
		},
		methods: {
			deleteFundSeverance: function () {
				var post = this.post;
				
				apiMV.delete('/funds_severances/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findFundSeverances: function(){
				var self = this;
				var idFundSeverances = self.$route.params.fund_severances_id;
				
				apiMV.get('/funds_severances/' + idFundSeverances).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ CAJAS DE CESANTIAS FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: FundsSeverances_List, name: 'FundSeverances-List'},
		{ path: '/View/:fund_severances_id', component: FundsSeverances_View, name: 'FundSeverances-View'},
		{ path: '/Add', component: FundsSeverances_Add, name: 'FundSeverances-Add'},
		{ path: '/Edit/:fund_severances_id', component: FundsSeverances_Edit, name: 'FundSeverances-Edit'},
		{ path: '/Delete/:fund_severances_id', component: FundsSeverances_Delete, name: 'FundSeverances-Delete'},
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
