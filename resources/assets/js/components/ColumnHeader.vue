<template>
    <div class="column" :style="style">
        <h6 class="title is-6"><slot></slot></h6>
        <dropdown-list class="is-light">
            <a href="#" class="dropdown-item" @click.prevent="rename">Rename</a>
            <a href="#" class="dropdown-item" @click.prevent="moveLeft">Move left</a>
            <a href="#" class="dropdown-item" @click.prevent="moveRight">Move right</a>
            <a href="#" class="dropdown-item has-text-danger" @click.prevent="$store.dispatch('destroyColumn', model)">Delete</a>
        </dropdown-list>
    </div>
</template>

<style scoped>
    .column {
        padding: .3rem;
        margin: .25rem;
        text-align: center;
    }
    .title {
    color: white;
    display: inline;
    }
    .title, .dropdown {
        vertical-align: middle;
    }
</style>

<script>
    export default {
        props: ['model'],

        computed: {
            style() {
                return !this.model.color ? '' : 'background-color: #' + this.model.color;
            }
        },

        components: {
            'dropdown-list': require('./Dropdown.vue'),
        }
    }
</script>