import postApi from '@/api/post'

const state = {
    data: null,
    isLoading: false,
    validationErrors: null,
    isSubmitting: false
}

export const mutationTypes = {
    postListStart: '[post] Get post list start',
    postListSuccess: '[post] Get post list success',
    postListFailure: '[post] Get post list failure',
    postAddStart: '[post] Add post start',
    postAddSuccess: '[post] Add post success',
    postAddFailure: '[post] Add post failure',
}

export const actionTypes = {
    postList: '[post] Get post',
    postAdd: '[post] Add post',
}

const mutations = {
    [mutationTypes.postListStart](state) {
        state.isLoading = true
        state.data = null
    },
    [mutationTypes.postListSuccess](state, payload) {
        state.isLoading = false
        state.data = payload
        state.validationErrors = null
    },
    [mutationTypes.postListFailure](state,payload) {
        state.isLoading = false
        state.validationErrors = payload
    },

    [mutationTypes.postAddStart](state) {
        state.isLoading = true
        state.data = null
    },
    [mutationTypes.postAddSuccess](state, payload) {
        state.isLoading = false
        state.data = payload
        state.validationErrors = null
    },
    [mutationTypes.postAddFailure](state,payload) {
        state.isLoading = false
        state.validationErrors = payload
    },
}

const actions = {
    [actionTypes.postList](context, data) {
        return new Promise(resolve => {
            context.commit(mutationTypes.postListStart)
            postApi
                .postList(data)
                .then(response => {
                    context.commit(mutationTypes.postListSuccess, response)
                    resolve(response)
                })
                .catch(response => {
                    context.commit(mutationTypes.postListFailure,response)
                })
        })
    },
    [actionTypes.postAdd](context, data) {
        return new Promise(resolve => {
            context.commit(mutationTypes.postAddStart)
            postApi
                .postAdd(data)
                .then(response => {
                    context.commit(mutationTypes.postAddSuccess, response)
                    resolve(response)
                })
                .catch(response => {
                    context.commit(mutationTypes.postAddFailure,response)
                })
        })
    },
}

export default {
    state,
    actions,
    mutations
}