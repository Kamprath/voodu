import bootstrapped from '../bootstrapped.js';
import axios from 'axios';

export default {

    state: {
        models: bootstrapped.get('boards', 'models')
    },

    mutators: {
        deleteBoard(state, id) {

        }
    },

    actions: {
        deleteBoard(context, id) {
            axios.delete('/api/boards/' + id)
                .then(response => {
                    if (!response.data.success) {
                        return;
                    }
                    context.commit('deleteBoard', id);
                })
                .catch(() => {
                    this.dispatch('showModal', {
                        title: 'API Error',
                        message: 'Failed to delete board.'
                    })
                });
        }
    }

}