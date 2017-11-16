<template>

    <section id="tasks">

        <nav-bar :routes="routes" />

        <div class="section">
            <task-list />
        </div>

    </section>

</template>

<script>

    import { mapState } from 'vuex';

    export default {

        computed: mapState({
            routes: state => state.dashboard.routes
        }),

        components: {
            'task-list': require('./TaskList.vue'),
            'nav-bar': require('./NavBar.vue')
        }

    }

</script>