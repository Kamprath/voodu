<template>

    <div class="container">
        <modal></modal>
        <router-view />
    </div>

</template>

<script>

    export default {
        components: {
            'modal': require('./Modal.vue')
        }
    }

</script>