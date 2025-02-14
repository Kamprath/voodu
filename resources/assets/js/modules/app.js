export default {

    state: {
        routes: [
            { name: 'Dashboard', path: '/' },
            { name: 'Tasks', path: '/tasks' }
        ],

        /**
         * Indicates whether or not the Boards sidebar is active
         */
        isBoardsActive: false,

        modal: {
            isActive: false,
            title: null,
            message: null
        },

        selectedCardId: 0
    },

    getters: {
        isSidebarOpen(state) {
            return state.isBoardsActive;
        }
    },

    mutations: {
    	setRoutes(state, routes) {
    		state.routes = routes;
    	},

        toggleBoards(state) {
    	    state.isBoardsActive = !state.isBoardsActive;
        },

        showModal(state, payload) {
    	    state.modal.title = payload.title;
    	    state.modal.message = payload.message;
    	    state.modal.isActive = true;
        },

        hideModal(state) {
    	    state.modal.isActive = false;
        },

        hideSidebar(state) {
    	    state.isBoardsActive = false;
        },

        selectCard(state, id) {
    	    state.selectedCardId = id;
        }
    },

    actions: {
		setRoutes(context, routes) {
			context.commit('setRoutes', routes);
		},

        toggleBoards(context) {
		    context.commit('toggleBoards');
        },

        showModal(context, payload) {
		    context.commit('showModal', payload);
        },

        hideModal(context) {
		    context.commit('hideModal');
        },

        hideSidebar(context) {
		    context.commit('hideSidebar');
        },

        selectCard(context, id) {
		    context.commit('selectCard', id);
        }
    }

};