<template>

    <section id="tasks" class="section">
        <TaskList />
    </section>

</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
</style>

<script>
    import TaskList from './TaskList';

    export default {
        components: {
            TaskList
        }
    }
</script>