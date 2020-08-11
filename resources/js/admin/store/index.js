import users from './modules/users';

export default new Vuex.Store({
    modules: {
        users
    },

    state: {
        breadcrumbs: []
    },

    getters: {
        //
    },

    mutations: {
        storeBreadcrumbs: (state, payload) => {
            state.breadcrumbs = payload;
        }
    },

    actions: {
        //
    }
});
