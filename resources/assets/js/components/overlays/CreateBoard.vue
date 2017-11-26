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

                <!-- Name field -->
                <div class="field">
                    <label class="label">Name</label>
                    <p class="control">
                        <input class="input is-medium"
                               type="text"
                               placeholder="Enter a project, goal, or task"
                               tabindex="1"
                               v-model="name"
                               autofocus>
                        <div class="input-details">
                            Names must be shorter than 25 characters.
                        </div>
                    </p>
                </div>

                <!-- Purpose field -->
                <div class="field">
                    <label class="label">Purpose</label>
                    <p class="control">
                        <input class="input is-medium"
                               type="text"
                               placeholder="(Optional)"
                               tabindex="2"
                               v-model="purpose"
                               autofocus>
                        <div class="input-details">
                            What is this board used for?
                        </div>
                    </p>
                </div>

                <!-- Visibility field -->
                <div class="field">
                    <label class="label">Visibility</label>
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="visibility" value="public" v-model="visibility" checked>
                            &nbsp;Public
                        </label>
                        <label class="radio">
                            <input type="radio" name="visibility" value="private" v-model="visibility">
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

                <div class="field is-grouped is-pulled-right">
                    <div class="control">
                        <button type="button"
                                class="button is-medium is-text"
                                @click="hide">
                            Cancel
                        </button>
                    </div>
                    <div class="control">
                        <button type="submit" class="button is-medium is-secondary">
                            Create Board
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>

</template>

<style lang="less" scoped>
    @import '../../../less/overlay.less';
</style>

<script>

    export default {

        data() {
            return {
                name: null,

                purpose: null,

                visibility: 'public'
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
            }
        }

    }

</script>