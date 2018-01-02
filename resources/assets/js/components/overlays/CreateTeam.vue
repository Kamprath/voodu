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
            <div class="container fade-in" v-if="step === 1">
                <h1 class="title">Pick a plan</h1>
                <p>A team plan allows you to collaborate with other people in your organization. Share public boards or invite team members to private boards.</p>

                <!-- Team Members field -->
                <div class="field">
                    <label class="label">Team members</label>
                    <div class="control">
                        <div class="field has-addons">
                            <p class="control">
                                <a class="button" @click="team.size--">-</a>
                            </p>
                            <p class="control">
                                <input class="input team-size" type="text" v-model.number="team.size">
                            </p>
                            <p class="control">
                                <a class="button" @click="team.size++">+</a>
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

                <div class="field">
                    <label class="label">You pay</label>
                    <p class="subscription-fee">
                        ${{ price }}<span v-if="!isTrial"> {{ type }}</span><span v-if="isTrial" class="has-text-weight-normal"> after 30 days</span>
                    </p>
                    <div class="input-details">You can cancel at any time.</div>
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
            <!--<div class="container" v-if="step === 2">
                <h1 class="title">Payment summary</h1>
                <p>You can change or cancel your plan at any time.</p>

                &lt;!&ndash; Subscription Type radios &ndash;&gt;
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

                &lt;!&ndash; Buttons &ndash;&gt;
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
            </div>-->

            <!-- Step 3: Create team interface -->
            <div class="container fade-in" v-if="step === 2">
                <h1 class="title">Create your team</h1>
                <p>Choose a name and an avatar for your team.</p>

                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input is-medium" v-model="name" placeholder="Enter a name for your team" tabindex="1" maxlength="26" autofocus>
                        <div class="input-details">
                            Names must be shorter than 26 characters.
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Avatar <span class="has-text-weight-normal">(optional)</span></label>
                    <div class="upload-avatar">
                        <avatar class="is-large" :src="avatar.dataUrl" />
                        <div class="file has-name is-secondary">
                            <label class="file-label">
                                <input class="file-input"
                                       type="file"
                                       name="avatar"
                                       accept="image/*"
                                       @change="handleAvatarChange">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fa fa-upload"></i>
                                    </span>
                                    <span class="file-label">Choose an image…</span>
                                </span>
                                <span class="file-name" v-if="avatar.file">{{ avatar.file.name }}</span>
                            </label>
                        </div>
                    </div>
                    <div v-if="!avatar.isFileTooLarge" class="input-details">
                        Files must be smaller than 3MB.
                    </div>
                    <div v-else class="input-details is-danger shake">
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        The file you selected is larger than 3MB.
                    </div>
                </div>

                <!-- Buttons -->
                <div class="field is-grouped is-pulled-right">
                    <div class="control">
                        <button type="button"
                                class="button is-medium is-text"
                                @click="step--">
                            Back
                        </button>
                    </div>
                    <div class="control">
                        <button type="button"
                                class="button is-medium is-secondary"
                                :disabled="!this.name"
                                @click="step++">
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Step 4: Invite team members interface -->
            <div class="container fade-in" v-if="step === 3">
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

    .upload-avatar {
        margin: .5rem 0;

        figure {
            margin: 0 .5rem;
        }
        figure, .file {
            display: inline-block;
            vertical-align: middle;
        }
    }

</style>

<script>
    import autofocus from '../../autofocus';
    import Avatar from "../Avatar";

    export default {
        components: { Avatar },

        data() {
            return {
                step: 1,
                team: { size: 2 },
                type: 'monthly',
                name: null,
                avatar: {
                    file: null,
                    dataUrl: null,
                    isFileTooLarge: false
                }
            }
        },

        computed: {
            isVisible() {
                return this.$store.state.team.overlay.active;
            },
            price() {
                return this.team.size * (this.type === 'annually' ? 50 : 5);
            },
            isTrial() {
                return this.type === 'trial';
            }
        },

        methods: {
            reset() {
                this.step = 1;
            },

            hide() {
                this.reset();
                this.$store.commit('toggleTeamOverlay', false);
            },

            handleAvatarChange(e) {
                this.resetAvatar();

                if (e.target.files.length === 0) {
                    return;
                }

                this.avatar.isFileTooLarge = e.target.files[0].size > 3000000;

                if (this.avatar.isFileTooLarge) {
                    return false;
                }

                this.avatar.file = e.target.files[0];

                this.storeAvatarDataUrl();
            },

            /**
             * Reset avatar data
             */
            resetAvatar() {
                this.avatar.file = null;
                this.avatar.dataUrl = null;
                this.avatar.isFileTooLarge = false;
            },

            /**
             * Store data URL used for avatar preview
             */
            storeAvatarDataUrl() {
                if (!(this.avatar.file instanceof File)) {
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    this.avatar.dataUrl = e.target.result;
                }.bind(this);

                reader.readAsDataURL(this.avatar.file);
            }
        },

        updated() {
            this.$nextTick(() => {
                autofocus();
            });
        },

        watch: {
            /**
             * Hide overflow while overlay is active
             * @param newValue
             */
            isVisible(newValue) {
                document.querySelector('html').style.overflow = newValue ? 'hidden' : 'visible';
            },

            'team.size': function(newValue) {
                if (newValue < 2) {
                    this.team.size = 2;
                }
                if (newValue > 500) {
                    this.team.size = 500;
                }
            }
        }
    }
</script>