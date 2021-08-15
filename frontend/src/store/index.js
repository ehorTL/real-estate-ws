import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
  plugins: [createPersistedState()],
  state: {
    user: null,
    featuredObjects: []
  },
  getters: {
    getToken: state => state.user,
    getFeaturedObjects: state => state.featuredObjects
  },
  actions: {
    login({ commit }, credentials) {
      return axios.post("common/login", credentials).then(res => {
        commit("SET_USER_DATA", res.data.token);
      });
    },
    logout({ commit }) {
      commit("CLEAR_USER_DATA");
    },
    addToFeatured({ commit, state }, object) {
      if (state.featuredObjects.find(el => el.id === object.id)) {
        return false;
      } else {
        commit("ADD_OBJECT_TO_FEATURED", object);
      }
    },
    removeFromFeatured({ commit }, object) {
      commit("REMOVE_OBJECT_FROM_FEATURED", object);
    }
  },
  mutations: {
    SET_USER_DATA(state, userData) {
      state.user = userData;
      axios.defaults.headers.common["Authorization"] = `Bearer ${userData}`;
    },
    CLEAR_USER_DATA(state) {
      state.user = null;
      axios.defaults.headers.common["Authorization"] = null;
      location.reload();
    },
    ADD_OBJECT_TO_FEATURED(state, object) {
      state.featuredObjects.push(object);
    },
    REMOVE_OBJECT_FROM_FEATURED(state, object) {
      state.featuredObjects = state.featuredObjects.filter(
        el => el.id !== object.id
      );
    }
  }
});
