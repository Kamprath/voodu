import axios from 'axios';
import bootstrapped from '../bootstrapped.js';

export default {

    state: {
        message: bootstrapped.get('dashboard', 'message') || 'Loading...',

        messageIsLoading: !bootstrapped.get('dashboard', 'message')
    },

    mutations: {
        setMessage(state, payload) {
            state.message = payload;
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