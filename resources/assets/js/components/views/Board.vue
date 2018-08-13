<template>
    <section>

        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <div>
                        <p class="board-title">
                            <span>{{ board.name }}</span>
                            <dropdown-list class="is-dark">
                                <a href="#"
                                   class="dropdown-item"
                                   v-if="board.created_by === $store.state.users.user.id"
                                   @click.prevent="$store.commit('editBoard', board)">
                                    Edit
                                </a>

                                <a href="#"
                                   class="dropdown-item has-text-danger"
                                   v-if="board.created_by === $store.state.users.user.id"
                                   @click.prevent="$store.dispatch('destroyBoard', board)">
                                    Delete
                                </a>
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

                <div class="add-column">
                    <a class="button" title="Add column" @click.prevent="addColumn">
                        <i class="fa fa-columns"></i>&nbsp;
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>

            <!-- Render each swimlane -->
            <div class="swimlane" v-for="swimlane in board.swimlanes" :key="swimlane.id">
                <div class="columns">
                    <!-- Render each column -->
                    <swimlane-column v-for="column in board.columns"
                        :key="column.id"
                        :swimlane="swimlane"
                        :column="column" />

                    <div class="add-column-placeholder"></div>
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
        min-width: 180px;
        animation: fadeIn;
        animation-duration: 175ms;
    }

    .add-column {
        align-self: flex-start;
        width: 3.5rem;

        .fa {
            color: #bbb;
            transition: color 100ms linear;
        }

        &:hover {
            .fa {
                color: @color-blue;
            }
        }

        .fa-plus {
            font-size: .8rem;
        }

        .fa-columns {
            font-size: 1.15rem;
        }
    }

    .add-column-placeholder {
        align-self: flex-start;
        width: 3.5rem;
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
                const position = this.board.columns.length;

                // add blank column to model and toggle edit class
                this.board.columns.splice(position, 0, new Column({
                    id: null,
                    name: null,
                    position,
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
                    return this.goToFirstBoard();
                }

                document.title = `${board.name} • Voodu`;
            }
        },

        beforeMount() {
            // redirect if selected board doesn't exist
            if (!this.board) {
                this.goToFirstBoard();
                return;
            }

            document.title = `${this.board.name} • Voodu`;
        },

        components: {
            'dropdown-list': require('../Dropdown'),
            'column-header': require('../ColumnHeader'),
            'swimlane-column': require('../SwimlaneColumn'),
            draggable
        }
    }
</script>