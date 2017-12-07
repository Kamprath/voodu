<template>

    <div :class="{ 'card': true, 'is-editing': isEditing }" @keyup.esc="cancel">
        <form v-if="isEditing" @submit.prevent="save">
            <!-- Edit name -->
            <textarea class="textarea edit-title is-autosize"
                      type="text"
                      placeholder="Enter a title"
                      autofocus
                      tabindex="1"
                      required
                      rows="2"
                      v-model="editData.name">
            </textarea>

            <div class="is-pulled-left">
                <a href="#" @click.prevent>Edit details</a>
            </div>

            <!-- Buttons -->
            <div class="is-pulled-right">
                <button class="button is-danger is-small" type="button" tabindex="5" @click="cancel">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <button class="button is-success is-small" type="submit" tabindex="4">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </div>

            <span class="is-clearfix"></span>
        </form>

        <div v-else>
            <dropdown-list class="is-dark">
                <a href="#" class="dropdown-item" @click.prevent="edit">Edit</a>
                <a href="#" class="dropdown-item has-text-danger" @click.prevent="destroy">Delete</a>
            </dropdown-list>

            <p>{{ model.name }}</p>

            <span class="created-at" :title="'Created ' + createdAt">{{ timeAgo }}</span>

        </div>
    </div>

</template>

<style lang="less" scoped>
    @import '../../less/colors.less';

    .card {
        font-size: 0.9rem;
        border-radius: 2px;
        padding: 0.4rem .75rem 1.1rem;
        min-height: 4.5rem;
        position: relative;
        margin-bottom: .3rem;

        &:hover .dropdown, .dropdown.is-active {
            opacity: 1;
        }

        &.is-editing {
            padding-bottom: .5rem;
        }
    }

    p {
        font-family: Lato, Helvetica, sans-serif;
    }

    a {
        line-height: 1.7rem;
    }

    .dropdown {
        opacity: 0;
        transition: opacity 150ms;
        position: absolute;
        top: .4rem;
        right: .5rem;
    }

    .created-at {
        position: absolute;
        bottom: .6rem;
        font-size: .75rem;
        line-height: .7rem;
        color: @color-gray-medium;
    }

    .textarea {
        resize: vertical;
        font-size: .9rem;
        font-family: Lato, Helvetica, sans-serif;
        margin-bottom: .4rem;
        min-height: 2.5rem;
    }
</style>

<script>
    import Card from '../models/Card.js';
    import moment from 'moment';
    import autosize from 'autosize';

    export default {

        data() {
            return {
                isEditing: !this.model.id,
                editData: {}
            }
        },

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

        methods: {
            save() {
                this.model.name = this.editData.name;
                this.isEditing = false;
                this.model.save();
            },

            edit() {
                this.editData = this.model.properties;
                this.isEditing = true;
            },

            cancel() {
                // trigger event for parent to handle if no ID (column created and then canceled)
                if (!this.model.id) {
                    this.$emit('removeCard', this.model);
                }

                this.isEditing = false;
            },

            destroy() {
                this.model.destroy(() => {
                    this.$emit('removeCard', this.model);
                });
            },
        },

        mounted() {
            if (this.isEditing) {
                document.querySelector('[autofocus]').focus();
            }
        },

        updated() {
            // automatically resize textarea
            this.$nextTick(() => {
                if (this.isEditing) {
                    autosize(document.querySelectorAll('.is-autosize'));
                }

                if (document.querySelector('[autofocus]')) {
                    document.querySelector('[autofocus]').focus();
                }
            })
        },

        components: {
            'dropdown-list': require('./Dropdown.vue')
        }

    }
</script>