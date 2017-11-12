// import dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import 'bulma/css/bulma.css';

// import components
import App from './components/App.vue';
import TasksSection from './components/TasksSection.vue';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

const router = new VueRouter({
	mode: 'history',
	routes: [
		{
			name: 'TasksSection',
			path: '/',
			component: TasksSection
		}
	]
});

new Vue(
	Vue.util.extend({ router }, App)
).$mount('#app');