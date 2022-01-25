import Vue from 'vue'
import App from '@/App'

// Bootstrap imports
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Lib imports
import i18n from '@libs/i18n'
import axiosInst from '@libs/axios'
import router from '@/router'
import store from '@/store'

// Argon component imports
import Card from '@/components/Cards/Card'
import StatsCard from '@/components/Cards/StatsCard'
import BaseHeader from '@/components/BaseHeader'
import BaseNav from '@/components/Navbar/BaseNav'

// Asset imports
import '@/assets/argon.scss'

// Validation imports
import {ValidationObserver, ValidationProvider} from 'vee-validate'

// Toast imports
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

// Bootstrap
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

// Toast
Vue.use(Toast, {
    hideProgressBar: true,
    icon: false,
    timeout: 3000,
    transition: 'Vue-Toastification__fade',
})

// Argon components
Vue.component(Card.name, Card)
Vue.component(StatsCard.name, StatsCard)
Vue.component(BaseHeader.name, BaseHeader)
Vue.component(BaseNav.name, BaseNav)

// Validation
Vue.component('validation-provider', ValidationProvider)
Vue.component('validation-observer', ValidationObserver)

new Vue({
    axiosInst,
    router,
    store,
    i18n,
    render: h => h(App),
}).$mount('#app')
