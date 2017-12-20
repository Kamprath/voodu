<template>
    <section v-if="isVisible"
        class="hero is-info is-bold is-fullheight overlay"
        @keyup.esc="hide">

        <div class="hero-body">
            <!-- Close button -->
            <a href="#" class="close-overlay" @click.prevent="hide">
                <i class="fa fa-times fa-2x is-dark" aria-hidden="true"></i>
                <span>esc</span>
            </a>

            <!-- Step 1: Team size interface -->
            <div class="container" v-if="step === 1">
                <h1 class="title">Select team size</h1>
                <p>Choose the size of your team. Subscription fee is based upon number of team members and payment period.</p>

                <!-- Team Members field -->
                <div class="field">
                    <label class="label">Team members</label>
                    <div class="control">
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button" @click="size--">-</a>
                            </p>
                            <p class="control">
                                <input class="input team-size" type="text" v-model.number="size">
                            </p>
                            <p class="control">
                                <a class="button" @click="size++">+</a>
                            </p>
                        </div>
                        <div class="input-details">
                            $5 user/month or $50 user/year
                        </div>
                    </div>
                </div>

                <!-- Subscription Type radios -->
                <div class="field">
                    <label class="label">Subscription type</label>
                    <div class="control">
                        <label class="radio">
                            <input type="radio"
                                   name="type"
                                   value="trial"
                                   v-model="type"
                                   tabindex="3"
                                   checked>
                            &nbsp;30-day trial
                        </label>
                        <label class="radio">
                            <input type="radio"
                                   name="type"
                                   value="monthly"
                                   v-model="type"
                                   tabindex="4">
                            &nbsp;Monthly
                        </label>
                        <label class="radio">
                            <input type="radio"
                                   name="type"
                                   value="annually"
                                   v-model="type"
                                   tabindex="5">
                            &nbsp;Annually
                        </label>
                        <div class="input-details">Choose when you’d like to be billed.</div>
                    </div>
                </div>

                <div class="field" v-if="type !== 'trial'">
                    <label class="label">You pay</label>
                    <p class="subscription-fee is-large">${{ price }} {{ type }}</p>
                </div>

                <!-- Buttons -->
                <div class="field is-grouped is-pulled-right">
                    <div class="control">
                        <button type="button"
                            class="button is-medium is-text"
                            @click="hide">
                            Cancel
                        </button>
                    </div>
                    <div class="control">
                        <button type="button"
                            class="button is-medium is-secondary"
                            @click="step++">
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 2: Payment summary interface -->
            <div class="container" v-if="step === 2">
                <h1 class="title"></h1>
            </div>

            <!-- Step 3: Create team interface -->
            <div class="container" v-if="step === 3">
                <h1 class="title"></h1>
            </div>

            <!-- Step 4: Invite team members interface -->
            <div class="container" v-if="step === 4">
                <h1 class="title"></h1>
            </div>
        </div>
    </section>
</template>

<style lang="less" scoped>
    @import '../../../less/overlay.less';

    .team-size {
        width: 3rem;
        text-align: center;
    }
    p.subscription-fee {
        font-size: 1.25rem;
        margin-left: .66rem;
        font-weight: bold;
    }
</style>

<script>
    export default {
        data() {
            return {
                step: 1,
                size: 2,
                type: 'monthly'
            }
        },
        computed: {
            isVisible() {
                return this.$store.state.team.overlay.active;
            },
            price() {
                return this.size * (this.type === 'monthly' ? 5 : 50);
            }
        },
        methods: {
            reset() {
                this.step = 1;
            },
            hide() {
                this.reset();
                this.$store.commit('toggleTeamOverlay', false);
            }
        },
        watch: {
            /**
             * Hide overflow while overlay is active
             * @param newValue
             */
            isVisible(newValue) {
                document.querySelector('html').style.overflow = newValue ? 'hidden' : 'visible';
            },

            size(newValue) {
                if (newValue < 2) {
                    this.size = 2;
                }
            }
        }
    }
</script>