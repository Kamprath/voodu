// import dependencies
import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';

// import assets
import App from './components/App.vue';
import router from './router.js';
import store from './store.js';

// load Bulma CSS framework -- https://bulma.io
import 'bulma/css/bulma.css';

// create a central event bus
Voodu.Events = new Vue();

// register plugins
Vue.use(VueAxios, axios);

// instantiate App component, inject router and VueX store, and mount to #app
new Vue(
	Vue.util.extend({ router, store }, App)
).$mount('#app');