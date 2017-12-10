import bootstrapped from '../bootstrapped.js';
import Board from '../models/Board.js';
import Column from '../models/Column.js';
import Swimlane from '../models/Swimlane.js';
import Card from '../models/Card.js';
import axios from 'axios';

export default {

    state: {
        models: bootstrapped.models('boards', Board, {
            columns: Column,
            swimlanes: Swimlane,
            cards: Card
        }) || [],
        isCreateOverlayActive: false,
        updateQueue: []
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
        },

        /**
         * Update swimlane cards
         * @param {object} state
         * @param {array} payload     Object containing swimlane and array of cards
         */
        updateCards(state, payload) {
            const cards = payload.cards || [];
            const swimlane = payload.swimlane;

            if (!swimlane) {
                throw new Error('Payload does not contain a swimlane.');
                return;
            }

            const updatedIds = [],
                updatedCards = [];

            // get IDs of updated cards
            cards.forEach(card => {
                updatedIds.push(card.id);
            });

            // find board
            for (let x in state.models) {
                if (state.models[x].id === swimlane.board_id) {
                    // find swimlane
                    for (let y in state.models[x].swimlanes) {
                        if (state.models[x].swimlanes[y].id === swimlane.id) {
                            // copy all other cards into new array
                            for (let z in state.models[x].swimlanes[y].cards) {
                                if (!updatedIds.includes(state.models[x].swimlanes[y].cards[z].id)) {
                                    updatedCards.push(state.models[x].swimlanes[y].cards[z]);
                                }
                            }

                            // combine arrays and update store
                            state.models[x].swimlanes[y].cards = updatedCards.concat(cards);
                            return;
                        }
                    }
                }
            }
        },

        /**
         * Add cards to update queue
         * @param state
         * @param cards
         */
        queue(state, cards) {
            state.updateQueue = state.updateQueue.concat(cards);
        },

        /**
         * Clear update queue
         * @param state
         */
        clearQueue(state) {
            state.updateQueue = [];
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
        },

        updateCards(context, payload) {
            context.commit('updateCards', payload);

            // set timeout for a closure that sends API request containing updateQueue data
            if (!context.state.updateQueue.length) {
                setTimeout(() => {
                    axios.post('/api/cards/update', context.state.updateQueue)
                        .then(response => {
                            context.commit('clearQueue');
                        });
                }, 25);
            }

            // add cards to update queue
            context.commit('queue', payload.cards);
        }
    }

}