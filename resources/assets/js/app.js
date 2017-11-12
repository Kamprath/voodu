// import dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import 'bulma/css/bulma.css';

// import components
import App from './components/App.vue';
import TasksSection from './components/TasksSection.vue';
import DashboardSection from './components/DashboardSection.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

// initialize router
const router = new VueRouter({
	mode: 'history',
	routes: [
		{
			name: 'DashboardSection',
			path: '/',
			component: DashboardSection
		},
		{
			name: 'TasksSection',
			path: '/tasks',
			component: TasksSection
		}
	]
});

// instantiate app component
new Vue(
	Vue.util.extend({ router }, App)
).$mount('#app');