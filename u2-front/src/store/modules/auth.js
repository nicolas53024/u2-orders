import axios from 'axios';
axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000';
// local state
const state = {
    isAuthenticated: false,
    user: null,
};

const getters = {
    autenticado(state) {
        return state.isAuthenticated
    }
};

const mutations = {
    SET_USER(state, user) {
        state.user = user;
    },
    SET_AUTHENTICATED(state, value) {
        state.isAuthenticated = value;
    },
};

const actions = {
    async login({ dispatch }, credentials) {
        await axios.get('/sanctum/csrf-cookie');
        await axios.post('/login', credentials);
        return dispatch("getUser");
    },
    async logout({ dispatch }) {
        localStorage.removeItem('usuario') 
        await axios.get('/sanctum/csrf-cookie');
        await axios.post('/logout');
        
    },
    getUser({ commit }) {
        if (localStorage.getItem('usuario')) {
            commit('SET_USER', JSON.parse(localStorage.getItem('usuario')));
            commit('SET_AUTHENTICATED', true);
            return true;
        }
        axios.get('api/user').then((res) => {
            localStorage.setItem('usuario', JSON.stringify(res.data))
            commit('SET_USER', res.data);
            commit('SET_AUTHENTICATED', true);
        }).catch(() => {
            commit('SET_USER', null);
            commit('SET_AUTHENTICATED', false);
        })
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};