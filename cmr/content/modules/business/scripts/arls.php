<script>
	// ------------ ARL INICIO ------------------------------------- 
	var ARL_List = Vue.extend({
		template: '#page-ARL',
		data: function () {
			return {
				posts: [],
				searchKey: ''
			};
		},
		create: function () {
		},
		mounted: function () {
			var self = this;
			self.posts = [];
			
			apiMV.get('/arls').then(function (response) {
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

	var ARL_View = Vue.extend({
		template: '#view-ARL',
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
			self.findArl();
		},
		methods: {
			findArl: function(){
				var self = this;
				var idArl = self.$route.params.arl_id;
				
				apiMV.get('/arls/' + idArl).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var ARL_Add = Vue.extend({
		template: '#add-ARL',
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
			createARL: function() {
				var post = this.post;
				apiMV.post('/arls', post).then(function (response) {
					post.id = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
					router.push('/');
			}
		}
	});

	var ARL_Edit = Vue.extend({
		template: '#edit-ARL',
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
			self.findArl();
		},
		methods: {
			updateARL: function () {
				var post = this.post;
				apiMV.put('/arls/' + post.id, post).then(function (response) {
					// console.log(response.data);
					$.notify("Guardado con éxito.", "success");
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findArl: function(){
				var self = this;
				var idArl = self.$route.params.arl_id;
				apiMV.get('/arls/' + idArl).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var ARL_Delete = Vue.extend({
		template: '#delete-ARL',
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
			self.findArl();
		},
		methods: {
			deleteARL: function () {
				var post = this.post;
				
				apiMV.delete('/arls/' + post.id).then(function (response) {
					console.log(response.data);
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				router.push('/');
			},
			findArl: function(){
				var self = this;
				var idArl = self.$route.params.arl_id;
				
				apiMV.get('/arls/' + idArl).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
					router.push('/');
				});
			}
		}
	});
	// ------------ ARL FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: ARL_List, name: 'ARL-List'},
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
</script>