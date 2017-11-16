<template>

    <div class="container">

        <modal></modal>

        <nav-bar></nav-bar>

        <router-view />
        
    </div>

</template>

<script>

    export default {
        components: {
            'modal': require('./Modal.vue'),
            'nav-bar': require('./NavBar.vue')
        }
    }

</script>