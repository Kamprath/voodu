<template>

    <div>
        <nav-bar />

        <div class="wrapper">
            <router-view />
        </div>
    </div>

</template>

<script>

    export default {
        components: {
            'nav-bar': require('./NavBar.vue')
        }
    }

</script>