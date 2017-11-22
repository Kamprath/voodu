import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store.js';

Vue.use(VueRouter);

const router = new VueRouter({

    mode: 'history',

    linkActiveClass: 'is-active',

    routes: [
        {
            name: 'dashboard',
            path: '/',
            component: require('./components/views/DashboardSection.vue')
        },
        {
            name: 'tasks',
            path: '/tasks',
            component: require('./components/views/TasksSection.vue')
        },
        {
            name: 'board',
            path: '/board/:id',
            component: require('./components/views/Board.vue')
        }
    ]

});

/**
 * Pre-route actions
 */
router.beforeEach((to, from, next) => {
    // hide any open sidebar
    store.dispatch('hideSidebar');
    next();
});

export default router;