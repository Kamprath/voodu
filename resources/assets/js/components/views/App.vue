<template>

    <div>
        <modal-view />

        <transition name="fade">
            <create-board-overlay />
        </transition>

        <transition name="fade">
            <create-team-overlay />
        </transition>

        <nav-bar />

        <div :class="{ 'wrapper': true, 'sidebar-open': $store.getters.isSidebarOpen }">
            <div class="shade"></div>
            <router-view />
        </div>
    </div>

</template>

<script>

    export default {
        components: {
            'modal-view': require('../Modal.vue'),
            'nav-bar': require('../NavBar.vue'),
            'create-board-overlay': require('../overlays/CreateBoard'),
            'create-team-overlay' : require('../overlays/CreateTeam')
        }
    }

</script>