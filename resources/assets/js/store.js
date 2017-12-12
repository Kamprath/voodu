import Vue from 'vue';
import VueX from 'vuex';

// modules
import app from './modules/app';
import boards from './modules/boards';
import tasks from './modules/tasks';
import dashboard from './modules/dashboard';
import users from './modules/users';
import team from './modules/team';

Vue.use(VueX);

export default new VueX.Store({

    modules: { app, boards, tasks, dashboard, users, team }

});