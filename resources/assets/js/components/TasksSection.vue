<template>

    <section id="tasks">

        <div class="section">
            <task-list />
        </div>

    </section>

</template>

<script>

    import { mapState } from 'vuex';

    export default {

        components: {
            'task-list': require('./TaskList.vue')
        }

    }

</script>