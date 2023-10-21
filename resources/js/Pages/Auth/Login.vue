<script>
import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'
import axios from 'axios'
import nprogress from 'nprogress';
import SweetAlerts from '@/components/SweetAlerts.vue';
export default {
    data() {
        return {
            FormData: {
                "email": "",
                "password": ""
            },
            response: {
                "error": false,
                "message": ""
            }
        }
    },
    methods: {
        redirectToRegister() {
            window.location.href = "/register"
        },
        submitForm() {
            nprogress.start();
            axios.post("/user/login", this.FormData)
                .then(res => {
                    if (res.data?.error === false) {
                        this.response = {
                            error: false,
                            message: ""
                        };
                        localStorage.setItem("user_details", JSON.stringify({ user_id: res.data.data.id }));
                        localStorage.removeItem("user")
                        localStorage.setItem("user", JSON.stringify(res.data.data));
                        // console.log(res.data.data)

                        this.navigateDash();
                    } else {
                        this.$refs.sweetAlerts.showNotificationError(res.data.message)
                    }
                    nprogress.done();
                })
                .catch(err => {
                    nprogress.done();
                    console.error(err);
                });
        },

        navigateDash() {
            router.visit("/dashboard");
            localStorage.setItem("login", JSON.stringify({ login: true }))
        }

    },
    components: {
        SweetAlerts
    },
}
</script>

<template>
    <SweetAlerts ref="sweetAlerts"></SweetAlerts>
    <section class="main_section login-section">
        <div class="login_main">
            <!-- <span v-if="response.error" class="error-disp">{{ response.message }}</span> -->

            <div class="login_details">
                <h1>
                    Welcome to our EventPulse, where you can access exclusive content and personalized features for an
                    enriched
                    event experience
                </h1>
                <button @click="redirectToRegister" class="button_register" type="button">Register</button>

            </div>


            <div class="login_form_holder login-main-container">
                <div class="form_holder">
                    <form @submit.prevent="submitForm" action="" class="form_main form-control">
                        <div class="mb-3 input_label">
                            <label for="email" class="form-label">Email address</label>
                            <input v-model="FormData.email" type="email" class="form-control" id="email"
                                placeholder="test@gmail.com">
                        </div>
                        <div class="mb-3 input_label">
                            <label for="pass" class="form-label">Password</label>
                            <input v-model="FormData.password" type="password" class="form-control" id="pass">
                        </div>
                        <span class="forgot-text">Forgot password?</span>
                        <div class="mb-3 input_label login-button">
                            <button class="button_login" type="button" @click="submitForm">Login</button>
                        </div>
                        <div class="mb-3 input_label">
                            <button @click="redirectToRegister" type="button"
                                class="button_register reg_hidden">Register</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="back-icon">
                <i class='bx bx-left-arrow-alt'></i>
            </div>

        </div>
    </section>
</template>
<style>
@import url("./styles/login.css");
</style>