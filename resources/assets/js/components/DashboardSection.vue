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

    import { mapState } from 'vuex';
    import { mapMutations } from 'vuex';
	import MessageBox from './MessageBox';
	import NavBar from './NavBar';

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

        computed: mapState(['message', 'routes']),

        components: { MessageBox, NavBar }

    };

</script>