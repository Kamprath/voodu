import objectsToModels from './objectsToModels';

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
     * @param {object} map      Sub-sets of models to convert, passed as an object of property names mapped to classes
     * @returns {Array}         Returns an array of models
     */
	models(module, model, map = {}) {
		return objectsToModels(
		    this.get(module, 'models'),
            model,
            map
        );
	}
}