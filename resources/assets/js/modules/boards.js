import bootstrapped from '../bootstrapped.js';
import Board from '../models/Board.js';
import Column from '../models/Column.js';

export default {

    state: {
        models: bootstrapped.models('boards', Board, { columns: Column }) || [],
        isCreateOverlayActive: false
    },

    mutations: {
        showCreateBoardOverlay(state, isVisible = true) {
            state.isCreateOverlayActive = isVisible;
        },

        /**
         * Add a new board
         * @param state
         * @param {Board} board
         */
        addBoard(state, board) {
            state.models.push(board);
        },

        /**
         * Remove a board
         * @param state
         * @param {Board} board
         */
        removeBoard(state, board) {
            state.models.splice(state.models.indexOf(board), 1);
        },

        /**
         * Update the array position of a column in its board to match column's position field
         * @param state
         * @param {Column} column
         */
        updateColumnPosition(state, column) {
            let board;
            let boardPosition;
            let newColumns = [];

            for (let i in state.models) {
                if (state.models[i].id === column.board_id) {
                    board = state.models[i];
                    boardPosition = i;
                    break;
                }
            }

            if (!board) {
                return;
            }

            // iterate through board.columns and remove column that matches column
            for (let i in board.columns) {
                if (board.columns[i] === column) {
                    board.columns.splice(i, 1);
                    break;
                }
            }

            // insert column at new position
            board.columns.splice(column.position, 0, column);

            // update positions of all columns
            for (let i in board.columns) {
                board.columns[i].position = parseInt(i);
                newColumns[board.columns[i].position] = board.columns[i];
            }

            state.models[boardPosition].columns = newColumns;
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