import bootstrapped from '../bootstrapped.js';
import Board from '../../models/Board.js';

export default {

    state: {
        models: bootstrapped.models('boards', Board) || [],
        isCreateOverlayActive: false
    },

    mutations: {
        showCreateBoardOverlay(state, isVisible = true) {
            state.isCreateOverlayActive = isVisible;
        },

        addBoard(state, model) {
            state.models.push(model);
        },

        removeBoard(state, board) {
            state.models.splice(state.models.indexOf(board), 1);
        }
    },

    actions: {
        showCreateBoardOverlay(context, isVisible = true) {
            context.commit('showCreateBoardOverlay', isVisible);
        },

        destroyBoard(context, board) {
            board.destroy(() => {
                context.commit('removeBoard', board);
            });
        }
    }

}