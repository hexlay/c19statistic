import Vue from 'vue'
import Vuex from 'vuex'

// Modules
import auth from './modules/auth'
import statistic from './modules/statistic'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        statistic,
    },
    strict: process.env.DEV,
})
