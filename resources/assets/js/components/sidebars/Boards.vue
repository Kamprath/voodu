<template>

    <div class="sidebar sidebar-boards">

        <a href="#" class="close-sidebar" @click.prevent="$store.dispatch('hideSidebar')">
            <i class="fa fa-times fa-2x" aria-hidden="true"></i>
        </a>

        <h3>Boards</h3>

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

</template>

<style lang="less" scoped>

    .sidebar {
        display: block;
        float: left;
        width: 250px;
        height: 100%;
    }

    .dropdown {
        position: absolute;
        right: 0;
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