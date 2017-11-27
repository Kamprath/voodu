<template>

    <section v-if="$store.state.boards.isCreateOverlayActive"
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
                            <input class="input is-medium"
                                   type="text"
                                   placeholder="Enter a project, goal, or task"
                                   tabindex="1"
                                   maxlength="26"
                                   v-model="name"
                                   required
                                   autofocus>
                            <div class="input-details">
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
                                   v-model="purpose"
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
                                       name="visibility"
                                       value="public"
                                       v-model="visibility"
                                       tabindex="3"
                                       checked>
                                &nbsp;Public
                            </label>
                            <label class="radio">
                                <input type="radio"
                                       name="visibility"
                                       value="private"
                                       v-model="visibility"
                                       tabindex="4">
                                &nbsp;Private
                            </label>
                            <div v-if="visibility ==='public'" class="input-details">
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
                                    :disabled="isLoading">
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
    import Board from '../../../models/Board.js';

    export default {

        data() {
            return {
                name: null,
                purpose: null,
                visibility: 'public',
                isLoading: false
            };
        },

        methods: {
            hide() {
                this.reset();
                this.$store.dispatch('showCreateBoardOverlay', false);
            },

            reset() {
                this.name = null;
                this.purpose = null;
                this.visibility = 'public';
                this.isLoading = false;
            },

            submit() {
                this.isLoading = true;

                const data = {
                    name: this.name,
                    purpose: this.purpose,
                    visibility: this.visibility
                };

                (new Board(data))
                    .create(model => {
                        this.isLoading = false;
                        this.$store.dispatch('addBoard', model);
                    });
            }
        }

    }
</script>