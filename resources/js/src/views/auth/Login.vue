<template>
    <div class="main-content bg-default full-page">
        <!-- Header -->
        <div class="header bg-gradient-success py-7 py-lg-8 pt-lg-9">
            <b-container>
                <div class="header-body text-center mb-7">
                    <b-row class="justify-content-center">
                        <b-col class="px-5" lg="6" md="8" xl="5">
                            <h1 class="text-white">{{ $t('site-name') }}</h1>
                        </b-col>
                    </b-row>
                </div>
            </b-container>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" xmlns="http://www.w3.org/2000/svg"
                     y="0">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <b-container class="mt--8 pb-5">
            <b-row class="justify-content-center">
                <b-col lg="5" md="7">
                    <b-card class="bg-secondary border-0 mb-0" no-body>
                        <b-card-body class="px-lg-5 py-lg-5">
                            <validation-observer ref="formValidation">
                                <b-form
                                    class="auth-login-form mt-2"
                                    @submit.prevent>
                                    <!-- email -->
                                    <b-form-group
                                        :label="$t('email')"
                                        label-for="login-email">
                                        <validation-provider
                                            #default="{ errors }"
                                            :name="$t('email')"
                                            rules="required|email"
                                            vid="email">
                                            <b-form-input
                                                id="login-email"
                                                v-model="email"
                                                :state="errors.length > 0 ? false:null"
                                                name="login-email"
                                                placeholder="john@example.com"/>
                                            <small class="text-danger">{{ errors[0] }}</small>
                                        </validation-provider>
                                    </b-form-group>

                                    <!-- forgot password -->
                                    <b-form-group
                                        :label="$t('password')"
                                        label-for="login-password">
                                        <validation-provider
                                            #default="{ errors }"
                                            :name="$t('password')"
                                            rules="required|min:6"
                                            vid="password">
                                            <b-form-input
                                                id="login-password"
                                                v-model="password"
                                                :state="errors.length > 0 ? false:null"
                                                name="login-password"
                                                placeholder="············"
                                                type="password"/>
                                            <small class="text-danger">{{ errors[0] }}</small>
                                        </validation-provider>
                                    </b-form-group>

                                    <!-- submit buttons -->
                                    <b-button
                                        block
                                        type="submit"
                                        variant="primary"
                                        @click="validationForm">
                                        {{ $t('sign-in') }}
                                    </b-button>
                                </b-form>
                            </validation-observer>
                        </b-card-body>
                    </b-card>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>
<script>
import '@libs/validations'

export default {
    data() {
        return {
            email: '',
            password: '',
        };
    },
    methods: {
        validationForm() {
            this.$refs.formValidation.validate().then(success => {
                if (success) {
                    this.$store.dispatch('auth/login', {
                        email: this.email,
                        password: this.password,
                    }).catch(error => {
                        this.$refs.formValidation.setErrors(error)
                    })
                }
            })
        },
    }
};
</script>
<style>
.full-page {
    height: 100vh;
}
</style>
