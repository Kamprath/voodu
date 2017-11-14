// import dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';

// import assets
import App from './components/App.vue';
import 'bulma/css/bulma.css';

// register plugins
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

// instantiate App component, inject router, and mount to #app element
new Vue(
	Vue.util.extend({
		router: new VueRouter({
            mode: 'history',
            linkActiveClass: 'is-active',
            routes: require('./routes.js')
        })
	}, App)
).$mount('#app');