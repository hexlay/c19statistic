import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '@/store'

// Routes
import auth from './routes/auth'
import pages from './routes/pages'
import errors from './routes/errors'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        ...auth,
        ...pages,
        ...errors,
        {
            path: '*',
            redirect: 'error-404',
        },
    ],
})

router.beforeEach((to, _, next) => {
    const {isLoggedIn} = store.state.auth

    if (!isLoggedIn && to.name !== 'login') {
        return next({ name: 'login' })
    }

    if (to.meta.redirectIfLogged && isLoggedIn) {
        next({ name: 'home' })
    }

    return next()
})

export default router
