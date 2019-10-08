const state = {
    user: null,
}

const getters = {};

// actions
const actions = {
    setUser({ state, commit }, { user }) {
        commit('SET_USER', { user })
    },
}

// mutations
const mutations = {
    'SET_USER'(state, { user }) {
        state.user = user;
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}