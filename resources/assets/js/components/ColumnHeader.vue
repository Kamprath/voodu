<template>
    <div class="column" :style="style">
        <form v-if="isEditing" @keyup.esc="cancel" @submit.prevent="save">
            <!-- Edit name -->
            <input class="input edit-title"
                   type="text"
                   placeholder="Enter a title"
                   autofocus
                   tabindex="1"
                   required
                   v-model="editData.name">

            <!-- Edit description -->
            <!-- note: removed until a better layout is decided on -->
            <!--<textarea class="textarea"
                      placeholder="Enter a description (optional)"
                      tabindex="2"
                      rows="2"
                      v-model="editData.description">
            </textarea>-->

            <!-- Edit color -->
            <div class="is-pulled-left edit-color">
                <a href="#" @click.prevent="isEditingColor = true">Choose color</a>
                <color-picker v-if="isEditingColor" @change="handleColorPickerChange" @close="isEditingColor = false" />
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
        </form>

        <div v-else>
            <h6 class="title is-6">{{ model.name }}</h6>
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
        margin: auto .25rem .25rem;
        text-align: center;
        align-self: flex-start;
        border-radius: 2px;
        background-color: @color-gray-dark;
        min-width: 180px;
    }
    .title {
        color: white;
        display: inline;
    }
    .title, .dropdown {
        vertical-align: middle;
    }
    .edit-title {
        font-weight: bold;
        margin-bottom: .25rem;
    }
    .edit-title, .textarea {
        font-size: .9rem;
    }
    .input, .textarea {
        padding: .25rem .5rem;
    }
    .textarea {
        margin: .25rem 0;
        line-height: 1.1rem;
    }
    .edit-color {
        position: relative;

        a {
            color: white;
            margin: 0 .25rem;
            vertical-align: middle;
            font-size: .9rem;
        }
    }
</style>

<script>
    import Column from '../models/Column.js';
    import autofocus from '../autofocus.js';

    export default {
        props: {
            model: {
                type: Column,
                default: new Column
            },
        },

        data() {
            return {
                isEditing: !this.model.id,
                isEditingColor: false,
                editData: {}
            }
        },

        computed: {
            style() {
                const hex = !this.isEditing ? this.model.color : this.editData.color;
                return !hex ? '' : 'background-color: #' + hex;
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
            },

            autofocus() {
                this.$nextTick(() => {
                    autofocus();
                });
            },

            handleColorPickerChange(value) {
                this.editData.color = value.hex.replace('#', '');
            }
        },

        components: {
            'dropdown-list': require('./Dropdown'),
            'color-picker': require('./ColorPicker')
        },

        updated() {
            this.autofocus();
        },

        mounted() {
            this.autofocus();
        }
    }
</script>