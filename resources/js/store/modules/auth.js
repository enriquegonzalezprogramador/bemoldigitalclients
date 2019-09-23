const USER_KEY = 'lvspa-user';
const TOKEN_KEY = 'lvspa-token';

const setLocalStorage = (commit, { accessToken, user }) => {
  localStorage.setItem(TOKEN_KEY, accessToken);
  localStorage.setItem(USER_KEY, JSON.stringify(user));

  commit('AUTH_SUCCESS', { accessToken, user });
};

const removeLocalStorage = () => {
  localStorage.removeItem(TOKEN_KEY);
  localStorage.removeItem(USER_KEY);
};

export default {
  namespaced: true,
  state: {
    status: '',
    user: JSON.parse('{}'),
    token: localStorage.getItem(TOKEN_KEY) || '',
  },
  mutations: {
    AUTH_REQUEST(state) {
      state.status = 'loading';
    },
    AUTH_SUCCESS(state, { accessToken, user }) {
      state.status = 'success';
      state.token = accessToken;
      state.user = user;
    },
    AUTH_ERROR(state) {
      state.status = 'error';
    },
    LOGOUT(state) {
      state.status = '';
      state.token = '';
      state.user = '';
    },
  },
  actions: {
    register({ commit }, data) {
      return new Promise((resolve, reject) => {
        commit('AUTH_REQUEST');
        this._vm.$http.post('/auth/register', data)
          .then((res) => {
            const accessToken = res.data.access_token;
            const { user } = res.data;

            setLocalStorage(commit, { accessToken, user });
            this._vm.$http.defaults.headers.common.Authorization = accessToken;

            resolve(res);
          })
          .catch((err) => {
            commit('AUTH_ERROR');
            removeLocalStorage();
            reject(err);
          });
      });
    },
    login({ commit }, data) {
      return new Promise((resolve, reject) => {
        commit('AUTH_REQUEST');

        this._vm.$http.post('/auth/login', data)
          .then((res) => {
            const accessToken = res.data.access_token;
            const { user } = res.data;

            setLocalStorage(commit, { accessToken, user });
            this._vm.$http.defaults.headers.common.Authorization = accessToken;

            resolve(res);
          })
          .catch((err) => {
            commit('AUTH_ERROR');
            removeLocalStorage();
            reject(err);
          });
      });
    },
    logout({ commit }) {
      return new Promise((resolve, reject) => {
        commit('LOGOUT');

        removeLocalStorage();
        delete this._vm.$http.defaults.headers.common.Authorization;

        resolve();
      });
    },
  },
  getters: {
    isLoggedIn: state => !!state.token,
    authStatus: state => state.status,
    authUser: state => state.user,
  },
};
