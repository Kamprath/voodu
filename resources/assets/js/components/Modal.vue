<template>

    <div v-bind:class="{ 'modal': true, 'is-active': isActive }">
        <div class="modal-background"></div>

        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    {{ title }}
                </p>
                <button class="delete" aria-label="close" @click="hideModal"></button>
            </header>

            <section class="modal-card-body">
                <slot>{{ message }}</slot>
            </section>

            <footer class="modal-card-foot">
                <button class="button is-primary" @click="hideModal">OK</button>
            </footer>
        </div>
    </div>

</template>

<script>

    import { mapState, mapActions } from 'vuex';

    export default {
        computed: mapState({
            'isActive': state => state.app.modal.isActive,
            'title': state => state.app.modal.title,
            'message': state => state.app.modal.message
        }),

        methods: mapActions([
            'hideModal'
        ]),

        mounted() {
            document.addEventListener('keyup', function(e) {
                if (e.keyCode !== 27 || !this.$store.state.app.modal.isActive) {
                    return;
                }

                this.hideModal(this.$store.state);
            }.bind(this))
        }
    }

</script>
