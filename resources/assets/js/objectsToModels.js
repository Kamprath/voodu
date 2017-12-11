/**
 * Convert data objects to models
 * @param {array} objects   Model data as array of objects
 * @param {Model} model     Model class
 * @param {object} map      (Optional) Sub-sets of models to convert, passed as an object of property names mapped to classes
 * @returns {Array}         Returns an array of models
 */
function objectsToModels(objects, model, map = {}) {
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

export default objectsToModels;