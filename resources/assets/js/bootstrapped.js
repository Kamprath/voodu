window.Voodu = window.Voodu || {};
window.Voodu.bootstrapped = window.Voodu.bootstrapped || {};

const data = window.Voodu.bootstrapped;

/**
 * Convert data objects to models
 * @param {array} objects   Model data as array of objects
 * @param {Model} model     Model class
 * @param {object} map      Sub-sets of models to convert, passed as an object of property names mapped to classes
 * @returns {Array}         Returns an array of models
 */
function objectsToModels(objects, model, map) {
    let models = [];

    // create models
    for (let index in objects) {
        models.push(
            new model(objects[index])
        );
    }

    // recursively convert sub-sets of models within each model
    for (let i in models) {
        for (let prop in models[i]) {
            // make sure property name is in map and contains objects
            if (!map.hasOwnProperty(prop) || typeof models[i][prop] !== 'object' || !models[i][prop].length || typeof models[i][prop][0] !== 'object') {
                continue;
            }

            models[i][prop] = objectsToModels(models[i][prop], map[prop], map);
        }
    }

    return models;
}

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