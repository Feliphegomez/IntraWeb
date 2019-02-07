<script>
	// ------------ TIPOS - SANGRE INICIO ------------------------------------- 
	var Types_Bloods_List = Vue.extend({
	  template: '#page-TypesBloods',
	  data: function () {
		return {
			posts: [],
			searchKey: ''
		};
	  },
	  mounted: function () {
		var self = this;
		apiMV.get('/types_bloods').then(function (response) {
			self.posts = response.data.records;
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

	var Types_Bloods_View = Vue.extend({
		template: '#view-TypesBloods',
		data: function () {
			return {
				post: {
					id: 0,
					name: '',
				},
			};
		},
		mounted: function () {
			var self = this;
			self.findTypesBlood();
		},
		methods: {
			findTypesBlood: function(){
				var self = this;
				var idTypesBlood = self.$route.params.type_blood_id;
				
				apiMV.get('/types_bloods/' + idTypesBlood).then(function (response) {
					if(!response.data.id || !response.data.name)
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

	var Types_Bloods_Add = Vue.extend({
		template: '#add-TypesBloods',
		data: function () {
			return {
				post: {
					name: '',
				}
			}
		},
		methods: {
			createTypesBlood: function() {
				var post = this.post;
				apiMV.post('/types_bloods', post).then(function (response) {
					post.id = response.data;
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Bloods_Edit = Vue.extend({
		template: '#edit-TypesBloods',
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
			self.findTypesBlood();
		},
		methods: {
			updateTypesBlood: function () {
				var post = this.post;
				apiMV.put('/types_bloods/' + post.id, post).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
				
			},
			findTypesBlood: function(){
				var self = this;
				var idTypesBlood = self.$route.params.type_blood_id;
				
				apiMV.get('/types_bloods/' + idTypesBlood).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});

	var Types_Bloods_Delete = Vue.extend({
		template: '#delete-TypesBloods',
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
			self.findTypesBlood();
		},
		methods: {
			deleteTypesBlood: function () {
				var post = this.post;
				
				apiMV.delete('/types_bloods/' + post.id).then(function (response) {
					console.log(response.data);
					router.push('/');
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			},
			findTypesBlood: function(){
				var self = this;
				var idTypesBlood = self.$route.params.type_blood_id;
				
				apiMV.get('/types_bloods/' + idTypesBlood).then(function (response) {
					self.post = response.data;
				}).catch(function (error) {
					$.notify(error.response.data.code + error.response.data.message, "error");
				});
			}
		}
	});
	// ------------ TIPOS - SANGRE FIN ------------------------------------- 


	var router = new VueRouter({routes:[
		
		{ path: '/', component: Types_Bloods_List, name: 'TypesBloods-List'},
		{ path: '/View/:type_blood_id', component: Types_Bloods_View, name: 'TypesBloods-View'},
		{ path: '/Add', component: Types_Bloods_Add, name: 'TypesBloods-Add'},
		{ path: '/Edit/:type_blood_id', component: Types_Bloods_Edit, name: 'TypesBloods-Edit'},
		{ path: '/Delete/:type_blood_id', component: Types_Bloods_Delete, name: 'TypesBloods-Delete'},

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