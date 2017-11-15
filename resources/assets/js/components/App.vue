<template>
    <div class="container">
        <modal></modal>
        <router-view />
    </div>
</template>

<script>
    import Modal from './Modal.vue';

    export default {
        components: {
            Modal
        }
    }
</script>