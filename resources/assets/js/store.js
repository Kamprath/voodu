import Vue from 'vue';
import VueX from 'vuex';
import { mapState } from 'vuex';

// modules
import app from './modules/app.js';
import tasks from './modules/tasks.js';
import dashboard from './modules/dashboard.js';

Vue.use(VueX);

export default new VueX.Store({

    modules: { app, tasks, dashboard }

});