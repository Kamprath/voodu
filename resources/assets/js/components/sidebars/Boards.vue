<template>

    <div :class="{ 'sidebar': true, 'sidebar-boards': true, 'is-active': $store.getters.isSidebarOpen }">

        <!-- Close button -->
        <a href="#" class="close-sidebar" @click.prevent="$store.dispatch('hideSidebar')">
            <svg version="1.1"
                 xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px"
                 y="0px"
                 width="20px"
                 height="20px"
                 viewBox="0 0 357 357"
                 style="enable-background:new 0 0 357 357;opacity: .45;"
                 xml:space="preserve">
                <g>
                <polygon points="357,35.7 321.3,0 178.5,142.8 35.7,0 0,35.7 142.8,178.5 0,321.3 35.7,357 178.5,214.2 321.3,357 357,321.3 214.2,178.5"/>
                </g>
            </svg>
        </a>

        <h5 class="title is-5">Boards</h5>

        <!-- Create board link -->
        <a href="#" class="create-board" @click.prevent="$store.commit('toggleBoardOverlay', true)">
            <i class="fa fa-plus-circle is-dark"></i>
            <span>Create a board</span>
        </a>

        <!-- Public list -->
        <div v-if="publicBoards.length > 0">
            <label>TEAM</label>
            <ul>
                <li v-for="board in publicBoards">
                    <router-link :to="{ name: 'Board', params: { id: board.id }}" :title="board.purpose || board.name">
                        {{ board.name }}
                    </router-link>
                    <dropdown-list v-if="board.created_by === $store.state.users.user.id">
                        <a href="#" class="dropdown-item" @click.prevent="$store.commit('editBoard', board)">Edit</a>
                        <a href="#" class="dropdown-item has-text-danger" @click.prevent="destroy(board)">Delete</a>
                    </dropdown-list>
                </li>
            </ul>
        </div>

        <!-- Private list -->
        <div v-if="privateBoards.length > 0">
            <label>ME</label>
            <ul>
                <li v-for="board in privateBoards">
                    <router-link :to="{ name: 'Board', params: { id: board.id }}" :title="board.purpose || board.name">
                        {{ board.name }}
                    </router-link>
                    <dropdown-list v-if="board.created_by === $store.state.users.user.id">
                        <a href="#" class="dropdown-item" @click.prevent="$store.commit('editBoard', board)">Edit</a>
                        <a href="#" class="dropdown-item has-text-danger" @click.prevent="destroy(board)">Delete</a>
                    </dropdown-list>
                </li>
            </ul>
        </div>

    </div>

</template>

<style lang="less" scoped>

    @import '../../../less/colors.less';

    .sidebar {
        display: block;
        width: 250px;
        height: 100%;
        background-color: @color-gray-dark;
        padding: 1rem 1.25rem;
        transition: left 150ms ease-in-out;
        position: absolute;
        left: -250px;
        z-index: 10;

        &.is-active {
            left: 65px;
        }
    }

    .close-sidebar {
        font-size: 28px;
        position: absolute;
        right: 1rem;
        top: .45rem;
    }

    .title, .create-board, ul {
        margin-bottom: .8rem;
    }

    .title, .create-board {
        color: @color-white;
    }

    .create-board {
        display: inline-block;

        .fa, span {
            vertical-align: middle;
        }

        .fa {
            font-size: 1.3rem;
            margin-right: .2rem;
        }
    }

    label {
        font-size: .75rem;
        font-weight: bold;
        color: @primary;
    }

    ul {
        list-style-type: none;
    }

    li {
        position: relative;

        & > a {
            color: @color-gray-light;
            display: block;
            padding: .15rem .5rem;

            &:hover, &.is-active {
                color: @color-white;
            }

            &.is-active {
                font-weight: bold;
            }
        }
    }

    .dropdown {
        position: absolute;
        top: -4px;
        right: 0;
        bottom: 0;
        margin: auto;
        display: none;
    }

    li:hover .dropdown, .dropdown.is-active {
        display: inline;
    }

</style>

<script>

    import { mapActions } from 'vuex';

    export default {
        components: {
            'dropdown-list': require('../Dropdown.vue')
        },

        computed: {
            boards() {
                return this.$store.state.boards.models;
            },

            publicBoards() {
                return this.boards.filter(board => {
                    return board.is_public;
                });
            },

            privateBoards() {
                return this.boards.filter(board => {
                    return !board.is_public;
                });
            }
        },

        methods: {
            destroy(board) {
                if (!window.confirm('This board will be permanently removed' + (board.is_public ? ' for all users' : '') + '.'))
                    return;

                board.destroy(() => {
                    this.$store.commit('removeBoard', board);
                });
            }
        }
    }

</script>