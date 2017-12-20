<template>

    <nav :class="{ 'is-sidebar-open': $store.getters.isSidebarOpen }">
        <div class="nav-content">
            <team-avatar />

            <a href="#" :class="{ 'is-active': isBoardSelected, 'is-selected': $store.state.app.isBoardsActive }" @click="toggleBoards">
                <i class="fa fa-columns fa-2x" aria-hidden="true"></i>
            </a>

            <router-link to="/queue">
                <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
            </router-link>

            <a href="#" class="button-search">
                <i class="fa fa-search fa-2x" aria-hidden="true"></i>
            </a>

            <!--<a href="#" class="button-add">
                <i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i>
            </a>-->

            <figure class="avatar avatar-user">
                <img src="http://lorempizza.com/35/35">
            </figure>
        </div>

        <boards-sidebar />
    </nav>

</template>

<style lang="less" scoped>
    @import "../../less/colors.less";

    .nav-content {
        width: 65px;
        border-right: 1px solid #373B40;
        background-color: @color-gray-darker;
        display: block;
        height: 100%;
        float: left;
        position: relative;
        z-index: 100;
        text-align: center;
        padding: .5rem 0;
    }

    nav {
        height: 100%;
        position: fixed;
        left: 0;
        z-index: 100;

        a {
            display: block;
            text-align: center;
            padding: 10px;
            color: @color-gray-medium;
            font-size: .8em;

            &:first-of-type {
                margin-top: .25rem;
            }

            &.is-active .fa {
                color: @primary;
            }

            &:not(.is-active):hover, &.is-selected {
                .fa {
                    color: @color-white;
                }
            }
        }

        .avatar {
            text-align: center;
            margin: .5rem 0 .25rem;

            img {
                width: 40px;
                height: 40px;
            }

            &-user {
                position: absolute;
                bottom: 5px;
                right: 0;
                left: 0;
                margin: auto;

                img {
                    width: 35px;
                    height: 35px;
                }
            }
        }
    }

    .is-sidebar-open a:not(.is-selected) {
        opacity: .5;
    }

    .button-add .fa {
        color: @color-black;
    }

</style>

<script>

    import { mapActions, mapState } from 'vuex';

    export default {
        methods: {
            toggleBoards(e) {
                e.preventDefault();

                this.$store.dispatch('toggleBoards');
            }
        },

        computed: {
            isBoardSelected() {
                return this.$route.name === 'Board';
            }
        },

        components: {
            'boards-sidebar': require('./sidebars/Boards'),
            'team-avatar': require('./TeamAvatar')
        }
    }

</script>