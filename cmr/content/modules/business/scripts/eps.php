<script>
// ------------ EPS INICIO ------------------------------------- 
var EPS_List = Vue.extend({
  template: '#page-EPS',
  data: function () {
    return {
		posts: [],
		searchKey: ''
	};
  },
  mounted: function () {
    var self = this;
    apiMV.get('/eps').then(function (response) {
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

var EPS_View = Vue.extend({
	template: '#view-EPS',
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
		self.findEps();
	},
	methods: {
		findEps: function(){
			var self = this;
			var idEps = self.$route.params.eps_id;
			
			apiMV.get('/eps/' + idEps).then(function (response) {
				self.post = response.data;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var EPS_Add = Vue.extend({
	template: '#add-EPS',
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
		createEPS: function() {
			var post = this.post;
			apiMV.post('/eps', post).then(function (response) {
				post.id = response.data;
				router.push('/');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var EPS_Edit = Vue.extend({
	template: '#edit-EPS',
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
		self.findEps();
	},
	methods: {
		updateEPS: function () {
			var post = this.post;
			apiMV.put('/eps/' + post.id, post).then(function (response) {
				console.log(response.data);
				router.push('/');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findEps: function(){
			var self = this;
			var idEps = self.$route.params.eps_id;
			
			apiMV.get('/eps/' + idEps).then(function (response) {
				self.post = response.data;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var EPS_Delete = Vue.extend({
	template: '#delete-EPS',
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
		self.findEps();
	},
	methods: {
		deleteEPS: function () {
			var post = this.post;
			
			apiMV.delete('/eps/' + post.id).then(function (response) {
				console.log(response.data);
				router.push('/');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findEps: function(){
			var self = this;
			var idEps = self.$route.params.eps_id;
			
			apiMV.get('/eps/' + idEps).then(function (response) {
				self.post = response.data;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
				router.push('/');
			});
		}
	}
});
// ------------ EPS FIN ------------------------------------- 

	var router = new VueRouter({routes:[
		{ path: '/', component: EPS_List, name: 'EPS-List'},
		{ path: '/View/:eps_id', component: EPS_View, name: 'EPS-View'},
		{ path: '/Add', component: EPS_Add, name: 'EPS-Add'},
		{ path: '/Edit/:eps_id', component: EPS_Edit, name: 'EPS-Edit'},
		{ path: '/Delete/:eps_id', component: EPS_Delete, name: 'EPS-Delete'},
		
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