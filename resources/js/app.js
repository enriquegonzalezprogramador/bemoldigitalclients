import Vue from 'vue';
import axios from 'axios';
import App from '@/js/views/App.vue';
import vuetify from '@/js/config/vuetify';
import router from '@/js/router';
import store from '@/js/store';
import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/dist/vuetify.min.css';

import Dashboard from '@/js/layouts/dashboard.vue';
import NoDashboard from '@/js/layouts/no-dashboard.vue';

require('./bootstrap');

// Layouts
Vue.component('dashboard', Dashboard);

Vue.component('no-dashboard', NoDashboard);

// axios
const baseUrl = 'https://localhost/api';

axios.defaults.baseURL = baseUrl;

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const crsfToken = document.head.querySelector('meta[name="csrf-token"]');
if (crsfToken) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = crsfToken.content;
}

const accessToken = localStorage.getItem('access_token');
if (accessToken) {
  axios.defaults.headers.common.Authorization = accessToken;
}

// $http
Vue.prototype.$http = axios;

// router
Vue.router = router;

// store
Vue.store = store;

App.router = Vue.router;
App.store = Vue.store;

new Vue({
  vuetify,
  render: h => h(App),
}).$mount('#app');
