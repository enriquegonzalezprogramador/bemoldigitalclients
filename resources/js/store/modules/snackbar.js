export default {
  namespaced: true,
  state: {
    status: false,
    text: '',
    color: '',
  },
  mutations: {
    SNACKBAR(state, { text, color }) {
      state.status = true;
      state.text = text;
      state.color = color;
    },
  },
  actions: {
    error({ commit }, text) {
      commit('SNACKBAR', { text, color: 'error' });
    },
    success({ commit }, text) {
      commit('SNACKBAR', { text, color: 'success' });
    },
  },
};
