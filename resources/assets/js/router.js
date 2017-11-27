import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store.js';

Vue.use(VueRouter);

const router = new VueRouter({

    mode: 'history',

    linkActiveClass: 'is-active',

    routes: [
        {
            name: 'Dashboard',
            path: '/',
            component: require('./components/views/DashboardSection.vue')
        },
        {
            name: 'Tasks',
            path: '/tasks',
            component: require('./components/views/TasksSection.vue')
        },
        {
            name: 'Board',
            path: '/board/:id',
            component: require('./components/views/Board.vue')
        }
    ]

});

/**
 * Pre-route actions
 */
router.beforeEach((to, from, next) => {
    // hide any open sidebars
    store.dispatch('hideSidebar');

    // set page title to route name
    document.querySelector('title').text = !to.name ? 'Voodu' : to.name + ' | Voodu';

    next();
});

export default router;