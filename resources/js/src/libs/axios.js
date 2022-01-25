import Vue from 'vue'

import axios from 'axios'

const axiosIns = axios.create({
    baseURL: process.env.MIX_API_URL,
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
})

Vue.prototype.$http = axiosIns

export default axiosIns
