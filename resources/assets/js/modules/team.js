import bootstrapped from '../bootstrapped';

export default {
    state: {
        model: bootstrapped.get('team'),
        isEditing: false
    },

    mutations: {
        editTeam(state) {
            state.isEditing = true;
        }
    }
}