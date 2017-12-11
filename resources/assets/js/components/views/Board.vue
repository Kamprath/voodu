<template>
    <section>

        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <div>
                        <p class="board-title">
                            <span>{{ board.name }}</span>
                            <dropdown-list class="is-dark">
                                <router-link :to="{ name: 'Edit Board', params: { id: $route.params.id }}" class="dropdown-item">Edit board</router-link>
                                <a href="#" class="dropdown-item" @click.prevent="addColumn">Add column</a>
                                <a href="#" class="dropdown-item has-text-danger" @click.prevent="$store.dispatch('destroyBoard', board)">Delete</a>
                            </dropdown-list>
                        </p>
                        <p v-if="board.purpose" class="purpose">{{ board.purpose }}</p>
                    </div>
                </div>
            </div>

            <div class="level-right is-hidden-mobile">
                <p class="level-item">
                    <a href="/logout" class="logout">Logout</a>
                </p>
            </div>
        </nav>

        <div class="container">
            <div v-if="!board.columns || !board.columns.length" class="message-no-columns has-text-centered">
                <p>No columns have been added to this board yet.</p>
                <button class="button is-primary" @click="addColumn">Add a column</button>
            </div>

            <!-- Render column headers -->
            <div v-else class="columns">
                <column-header v-for="column in board.columns"
                    @removeColumn="board.removeRelated('columns', column)"
                    @updatePositions="updateColumnPositions"
                    :model="column"
                    :key="column.id" />
            </div>

            <!-- Render each swimlane -->
            <div class="swimlane" v-for="swimlane in board.swimlanes" :key="swimlane.id">
                <div class="columns">
                    <!-- Render each column -->
                    <swimlane-column v-for="column in board.columns"
                        :key="column.id"
                        v-if="column.id"
                        :swimlane="swimlane"
                        :column="column" />
                </div>
            </div>
        </div>

    </section>
</template>

<style lang="less" scoped>
    @import '../../../less/colors.less';

    nav {
        padding: .5rem 1.5rem;
        background-color: @color-white;
        box-shadow: 0 3px 1px rgba(136, 136, 136, 0.16);
    }

    .board-title {
        line-height: 1rem;

        span {
            verticali-align: top;
            &:first-child {
                font-weight: bold;
                color: @color-gray-dark;
                vertical-align: middle;
            }
        }

        .dropdown-trigger a {
            font-size: .8rem;
        }
    }

    .purpose {
        color: @color-gray-dark;
        font-family: Lato, helvetica, sans-serif;
        line-height: .9rem;
        font-size: .8rem;
    }

    .logout {
        font-size: .9rem;
        color: @color-gray-medium;

        &:hover {
            color: @color-red;
        }
    }

    .container {
        position: relative;
        margin-top: 1rem;
        margin-bottom: 2rem;
    }

    .message-no-columns {
        margin-top: 4rem;

        p {
            color: @color-gray-dark;
        }

        .button {
            margin-top: .6rem;
        }
    }

    .columns {
        width: 95%;
        margin: auto;
    }

    .column {
        max-width: 33%;
    }
</style>

<script>
    import axios from 'axios';
    import draggable from 'vuedraggable';
    import Column from '../../models/Column';

    export default {
        methods: {
            /**
             * Navigate to the first board
             */
            goToFirstBoard() {
                const firstBoard = this.$store.state.boards.models[0];
                this.$router.replace({
                    name: !firstBoard ? 'Welcome' : 'Board',
                    params: !firstBoard ? null : { id: firstBoard.id }
                });
            },

            addColumn() {
                // add blank column to model and toggle edit class
                this.board.columns.splice(0, 0, new Column({
                    id: null,
                    name: 'New Column',
                    position: 0,
                    board_id: this.board.id
                }));
            },

            updateColumnPositions() {
                let positions = {};

                // build object mapping column ID to position
                for (let i in this.board.columns) {
                    positions[this.board.columns[i].id] = this.board.columns[i].position;
                }

                // submit API request
                axios.post('/api/columns/positions/' + this.board.id, positions);
            }
        },

        computed: {
            /**
             * Get Board specified by ID in the route
             */
            board() {
                let models = this.$store.state.boards.models;
                const routeId = parseInt(this.$route.params.id);
                for (let i in models) {
                    if (models[i].id === routeId) {
                        return models[i];
                    }
                }
            }
        },

        watch: {
            /**
             * Redirect if active board is deleted
             * @param board
             */
            board(board) {
                if (!board) {
                    this.goToFirstBoard();
                }
            }
        },

        beforeMount() {
            // redirect if selected board doesn't exist
            if (!this.board) {
                this.goToFirstBoard();
            }
        },

        components: {
            'dropdown-list': require('../Dropdown'),
            'column-header': require('../ColumnHeader'),
            'swimlane-column': require('../SwimlaneColumn'),
            draggable
        }
    }
</script>