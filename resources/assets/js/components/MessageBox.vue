<template>

	<div>
		<article class="message">
			<div class="message-header">
				<p>{{ title }}</p>
				<button class="delete" aria-label="delete" @click="remove"></button>
			</div>
			<div class="message-body">
				<slot></slot>
			</div>
		</article>
	</div>

</template>

<script>

	export default {
		props: ['title'],

		methods: {
			remove(e) {
				this.$el.remove();
			}
		}
	}

</script>