<template>

	<section id="dashboard">

		<nav-bar :routes="routes"></nav-bar>

		<message-box title="Lorizzle Dizzle">
			Lorizzle ghetto daahng dawg sit sheezy, consectetuer adipiscing my shizz. Ghetto shizzle my nizzle crocodizzle velizzle, crazy volutpizzle, suscipit gangster, gravida vizzle, break yo neck, yall. Pellentesque egizzle yo. Sed erizzle. Gangsta izzle my shizz dapibizzle turpis tempus stuff. Maurizzle pellentesque for sure et turpis. Vestibulum in tortor. My shizz eleifend rhoncus fo. In hac pot platea dictumst. Fo shizzle my nizzle dapibizzle. Curabitur tellizzle dang, pretizzle that's the shizzle, dizzle izzle, eleifend i'm in the shizzle, uhuh ... yih!. Hizzle suscipizzle. Integizzle sempizzle velit funky fresh dizzle.
		</message-box>

	</section>

</template>

<script>

	import MessageBox from './MessageBox';
	import NavBar from './NavBar';

    export default {

        data() {
            return {
                routes: [
                    { name: 'Dashboard', path: '/' },
                    { name: 'Tasks', path: '/tasks' }
                ]
            }
        },

        components: { MessageBox, NavBar }

    };

</script>