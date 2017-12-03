import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store.js';

Vue.use(VueRouter);

const router = new VueRouter({

    mode: 'history',

    linkActiveClass: 'is-active',

    routes: [
        {
            path: '/',
            redirect: { name: 'Board' }
        },
        {
            name: 'Tasks',
            path: '/tasks',
            component: require('./components/views/TasksSection.vue')
        },
        {
            name: 'Board',
            path: '/boards/:id',
            component: require('./components/views/Board.vue')
        },
        {
            name: 'Edit Board',
            path: '/boards/:id/edit'
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