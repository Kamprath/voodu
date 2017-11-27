import bootstrapped from '../bootstrapped.js';
import axios from 'axios';
import Board from '../../models/Board.js';

export default {

    state: {
        models: bootstrapped.models('boards', Board) || [],
        isCreateOverlayActive: false
    },

    mutations: {
        deleteBoard(state, id) {

        },

        showCreateBoardOverlay(state, isVisible = true) {
            state.isCreateOverlayActive = isVisible;
        },

        addBoard(state, model) {
            state.models.push(model);
        }
    },

    actions: {
        deleteBoard(context, id) {
            axios.delete('/api/boards/' + id)
                .then(response => {
                    if (!response.data.success) { return; }
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
        },

        addBoard(context, model) {
            context.commit('addBoard', model);
        }
    }

}