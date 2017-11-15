import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({

    mode: 'history',

    linkActiveClass: 'is-active',

    routes: [
        {
            name: 'DashboardSection',
            path: '/',
            component: require('./components/DashboardSection.vue')
        },
        {
            name: 'TasksSection',
            path: '/tasks',
            component: require('./components/TasksSection.vue')
        }
    ]

});