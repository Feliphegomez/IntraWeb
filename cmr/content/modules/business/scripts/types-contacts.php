<script>
// ------------ TIPOS - CONTACTOS INICIO ------------------------------------- 
var Types_Contacts_List = Vue.extend({
  template: '#page-TypesContacts',
  data: function () {
    return {
		posts: [],
		searchKey: ''
	};
  },
  mounted: function () {
    var self = this;
	self.posts = [];
    apiMV.get('/types_contacts').then(function (response) {
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

var Types_Contacts_View = Vue.extend({
	template: '#view-TypesContacts',
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
		self.findTypesContact();
	},
	methods: {
		findTypesContact: function(){
			var self = this;
			var idTypesContact = self.$route.params.type_contact_id;
			
			apiMV.get('/types_contacts/' + idTypesContact).then(function (response) {
				self.post = response.data;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Types_Contacts_Add = Vue.extend({
	template: '#add-TypesContacts',
	data: function () {
		return {
			post: {
				name: '',
			}
		}
	},
	methods: {
		createTypesContact: function() {
			var post = this.post;
			apiMV.post('/types_contacts', post).then(function (response) {
				post.id = response.data;
				router.push('/');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Types_Contacts_Edit = Vue.extend({
	template: '#edit-TypesContacts',
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
		self.findTypesContact();
	},
	methods: {
		updateTypesContact: function () {
			var post = this.post;
			apiMV.put('/types_contacts/' + post.id, post).then(function (response) {
				console.log(response.data);
				router.push('/');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findTypesContact: function(){
			var self = this;
			var idTypesContact = self.$route.params.type_contact_id;
			
			apiMV.get('/types_contacts/' + idTypesContact).then(function (response) {
				self.post = response.data;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});

var Types_Contacts_Delete = Vue.extend({
	template: '#delete-TypesContacts',
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
		self.findTypesContact();
	},
	methods: {
		deleteTypesContact: function () {
			var post = this.post;
			
			apiMV.delete('/types_contacts/' + post.id).then(function (response) {
				console.log(response.data);
				router.push('/');
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		},
		findTypesContact: function(){
			var self = this;
			var idTypesContact = self.$route.params.type_contact_id;
			
			apiMV.get('/types_contacts/' + idTypesContact).then(function (response) {
				self.post = response.data;
			}).catch(function (error) {
				$.notify(error.response.data.code + error.response.data.message, "error");
			});
		}
	}
});
// ------------ TIPOS - CONTACTOS FIN ------------------------------------- 


	var router = new VueRouter({routes:[
		{ path: '/', component: Types_Contacts_List, name: 'TypesContacts-List'},
		{ path: '/View/:type_contact_id', component: Types_Contacts_View, name: 'TypesContacts-View'},
		{ path: '/Add', component: Types_Contacts_Add, name: 'TypesContacts-Add'},
		{ path: '/Edit/:type_contact_id', component: Types_Contacts_Edit, name: 'TypesContacts-Edit'},
		{ path: '/Delete/:type_contact_id', component: Types_Contacts_Delete, name: 'TypesContacts-Delete'},
		
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