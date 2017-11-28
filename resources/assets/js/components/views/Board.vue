<template>
    <section>

        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <div>
                        <p class="board-title">
                            <span>{{ board.name }}</span>
                            <dropdown-list class="is-dark">
                                <router-link :to="{ name: 'Edit Board', params: { id: $route.params.id }}" class="dropdown-item">Edit</router-link>
                                <a href="#" class="dropdown-item has-text-danger" @click.prevent="$store.dispatch('destroyBoard', board)">Delete</a>
                            </dropdown-list>
                        </p>
                        <p v-if="board.purpose" class="purpose">{{ board.purpose }}</p>
                    </div>
                </div>
            </div>

            <div class="level-right">
                <p class="level-item">
                    <a href="#" class="logout" @click.prevent="logout">Logout</a>
                </p>
            </div>
        </nav>

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
                color: #747474;
                vertical-align: middle;
            }
        }

        .dropdown-trigger a {
            font-size: .8rem;
        }
    }

    .purpose {
        color: #939393;
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
</style>

<script>
    export default {
        methods: {
            logout() {
                // make API call to logout action
                // redirect to login page
            },

            goToFirstBoard() {
                const firstBoard = this.$store.state.boards.models[0];
                this.$router.replace({
                    name: !firstBoard ? 'Welcome' : 'Board',
                    params: !firstBoard ? null : { id: firstBoard.id }
                });
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

        beforeMount() {
            if (!this.board) {
                this.goToFirstBoard();
            }
        },

        watch: {
            board(board) {
                if (!board) {
                    this.goToFirstBoard();
                }
            }
        },

        components: {
            'dropdown-list': require('../Dropdown.vue')
        }
    }
</script>