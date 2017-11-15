import Vue from 'vue';
import VueX from 'vuex';
import { mapState } from 'vuex';

Vue.use(VueX);

export default new VueX.Store({

	state: {
		message: 'test',

		routes: [
			{ name: 'Dashboard', path: '/' },
            { name: 'Tasks', path: '/tasks' }
        ]
	},

	mutations: {
		setMessage(state, payload) {
			state.message = payload;
		},

		setRoutes(state, payload) {
			state.routes = payload;
		}
	}

});