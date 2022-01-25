import axiosIns from '@libs/axios'

export default {
    namespaced: true,
    state: {
        countryData: [],
        summary: {
            deaths: '0',
            confirmed: '0',
            recovered: '0'
        },
    },
    mutations: {
        SET_COUNTRY_DATA(state, data) {
            state.countryData = data
        },
        SET_SUMMARY(state, data) {
            state.summary = data
        },
    },
    actions: {
        fetchCountryData({ commit }) {
            return axiosIns.get('/country-data').then(response => {
                commit('SET_COUNTRY_DATA', response.data.data)
            })
        },
        fetchSummary({ commit }) {
            return axiosIns.get('/summary').then(response => {
                const summary = response.data.data
                commit('SET_SUMMARY', {
                    deaths: summary.deaths.toString(),
                    confirmed: summary.confirmed.toString(),
                    recovered: summary.recovered.toString(),
                })
            })
        },
    },
}
