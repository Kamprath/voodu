export default {
	
	state: {},

	mutations: {
		addTask(title) {

		},

		removeTask(id) {

		}
	},

	actions: {
		addTask(context, title) {
			context.commit('addTask', title);
		},

		removeTask(context, id) {

		}
	},

	getters: {}

};