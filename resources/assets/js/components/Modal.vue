<template>

    <div v-bind:class="{ 'modal': true, 'is-active': isActive }">
        <div class="modal-background"></div>

        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    {{ modalTitle }}
                </p>
                <button class="delete" aria-label="close" @click="isActive = false"></button>
            </header>

            <section class="modal-card-body">
                <slot>{{ message }}</slot>
            </section>

            <footer class="modal-card-foot">
                <button class="button is-success" @click="isActive = false">OK</button>
            </footer>
        </div>
    </div>

</template>

<script>

    export default {
        props: ['active', 'title'],

        data() {
            return {
                message: 'Default modal text',
                isActive: this.active,
                modalTitle: this.title || 'Default Modal Title'
            };
        },

        mounted() {
            Voodu.Events.$on('show-modal', this.handleShowModal);
        },

        methods: {
            handleShowModal(data = { title: null, message: null }) {
                this.modalTitle = data.title;
                this.message = data.message;
                this.isActive = true;
            }
        }
    }

</script>
