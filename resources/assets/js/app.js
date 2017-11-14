// import dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';

// import assets
import App from './components/App.vue';
import routes from './routes.js';
import 'bulma/css/bulma.css';

// register libraries
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

// initialize router
const router = new VueRouter({
	mode: 'history',
	routes
});

// instantiate App component, inject router, and mount to #app element
new Vue(
	Vue.util.extend({ router }, App)
).$mount('#app');