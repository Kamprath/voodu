<template>

	<section id="dashboard">

		<message-box title="Inspiring Quote">
			{{ message }}
		</message-box>

        <div class="section">
            <button 
                :class="{ 'button': true, 'is-primary': true, 'is-loading': isMessageLoading }"
                @click="updateMessage"
                :disabled="isMessageLoading">
                New Quote
            </button>
            <button class="button is-secondary" @click="setRoutes(newRoutes)">Update Routes</button>
        </div>

	</section>

</template>

<script>

    import { mapState, mapActions, mapMutations } from 'vuex';

    export default {

        data() {
            return {
                newRoutes: [
                    { name: 'One', path: '#' },
                    { name: 'Two', path: '#' },
                    { name: 'Three', path: '#' }
                ]
            }
        },

        methods: {
            ...mapActions(['updateMessage']),

            setRoutes() {
                this.$store.dispatch('setRoutes', this.newRoutes);
            }
        },

        computed: mapState({
            message: state => state.dashboard.message,
            isMessageLoading: state => state.dashboard.messageIsLoading
        }),

        components: {
            'message-box': require('./MessageBox.vue')
        },

        mounted() {
            if (this.isMessageLoading) {
                this.$store.dispatch('updateMessage');
            }
        }

    };

</script>