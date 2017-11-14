<template>

    <section id="tasks">

        <nav-bar :routes="routes" />

        <div class="section">
            <TaskList />
        </div>

    </section>

</template>

<script>
    import TaskList from './TaskList';
    import NavBar from './NavBar';

    export default {

        data() {
            return {
                routes: [
                    { name: 'Dashboard', path: '/' },
                    { name: 'Tasks', path: '/tasks' }
                ]
            }
        },

        components: { TaskList, NavBar }
    }
</script>