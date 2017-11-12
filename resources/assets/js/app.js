// require('./bootstrap');

// import dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';

// import components
import App from './components/App.vue';
import TaskList from './components/TaskList.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
	mode: 'history',
	routes: [
		{
			name: 'TaskList',
			path: '/',
			component: TaskList
		}
	]
});

new Vue(
	Vue.util.extend({ router }, App)
).$mount('#app');