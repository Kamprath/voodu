<template>

    <section v-if="isVisible"
             class="hero is-info is-bold is-fullheight overlay overlay-create-board"
             @keyup.esc="hide">

        <div class="hero-body">

            <!-- Close button -->
            <a href="#" class="close-overlay" @click.prevent="hide">
                <i class="fa fa-times fa-2x is-dark" aria-hidden="true"></i>
                <span>esc</span>
            </a>

            <div class="container">
                <h1 class="title">
                    {{ titleText }}
                </h1>

                <p>Boards allow your team to visually organize tasks and track progress. They’re best when used to track related work.</p>

                <form action="/api/boards" method="post" @submit.prevent="submit">
                    <!-- Name field -->
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control">
                            <input :class="{ 'input': true, 'is-medium': true, 'is-danger has-text-danger': isNameTaken }"
                                   type="text"
                                   placeholder="Enter a project, goal, or task"
                                   tabindex="1"
                                   maxlength="26"
                                   v-model="board.name"
                                   required
                                   autofocus>
                            <div v-if="isNameTaken" class="input-details">
                                That name is already taken.
                            </div>
                            <div v-else class="input-details">
                                Names must be shorter than 26 characters.
                            </div>
                        </div>
                    </div>

                    <!-- Purpose field -->
                    <div class="field">
                        <label class="label">Purpose</label>
                        <div class="control">
                            <input class="input is-medium"
                                   type="text"
                                   placeholder="(Optional)"
                                   tabindex="2"
                                   v-model="board.purpose">
                            <div class="input-details">
                                What is this board used for?
                            </div>
                        </div>
                    </div>

                    <!-- Visibility field -->
                    <div class="field">
                        <label class="label">Visibility</label>
                        <div class="control">
                            <label class="radio">
                                <input type="radio"
                                       name="is_public"
                                       value="1"
                                       v-model.number="board.is_public"
                                       tabindex="3"
                                       checked>
                                &nbsp;Public
                            </label>
                            <label class="radio">
                                <input type="radio"
                                       name="is_public"
                                       value="0"
                                       v-model.number="board.is_public"
                                       tabindex="4">
                                &nbsp;Private
                            </label>
                            <div v-if="parseInt(board.is_public) === 1" class="input-details">
                                Everyone on your team can access this board.
                            </div>
                            <div v-else class="input-details">
                                Only you can see this board. Other members must be invited.
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="field is-grouped is-pulled-right">
                        <div class="control">
                            <button type="button"
                                    class="button is-medium is-text"
                                    @click="hide">
                                Cancel
                            </button>
                        </div>
                        <div class="control">
                            <button type="submit"
                                    :class="{ 'button': true, 'is-medium': true, 'is-secondary': true, 'is-loading': isLoading }"
                                    :disabled="isLoading || isNameTaken">
                                {{ buttonText }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </section>

</template>

<style lang="less" scoped>
    @import '../../../less/overlay.less';
</style>

<script>
    import Board from '../../models/Board.js';
    import Swimlane from '../../models/Swimlane';
    import autofocus from '../../autofocus.js';
    import objectsToModels from '../../objectsToModels';

    export default {

        data() {
            return {
                isLoading: false
            };
        },

        computed: {
            board: {
                get() {
                    return this.$store.state.boards.editModel;
                },

                set(board) {
                    this.$store.commit('setEditBoard', board);
                }
            },

            /**
             * Get names of all boards
             * A computed property is used to cache this value so the function isn't executed on each keyup
             * @returns {Array} Returns board names as an array of strings
             */
            names() {
                let names = [];

                this.$store.state.boards.models.forEach(model => {
                    names.push(model.name.toLowerCase());
                });

                return names;
            },

            /**
             * Indicates if board name already exists
             * @returns {boolean}
             */
            isNameTaken() {
                if (!this.board.name || this.board.id) {
                    return false;
                }
                return this.names.includes(this.board.name.toLowerCase());
            },

            isVisible() {
                return this.$store.state.boards.isCreateOverlayActive;
            },

            isEditing() {
                return this.board.id !== null;
            },

            buttonText() {
                return this.isEditing ? 'Update Board' : 'Create Board';
            },

            titleText() {
                return this.isEditing ? 'Edit board' : 'Create a board'
            }
        },

        methods: {
            hide() {
                this.reset();
                this.$store.commit('toggleBoardOverlay', false);
            },

            reset() {
                this.$store.commit('setEditBoard', new Board({ is_public: 1 }));
                this.isLoading = false;
            },

            submit() {
                this.isLoading = true;
                // check for absence of ID before API request because ID will be set on create
                const newBoard = !this.board.id;

                this.board.save(data => {
                    if (!newBoard) {
                        this.hide();
                        return;
                    }

                    // convert swimlane data to model
                    if (data.hasOwnProperty('swimlanes')) {
                        data.swimlanes = objectsToModels(data.swimlanes, Swimlane);
                    }

                    this.$store.commit('addBoard', new Board(data));
                    this.hide();
                    this.$router.push({ name: 'Board', params: { id: data.id }});
                });
            }
        },

        updated() {
            this.$nextTick(() => {
                autofocus();
            });
        }

    }
</script>