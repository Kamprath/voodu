import axios from 'axios';

class Model {
    constructor(properties) {
        this.assign(properties);
    }

    assign(properties) {
        if (typeof properties !== 'object') { return; }

        for (const prop in properties) {
            this[prop] = properties[prop];
        }
    }

    get properties() {
        let properties = {};

        for (const prop in this) {
            if (!this.hasOwnProperty(prop) || typeof prop === 'function') { continue; }
            properties[prop] = this[prop];
        };

        return properties;
    }

    delete() {

    }

    update() {

    }

    create(callback) {
        if (!this.source) {
            throw new Error('No \'source\' getter is set');
            return;
        }

        axios.post(this.source, this.properties)
            .then(response => {
                // verify success
                if (!response.data.id) {
                    throw new Error('No model data returned by API.');
                    return;
                }

                // update model with response data
                this.assign(response.data);

                if (typeof callback === 'function') {
                    callback(this);
                }
            })
            .catch(error => {
                throw new Error(error);
            });
    }
}

export default Model;