<template>

    <div>
        <modal-view />

        <nav-bar />

        <div :class="{ 'wrapper': true, 'sidebar-open': $store.getters.isSidebarOpen }">
            <router-view />
        </div>
    </div>

</template>

<script>

    export default {
        components: {
            'modal-view': require('../Modal.vue'),
            'nav-bar': require('../NavBar.vue')
        }
    }

</script>