import Vue from 'vue';
import VueX from 'vuex';

// modules
import app from './modules/app.js';
import boards from './modules/boards.js';
import tasks from './modules/tasks.js';
import dashboard from './modules/dashboard.js';

Vue.use(VueX);

export default new VueX.Store({

    modules: { app, boards, tasks, dashboard }

});