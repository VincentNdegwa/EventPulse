<script>
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import axios from 'axios';
import nprogress from 'nprogress';
import SweetAlerts from '@/components/SweetAlerts.vue';
export default {
    props: ["emailProp"],
    data() {
        return {
            form: {
                "username": "",
                "email": this.emailProp,
                "password": "",
                "passwordConf": ""
            },
            message: ""
        };
    },

    methods: {
        redirectToLogin() {
            window.location.href = "/login"
        },
        validate(data) {
            if (data) {
                if (data.username.trim() && data.email.trim() && data.password.trim() && data.passwordConf.trim()) {
                    if (data.password === data.passwordConf) {
                        if (data.password.length >= 6) {
                            this.message = ""
                            return true
                        } else {
                            this.message = "Password should be more than 6 characters"
                        }
                    } else {
                        this.message = "Password did not match"
                    }
                }
            }
            return false
        },
        submitForm() {
            nprogress.start()
            if (this.validate(this.form)) {
                axios.post("/api/user/register", this.form).then(res => {
                    nprogress.done()
                    if (!res.data.error) {
                        localStorage.setItem("user_details", JSON.stringify({ user_id: res.data.data.id }));
                        this.navigateDash(res.data.data.email, res.data.pass)
                    } else {
                        this.$refs.sweetAlert.showNotificationError(res.data.message)
                        console.log(res.data)
                    }
                }).catch(err => {
                    nprogress.done()
                    console.log(err)
                })
            } else {
                this.$refs.sweetAlert.showNotificationError(this.message)
            }
        },
        navigateDash(email, password) {
            nprogress.start();
            axios.post("/user/login", {
                email: email,
                password: password
            })
                .then(res => {
                    if (res.data?.error === false) {
                        this.response = {
                            error: false,
                            message: ""
                        };
                        router.visit("/dashboard");
                        localStorage.setItem("login", JSON.stringify({ login: true }))
                        localStorage.removeItem("user")
                        localStorage.setItem("user"), JSON.stringify(res.data.data);

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
        navBack() {
            window.history.back()
        }
    },
    components: {
        SweetAlerts
    }
}
</script>

<template>
    <SweetAlerts ref="sweetAlert"></SweetAlerts>
    <section class="main_section login-section">
        <div class="login_main">

            <!-- <div class="login_details">
                <h1>
                    Welcome to our EventPulse, where you can access exclusive content and personalized features for an
                    enriched
                    event experience
                </h1>
                <button @click="redirectToLogin" class="button_register" type="button">Login</button>

            </div> -->


            <div class="login_form_holder login-main-container">
                <div class="form_holder">
                    <form class="form_main form-control">
                        <div class="mb-3 input_label">
                            <label for="username" class="form-label">username</label>
                            <input v-model="form.username" type="text" class="form-control" id="username"
                                placeholder="Bill">
                        </div>
                        <div class="mb-3 input_label" v-if="!emailProp">
                            <label for="email" class="form-label">Email address</label>
                            <input v-model="form.email" type="email" class="form-control" id="email"
                                placeholder="test@gmail.com" readonly hidden>
                        </div>
                        <div class="mb-3 input_label">
                            <label for="pass" class="form-label">Password</label>
                            <input v-model="form.password" type="password" class="form-control" id="pass">
                        </div>
                        <div class="mb-3 input_label">
                            <label for="pass" class="form-label">Password Confirmation</label>
                            <input v-model="form.passwordConf" type="password" class="form-control" id="pass1">
                        </div>
                        <div class="mb-3 input_label login-button">
                            <button @click="submitForm" class="button_login" type="button">Register</button>
                        </div>
                        <div class="mb-3 input_label">
                            <button @click="redirectToLogin" class="button_register" type="button">Login</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="back-icon" @click="navBack">
                <i class='bx bx-left-arrow-alt'></i>
            </div>

        </div>
    </section>
</template>
<style>
@import url("./styles/login.css");
</style>