import Vue from 'vue'
import Vuex from 'vuex'

import auth from '@/store/modules/auth'
import post from '@/store/modules/post'

Vue.use(Vuex)

export default new Vuex.Store({
  state: { userInterface: null, userType: null, userFIO: null, preloader: false, error: null, },
  mutations: {
    setUserInterface: (state, data) => state.userInterface = data,
    unSetUserInterface: (state) => state.userInterface = null,
    setUserType: (state, data) => state.userType = data,
    showPreloader: (state, data) => state.preloader = data,
    setError: (state, data) => state.error = data,
    clearError: (state) => state.error = null,
  },
  actions: {},
  modules: {
    auth,
    post
  }
})
