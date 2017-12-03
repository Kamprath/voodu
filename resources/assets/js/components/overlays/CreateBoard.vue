<template>

    <section v-if="show"
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
                    Create a board
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
                                   v-model="board.purpose"
                                   autofocus>
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
                                Create Board
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

    export default {

        data() {
            return {
                board: new Board({ is_public: 1 }),
                isLoading: false
            };
        },

        computed: {
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
                if (!this.board.name) {
                    return false;
                }
                return this.names.includes(this.board.name.toLowerCase());
            },

            show() {
                return this.$store.state.boards.isCreateOverlayActive;
            }
        },

        methods: {
            hide() {
                this.reset();
                this.$store.dispatch('showCreateBoardOverlay', false);
            },

            reset() {
                this.board = new Board({ is_public: 1 });
                this.isLoading = false;
            },

            submit() {
                this.isLoading = true;

                this.board.create(data => {
                    this.$store.commit('addBoard', new Board(data));
                    this.hide();
                    this.$router.push({ name: 'Board', params: { id: data.id }});
                });
            }
        }

    }
</script>