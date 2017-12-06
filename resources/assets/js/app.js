// polyfill for browsers (IE) that don't support promises
require('es6-promise').polyfill();

// import dependencies
import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';

// import assets
import App from './components/views/App.vue';
import router from './router.js';
import store from './store.js';

/**
 * Register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

// register plugins
Vue.use(VueAxios, axios);

// instantiate App component, inject router and VueX store, and mount to #app
new Vue(
	Vue.util.extend({ router, store }, App)
).$mount('#app');