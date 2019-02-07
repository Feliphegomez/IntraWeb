<script>
	// ------------ CAJAS DE PENSION INICIO ------------------------------------- 
	var FundsPension_List = Vue.extend({
		template: '#page-FundsPension',
		data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
		mounted: function () {
			var self = this;
			self.posts = [];
			apiMV.get('/funds_pensions').then(function (response) {
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

	var FundsPension_View = Vue.extend({
		template: '#view-FundsPension',
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
			self.findFundPension();
		},
		methods: {
			findFundPension: function(){
				var self = this;
				var idFundPension = self.$route.params.fund_pension_id;
				
				apiMV.get('/funds_pensions/' + idFundPension).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var FundsPension_Add = Vue.extend({
		template: '#add-FundsPension',
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
			createFundPension: function() {
				var post = this.post;
				apiMV.post('/funds_pensions', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var FundsPension_Edit = Vue.extend({
		template: '#edit-FundsPension',
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
			self.findFundPension();
		},
		methods: {
			updateFundPension: function () {
				var post = this.post;
				apiMV.put('/funds_pensions/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findFundPension: function(){
				var self = this;
				var idFundPension = self.$route.params.fund_pension_id;
				
				apiMV.get('/funds_pensions/' + idFundPension).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var FundsPension_Delete = Vue.extend({
		template: '#delete-FundsPension',
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
			self.findFundPension();
		},
		methods: {
			deleteFundPension: function () {
				var post = this.post;
				
				apiMV.delete('/funds_pensions/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findFundPension: function(){
				var self = this;
				var idFundPension = self.$route.params.fund_pension_id;
				
				apiMV.get('/funds_pensions/' + idFundPension).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ CAJAS DE PENSION FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: FundsPension_List, name: 'FundsPension-List'},
		{ path: '/View/:fund_pension_id', component: FundsPension_View, name: 'FundsPension-View'},
		{ path: '/Add', component: FundsPension_Add, name: 'FundsPension-Add'},
		{ path: '/Edit/:fund_pension_id', component: FundsPension_Edit, name: 'FundsPension-Edit'},
		{ path: '/Delete/:fund_pension_id', component: FundsPension_Delete, name: 'FundsPension-Delete'},
		
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