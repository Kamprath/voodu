window.Voodu = window.Voodu || {};
window.Voodu.bootstrapped = window.Voodu.bootstrapped || {};

const data = window.Voodu.bootstrapped;


export default {
    /**
	 * Get bootstrapped data
     * @param {string} module	Namespace
     * @param {string} key		Property name
     * @returns {*}
     */
	get(module, key) {
		if (!data.hasOwnProperty(module)) {
			return;
		}

		if (!data[module][key]) {
			return;
		}

		return data[module][key];
	},

	models(module, model) {
		let models = [];
		const bootstrapped = this.get(module, 'models');

		for (const data in bootstrapped) {
			models.push(new model(data));
		}

		return models;
	}
}