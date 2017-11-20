import bootstrapped from '../bootstrapped.js';

export default {

    state: {
        routes: [
            { name: 'Dashboard', path: '/' },
            { name: 'Tasks', path: '/tasks' }
        ],

        section: null
    },

    mutations: {
    	setRoutes(state, routes) {
    		state.routes = routes;
    	},

        setSection(state, section) {
    	    state.section = section;
        }
    },

    actions: {
		setRoutes(context, routes) {
			context.commit('setRoutes', routes);
		},

        setSection(context, section) {
		    context.commit('setSection', section);
        }
    }

};