// import dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueX from 'vuex';

// import assets
import App from './components/App.vue';
import globals from './globals.js';
import routes from './routes.js';
import store from './store.js';

// load Bulma CSS framework -- https://bulma.io
import 'bulma/css/bulma.css';

// initialize globals
window.Voodu = globals;

// register plugins
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueX);

// instantiate App component on #app
new Vue(
	Vue.util.extend({
		// inject router
		router: new VueRouter({
            mode: 'history',
            linkActiveClass: 'is-active',
            routes
        }),

		// inject VueX store
        store: new VueX.Store(store)
	}, App)
).$mount('#app');