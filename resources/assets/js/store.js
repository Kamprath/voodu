import { mapState } from 'vuex';

// VueX data store
export default {

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

}