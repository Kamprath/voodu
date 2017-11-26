<template>

    <div class="sidebar sidebar-boards">

        <a href="#" class="close-sidebar" @click.prevent="$store.dispatch('hideSidebar')">
            <i class="fa fa-times is-dark" aria-hidden="true"></i>
        </a>

        <h5 class="title is-5">Boards</h5>

        <a href="#" class="create-board" @click.prevent="$store.dispatch('showCreateBoardOverlay')">
            <i class="fa fa-plus-circle is-dark"></i>
            <span>Create a board</span>
        </a>

        <div>
            <label>TEAM</label>
            <ul>
                <li>
                    <router-link to="/board/6">Test</router-link>
                    <dropdown-list>
                        <router-link to="/board/6/edit" class="dropdown-item">Edit</router-link>
                        <a href="#" class="dropdown-item" @click.prevent="deleteBoard(6)">Delete</a>
                    </dropdown-list>
                </li>
            </ul>

            <label>ME</label>
            <ul>
            </ul>
        </div>

    </div>

</template>

<style lang="less" scoped>

    @import '../../../less/colors.less';

    .sidebar {
        display: block;
        float: left;
        width: 250px;
        height: 100%;
        background-color: @color-gray-dark;
        border-right: 1px solid #373B40;
        padding: 1rem 1.25rem;
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
        top: 0;
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

        methods: mapActions([
            'deleteBoard'
        ])
    }

</script>