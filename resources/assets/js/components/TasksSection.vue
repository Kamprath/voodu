<template>

    <section id="tasks">

        <nav-bar :routes="routes" />

        <div class="section">
            <task-list />
        </div>

    </section>

</template>

<script>

    export default {

        data() {
            return {
                routes: [
                    { name: 'Dashboard', path: '/' },
                    { name: 'Tasks', path: '/tasks' }
                ]
            }
        },

        components: {
            'task-list': require('./TaskList.vue'),
            'nav-bar': require('./NavBar.vue')
        }

    }

</script>