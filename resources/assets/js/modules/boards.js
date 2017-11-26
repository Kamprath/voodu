import bootstrapped from '../bootstrapped.js';
import axios from 'axios';

export default {

    state: {
        models: bootstrapped.get('boards', 'models'),

        isCreateOverlayActive: false
    },

    mutations: {
        deleteBoard(state, id) {

        },

        showCreateBoardOverlay(state, isVisible = true) {
            state.isCreateOverlayActive = isVisible;
        },

    },

    actions: {
        deleteBoard(context, id) {
            axios.delete('/api/boards/' + id)
                .then(response => {
                    if (!response.data.success) {
                        return;
                    }
                    context.commit('deleteBoard', id);
                })
                .catch(() => {
                    this.dispatch('showModal', {
                        title: 'API Error',
                        message: 'Failed to delete board.'
                    })
                });
        },

        showCreateBoardOverlay(context, isVisible = true) {
            context.commit('showCreateBoardOverlay', isVisible);
        }
    }

}