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

    /**
     * Get models from bootstrapped data
     * @param {string} module   VueX module name
     * @param {Model} model     Model class to retrieve
     * @returns {Array}         Returns an array of models
     */
	models(module, model) {
		let models = [];
		const bootstrapped = this.get(module, 'models');

		for (const index in bootstrapped) {
			models.push(
			    new model(bootstrapped[index])
            );
		}

		return models;
	}
}