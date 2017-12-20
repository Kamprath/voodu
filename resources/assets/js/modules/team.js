import bootstrapped from '../bootstrapped';

export default {
    state: {
        model: bootstrapped.get('team'),
        overlay: {
            active: false,
            model: null
        }
    },

    mutations: {
        toggleTeamOverlay(state, isActive = true) {
            state.overlay.active = isActive;
        }
    }
}