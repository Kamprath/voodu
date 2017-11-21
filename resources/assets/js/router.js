import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({

    mode: 'history',

    linkActiveClass: 'is-active',

    routes: [
        {
            name: 'dashboard',
            path: '/',
            component: require('./components/DashboardSection.vue')
        },
        {
            name: 'tasks',
            path: '/tasks',
            component: require('./components/TasksSection.vue')
        },
        {
            name: 'board',
            path: '/board/:id',
            component: require('./components/Board.vue')
        }
    ]

});