<template>

    <nav class="navbar is-transparent">

        <div class="navbar-brand">
            <a class="navbar-item" href="https://bulma.io">
                <img src="https://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
            </a>
        </div>

        <div id="navbarExampleTransparentExample" class="navbar-menu">
            <div class="navbar-start">
                <router-link v-for="route in routes" :key="route.name" class="navbar-item" :to="route.path" exact>
                    {{ route.name }}
                </router-link>
            </div>
        </div>

    </nav>

</template>

<script>

    export default {

        methods: {
            isActive(path) {
                return this.$route.path === path;
            }
        },

        props: ['routes']

    }

</script>