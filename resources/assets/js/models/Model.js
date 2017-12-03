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

    /**
     * API resource URI
     * @returns {string}
     */
    get route() {
        if (!this.source || !this.id) {
            return;
        }

        return this.source + '/' + this.id;
    }

    destroy(callback) {
        if (!this.id) {
            throw new Error('Failed to delete model: No ID is set.');
            return false;
        }

        if (!this.route) {
            throw new Error('Failed to delete model: No route is set.');
            return false;
        }

        axios.delete(this.route)
            .then(() => {
                if (typeof callback === 'function') {
                    callback(this);
                }
            })
            .catch(error => {
                throw new Error('Failed to delete model: ' + error);
            })
    }

    update(callback = () => {}) {
        if (!this.source) {
            throw new Error('No \'source\' getter is set');
            return;
        }

        axios.put(this.source + '/' + this.id, this.properties)
            .then(response => {
                this.handleSaveResponse(response, callback);
            })
            .catch(this.handleError);
    }

    create(callback = () => {}) {
        if (!this.source) {
            throw new Error('No \'source\' getter is set');
            return;
        }

        axios.post(this.source, this.properties)
            .then(response => {
                this.handleSaveResponse(response, callback);
            })
            .catch(this.handleError);
    }

    /**
     * Create or update model
     * @param {function} callback
     */
    save(callback = () => {}) {
        if (!this.id) {
            this.create(callback);
        } else {
            this.update(callback);
        }
    }

    /**
     * Handle response after create() or update()
     * @param {object} response     Response data
     * @param {function} callback   (Optional)
     */
    handleSaveResponse(response, callback) {
        // verify success
        if (!response.data.id) {
            throw new Error('No model data returned by API.');
            return;
        }

        // update model with response data
        this.assign(response.data);

        if (typeof callback === 'function') {
            callback(response.data);
        }
    }

    handleError(error) {
        throw new Error('Failed to create model: ' + error);
    }
}

export default Model;