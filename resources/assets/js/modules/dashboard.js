import axios from 'axios';

const bootstrapped = Voodu.bootstrapped;
bootstrapped.dashboard = bootstrapped.dashboard || {};

export default {

    state: {
        message: bootstrapped.dashboard.message || 'Loading...',

        messageIsLoading: !bootstrapped.dashboard.message,

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
        },

        setMessageLoading(state, isLoading) {
            state.messageIsLoading = isLoading;
        }
    },

    actions: {
        updateMessage(context) {
            context.commit('setMessageLoading', true);

            axios.get('/api/message')
                .then(response => {
                    context.commit('setMessage', response.data.message);
                    context.commit('setMessageLoading', false);
                });
        }
    }

};