<template>
    <router-view/>
</template>

<script>
export default {
    created() {
        this.$http.interceptors.request.use(
            config => {
                const {tokenType, token} = this.$store.state.auth

                if (token) {
                    // eslint-disable-next-line no-param-reassign
                    config.headers.Authorization = `${tokenType} ${token}`
                }
                return config
            },
            error => Promise.reject(error),
        )

        this.$http.interceptors.response.use(response => response, error => {
            const {isLoggedIn} = this.$store.state.auth
            if (isLoggedIn && error.response.status === 401) {
                this.$store.commit('auth/AUTH_LOGOUT')
            }
            if (error.response.data.message) {
                this.$toast.error(error.response.data.message)
            }
            if (error.response.data.data) {
                return Promise.reject(error.response.data.data)
            }
            return Promise.reject(error)
        })
    },
}
</script>
