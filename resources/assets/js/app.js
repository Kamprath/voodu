// import dependencies
import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';

// import assets
import App from './components/views/App.vue';
import router from './router.js';
import store from './store.js';

// create a central event bus
Voodu.Events = new Vue();

// register plugins
Vue.use(VueAxios, axios);

// instantiate App component, inject router and VueX store, and mount to #app
new Vue(
	Vue.util.extend({ router, store }, App)
).$mount('#app');