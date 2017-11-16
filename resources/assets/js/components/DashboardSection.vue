<template>

	<section id="dashboard">

		<nav-bar :routes="routes"></nav-bar>

		<message-box title="Lorizzle Dizzle">
			{{ message }}
		</message-box>

        <div class="section">
            <button class="button is-primary" @click="setMessage('You clicked the button...')">Update Message</button>
            <button class="button is-secondary" @click="setRoutes(newRoutes)">Update Routes</button>
        </div>

	</section>

</template>

<script>

    import { mapState, mapMutations } from 'vuex';

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

        methods: mapMutations(['setMessage', 'setRoutes']),

        computed: mapState({
            message: state => state.dashboard.message,
            routes: state => state.dashboard.routes
        }),

        components: {
            'message-box': require('./MessageBox.vue'),
            'nav-bar': require('./NavBar.vue')
        }

    };

</script>