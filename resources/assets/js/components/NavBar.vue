<template>

    <nav id="nav-sidebar">
        <figure class="avatar">
            <img src="http://lorempizza.com/40/40">
        </figure>

        <a href="#" :class="{ 'is-active': isBoards }">
            <i class="fa fa-columns fa-2x" aria-hidden="true"></i>
        </a>

        <router-link to="/queue">
            <i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
        </router-link>

        <a href="#" class="button-search">
            <i class="fa fa-search fa-2x" aria-hidden="true"></i>
        </a>

        <a href="#" class="button-add color-black">
            <i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i>
        </a>

        <figure class="avatar avatar-user">
            <img src="http://lorempizza.com/35/35">
        </figure>
    </nav>

</template>

<style lang="less" scoped>
<style lang="less" scoped>
    @import "../../less/colors.less";

    #nav-sidebar {
        height: 100%;
        width: 65px;
        position: fixed;
        left: 0;
        background-color: @color-gray-darker;
        border-right: 1px solid #373B40;

        a {
            display: block;
            text-align: center;
            padding: 10px;
            color: @color-gray-medium;
            font-size: .8em;

            &:hover {
                color: @color-gray-lightest;
            }
        }

        .avatar {
            display: block;
            text-align: center;
            margin: 10px 0 5px;

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
</style>

<script>

    import { mapState } from 'vuex';

    export default {
        computed: {
            isBoards() {
                return this.$store.state.app.section === 'boards';
            }
        }
    }

</script>