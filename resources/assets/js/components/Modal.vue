<template>

    <div v-bind:class="{ 'modal': true, 'is-active': active }">
        <div class="modal-background"></div>

        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    {{ title }}
                </p>
                <button class="delete" aria-label="close"></button>
            </header>

            <section class="modal-card-body">
                <slot></slot>
            </section>

            <footer class="modal-card-foot">
                <button class="button is-success">Save changes</button>
                <button class="button">Cancel</button>
            </footer>
        </div>
    </div>

</template>

<script>

    export default {
        props: ['active', 'title']
    }

</script>
