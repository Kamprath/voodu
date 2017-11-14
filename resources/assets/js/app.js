// import dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';

// import assets
import App from './components/App.vue';
import globals from './globals.js';
import routes from './routes.js';

// load Bulma CSS framework -- https://bulma.io
import 'bulma/css/bulma.css';

// initialize globals
window.Voodu = globals;

// register plugins
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

// instantiate App component on #app
new Vue(
    // inject router
	Vue.util.extend({
		router: new VueRouter({
            mode: 'history',
            linkActiveClass: 'is-active',
            routes
        })
	}, App)
).$mount('#app');