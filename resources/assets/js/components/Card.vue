<template>

    <div class="card">
        <dropdown-list class="is-dark">
            <a href="#" class="dropdown-item" @click.prevent>Edit card</a>
            <a href="#" class="dropdown-item has-text-danger" @click.prevent>Delete</a>
        </dropdown-list>

        <p>{{ model.name }}</p>

        <span class="created-at" :title="'Created ' + createdAt">{{ timeAgo }}</span>
    </div>

</template>

<style lang="less" scoped>
    @import '../../less/colors.less';

      .card {
        font-size: 0.9rem;
        font-family: Lato, Helvetica, sans-serif;
        border-radius: 2px;
        padding: 0.4rem .75rem 1.1rem;
        min-height: 4.5rem;
        position: relative;

        .dropdown {
          opacity: 0;
          transition: opacity 150ms;
          position: absolute;
          top: .4rem;
          right: .5rem;
        }

        &:hover .dropdown, .dropdown.is-active {
          opacity: 1;
        }

        .created-at {
          position: absolute;
          bottom: .6rem;
          font-size: .75rem;
          line-height: .7rem;
          color: @color-gray-medium;
        }
    }
</style>

<script>
    import Card from '../models/Card.js';
    import moment from 'moment';

    export default {

        props: {
            model: {
                type: Card,
                default: new Card
            },
        },

        computed: {
            createdAt() {
                return moment(this.model.created_at).format('dddd, MMMM Do YYYY, h:mm a');
            },

            timeAgo() {
                return moment(this.model.created_at).fromNow();
            }
        },

        components: {
            'dropdown-list': require('./Dropdown.vue')
        }

    }
</script>