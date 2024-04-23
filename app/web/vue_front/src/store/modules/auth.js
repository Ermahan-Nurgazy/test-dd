import authApi from '@/api/auth'
import {setItem} from '@/helpers/persistanceStorage'

const state = {
  isSubmitting: false,
  isLoggedIn: null,
  isLoading: false,
  currentUser: null,
  validationErrors: null,
  user: null
}

export const mutationTypes = {
  loginStart: '[auth] Login start',
  loginSuccess: '[auth] Login success',
  loginFailure: '[auth] Login failure',

  getCurrentUserStart: '[auth] Get current user start',
  getCurrentUserSuccess: '[auth] Get current user success',
  getCurrentUserFailure: '[auth] Get current user failure',
}

export const actionTypes = {
  login: '[auth] Login',
  getCurrentUser: '[auth] Get current user',
}

export const getterTypes = {
  currentUser: '[auth] currentUser',
  isLoggedIn: '[auth] isLoggedIn',
  isAnonymous: '[auth] isAnonymous'
}

const getters = {
  [getterTypes.currentUser]: state => {
    return state.currentUser
  },
  [getterTypes.isLoggedIn]: state => {
    return Boolean(state.isLoggedIn)
  },
  [getterTypes.isAnonymous]: state => {
    return state.isLoggedIn === false
  }
}

const mutations = {
  [mutationTypes.loginStart](state) {
    state.isSubmitting = true
    state.validationErrors = null
  },
  [mutationTypes.loginSuccess](state, payload) {
    state.isSubmitting = false
    state.isLoggedIn = true
    state.currentUser = payload
  },
  [mutationTypes.loginFailure](state, payload) {
    state.isSubmitting = false
    state.validationErrors = payload
  },
}

const actions = {
  [actionTypes.login](context, credentials) {
    return new Promise(resolve => {
      context.commit(mutationTypes.loginStart)
      authApi
        .login(credentials)
        .then(response => {
          context.commit(mutationTypes.loginSuccess, response.data.user)
          setItem('accessToken', response.data.token)
          setItem('type', response.data.type)
          resolve(response.data.user)
        })
          .catch(result => {            
            context.commit(
                mutationTypes.loginFailure,
                result.response.data.error_description
            )
          })
    })
  }
}

export default {
  state,
  actions,
  mutations,
  getters
}
