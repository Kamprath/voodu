<template>
    <div class="column swimlane-column">
        <draggable v-model="cards" :options="{
                dragClass: 'is-dragging',
                animation: 75,
                delay: 0,
                group: 'cards',
                draggable: '.is-draggable'
            }" style="min-height: 100%;">
            <!-- Cards -->
            <card v-for="card in cards"
                  :key="card.id"
                  v-if="card.column_id === column.id"
                  :model="card"
                  @removeCard="swimlane.removeRelated('cards', card)" />
        </draggable>

        <div class="add-card">
            <a href="#" @click.prevent="addCard(swimlane, column.id)">
                <i class="fa fa-plus-circle"></i>
                <span>Add a card</span>
            </a>
        </div>
    </div>
</template>

<style lang="less" scoped>
    @import '../../less/colors';

    .swimlane-column {
        background-color: @color-white;
        margin: 0 .25rem;
        padding: .4rem .4rem 1.7rem;
        position: relative;
        border-radius: 2px;
    }

    .add-card {
        position: absolute;
        width: 100%;
        bottom: .25rem;
        right: 0;
        left: 0;
        opacity: 0;
        text-align: center;

        &, a {
            transition: opacity 100ms;
        }

        a {
            color: @color-gray-dark;
            font-size: .85rem;
            opacity: .4;
            padding: .2rem 2rem;

            span, .fa {
                vertical-align: middle;
            }

            &:hover {
                opacity: 1;
            }
        }
    }
    .swimlane-column:hover .add-card {
        opacity: 1;
    }
</style>

<script>
    import draggable from 'vuedraggable';
    import Column from '../models/Column';
    import Swimlane from '../models/Swimlane';
    import Card from '../models/Card';

    export default {
        props: {
            column: {
                type: Column,
                default: new Column
            },
            swimlane: {
                type: Swimlane,
                default: new Swimlane
            }
        },

        methods: {
            addCard(swimlane, columnId) {
                swimlane.addCard(new Card({
                    column_id: columnId,
                    swimlane_id: swimlane.id,
                    board_id: swimlane.board_id,
                    position: swimlane.cards.length
                }));
            },
        },

        computed: {
            cards: {
                /**
                 * Get cards that belong to this column and swimlane
                 * @return {array}  Returns array of Card models
                 */
                get() {
                    const cards = [];

                    // get cards that match column ID and order by position
                    this.swimlane.cards.filter(card => card.column_id === this.column.id).forEach(card => {
                        cards.splice(card.position, 0, card);
                    });

                    return cards;
                },

                /**
                 * Update card positions
                 * @param {array} models
                 */
                set(models) {
                    for (let i in models) {
                        models[i].column_id = this.column.id;
                        models[i].position = parseInt(i);
                    }

                    this.$store.dispatch('updateCards', {
                        cards: models,
                        swimlane: this.swimlane
                    });
                }
            }
        },

        components: {
            'card': require('./Card'),
            draggable
        }
    }
</script>