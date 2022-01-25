import axiosIns from '@libs/axios'
import router from '@/router'

export default {
    namespaced: true,
    state: {
        token: localStorage.getItem('token'),
        tokenType: localStorage.getItem('token-type'),
        user: JSON.parse(localStorage.getItem('user-data')),
        isLoggedIn: !!((localStorage.getItem('user-data') && localStorage.getItem('token'))),
    },
    mutations: {
        AUTH_LOGIN(state, data) {
            state.token = data.token
            state.tokenType = data.token_type
            state.user = data.user
            state.isLoggedIn = true
            localStorage.setItem('token', state.token)
            localStorage.setItem('token-type', state.tokenType)
            localStorage.setItem('user-data', JSON.stringify(state.user))
            router.replace({ name: 'home' })
        },
        AUTH_LOGOUT(state) {
            state.token = null
            state.tokenType = null
            state.user = null
            state.isLoggedIn = false
            localStorage.removeItem('token')
            localStorage.removeItem('token-type')
            localStorage.removeItem('user-data')
            router.replace({ name: 'login' })
        },
    },
    actions: {
        login({ commit }, payload) {
            return axiosIns.post('/auth/login', payload).then(response => {
                commit('AUTH_LOGIN', response.data.data)
            })
        },
        logout({ commit }) {
            return axiosIns.get('/auth/logout').then(() => {
                commit('AUTH_LOGOUT')
            })
        },
    },
}
