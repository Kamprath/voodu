import bootstrapped from '../bootstrapped.js';

export default {

    state: {
        routes: [
            { name: 'Dashboard', path: '/' },
            { name: 'Tasks', path: '/tasks' }
        ]
    },

    mutations: {
    	setRoutes(state, routes) {
    		state.routes = routes;
    	}
    },

    actions: {
		setRoutes(context, routes) {
			context.commit('setRoutes', routes);
		}
    }

};