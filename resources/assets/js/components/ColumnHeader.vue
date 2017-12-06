<template>
    <div class="column" :style="style">
        <form v-if="isEditing" @keyup.esc="cancel" @submit.prevent="save">
            <input class="input" type="text" placeholder="Enter a title" autofocus tabindex="1" required v-model="editData.name">
            <textarea class="textarea" placeholder="Enter a description (optional)" tabindex="2" rows="2" v-model="editData.description"></textarea>

            <div class="is-pulled-left">
                <label class="label is-small label-color">
                    <span>Color</span>
                    <input class="input is-small column-color" type="text" tabindex="3" placeholder="Hex value" v-model="editData.color" maxlength="6">
                </label>
            </div>
            <div class="is-pulled-right">
                <button class="button is-danger is-small" type="button" tabindex="5" @click="cancel">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <button class="button is-success is-small" type="submit" tabindex="4">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </button>
            </div>
        </form>

        <div v-else>
            <h6 class="title is-6"><slot></slot></h6>
            <dropdown-list class="is-light">
                <a href="#" class="dropdown-item" @click.prevent="edit">Edit</a>
                <a href="#" class="dropdown-item" @click.prevent="moveColumn(false)">Move left</a>
                <a href="#" class="dropdown-item" @click.prevent="moveColumn(true)">Move right</a>
                <a href="#" class="dropdown-item has-text-danger" @click.prevent="destroy">Delete</a>
            </dropdown-list>
        </div>
    </div>
</template>

<style lang="less" scoped>
    @import '../../less/colors.less';

    .column {
        padding: .3rem;
        margin: .25rem;
        text-align: center;
        align-self: flex-start;
        border-radius: 2px;
        background-color: @color-gray-dark;
    }
    .title {
        color: white;
        display: inline;
        font-size: .95rem;
    }
    .title, .dropdown {
        vertical-align: middle;
    }
    .input {
        display: inline;
    }
    .input, .textarea {
        padding: .25rem .5rem;
    }
    .textarea {
        margin: .25rem 0;
        font-size: .9rem;
        line-height: 1.1rem;
    }
    .label-color {
        span {
            color: #fff;
            margin: 0 .25rem;
        }
        span, .input {
            vertical-align: middle;
        }
        .input {
            width: 4rem;
        }
    }
</style>

<script>
    export default {
        props: ['model'],

        data() {
            return {
                isEditing: !this.model.id,
                editData: {}
            }
        },

        computed: {
            style() {
                return !this.model.color ? '' : 'background-color: #' + this.model.color;
            }
        },

        methods: {
            edit() {
                this.editData = this.model.properties;
                this.isEditing = true;
            },

            save() {
                this.model.name = this.editData.name;
                this.model.description = this.editData.description;
                this.model.color = this.editData.color;

                this.isEditing = false;
                this.model.save();
            },

            cancel() {
                // trigger event for parent to handle if no ID (column created and then canceled)
                if (!this.model.id) {
                    this.$emit('removeColumn', this.model);
                }

                this.isEditing = false;
            },

            destroy() {
                this.model.destroy(() => {
                    this.$emit('removeColumn', this.model);
                });
            },

            moveColumn(increment) {
                if (increment) {
                    this.model.position++;
                } else {
                    this.model.position--;
                }

                if (this.model.position <= 0) {
                    this.model.position = 0;
                }

                this.$store.commit('updateColumnPosition', this.model);
                this.$emit('updatePositions');
            }
        },

        components: {
            'dropdown-list': require('./Dropdown.vue'),
        }
    }
</script>