import genreApi from '@/api/genre'

const state = {
    data: null,
    isLoading: false,
    validationErrors: null,
    isSubmitting: false
}

export const mutationTypes = {
    genreListStart: '[genre] Get genre list start',
    genreListSuccess: '[genre] Get genre list success',
    genreListFailure: '[genre] Get genre list failure',
    genreAddStart: '[genre] Add genre start',
    genreAddSuccess: '[genre] Add genre success',
    genreAddFailure: '[genre] Add genre failure',
}

export const actionTypes = {
    genreList: '[genre] Get genre',
    genreAdd: '[genre] Add genre',
}

const mutations = {
    [mutationTypes.genreListStart](state) {
        state.isLoading = true
        state.data = null
    },
    [mutationTypes.genreListSuccess](state, payload) {
        state.isLoading = false
        state.data = payload
        state.validationErrors = null
    },
    [mutationTypes.genreListFailure](state,payload) {
        state.isLoading = false
        state.validationErrors = payload
    },

    [mutationTypes.genreAddStart](state) {
        state.isLoading = true
        state.data = null
    },
    [mutationTypes.genreAddSuccess](state, payload) {
        state.isLoading = false
        state.data = payload
        state.validationErrors = null
    },
    [mutationTypes.genreAddFailure](state,payload) {
        state.isLoading = false
        state.validationErrors = payload
    },
}

const actions = {
    [actionTypes.genreList](context, data) {
        return new Promise(resolve => {
            context.commit(mutationTypes.genreListStart)
            genreApi
                .genreList(data)
                .then(response => {
                    context.commit(mutationTypes.genreListSuccess, response)
                    resolve(response)
                })
                .catch(response => {
                    context.commit(mutationTypes.genreListFailure,response)
                })
        })
    },
    [actionTypes.genreAdd](context, data) {
        return new Promise(resolve => {
            context.commit(mutationTypes.genreAddStart)
            genreApi
                .genreAdd(data)
                .then(response => {
                    context.commit(mutationTypes.genreAddSuccess, response)
                    resolve(response)
                })
                .catch(response => {
                    context.commit(mutationTypes.genreAddFailure,response)
                })
        })
    },
}

export default {
    state,
    actions,
    mutations
}