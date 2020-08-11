export default {
    state: {
        auth: {},
        roles: []
    },

    getters: {
        storedRoles: state => state.roles,
        authenticated: state => state.auth
    },

    mutations: {
        storeAuthenticated: (state, payload) => {
            state.auth = payload;
        },

        storeRoles: (state, payload) => {
            state.roles = payload;
        },
    },

    actions: {
        fetchRoles: ({ commit }) => {
            axios.get("/admin/roles/list").then(({ data }) => {
                commit('storeRoles', data)
            });
        },
    }
}