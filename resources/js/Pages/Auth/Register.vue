<script>
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import axios from 'axios';
import nprogress from 'nprogress';
export default {
    data() {
        return {
            form: {
                "username": "",
                "email": "",
                "password": "",
                "passwordConf": ""
            }
        };
    },

    methods: {
        redirectToLogin() {
            window.location.href = "/login"
        },
        submitForm() {
            nprogress.start()
            axios.post("api/user/register", this.form).then(res => {
                nprogress.done()

                console.log(res.data)
            }).catch(err => {
                nprogress.done()
                console.log(err)
            })
        }
    }
}
</script>

<template>
    <section class="main_section">
        <div class="login_main">

            <div class="login_details">
                <h1>
                    Welcome to our EventPulse, where you can access exclusive content and personalized features for an
                    enriched
                    event experience
                </h1>
                <button @click="redirectToLogin" class="button_register" type="button">Login</button>

            </div>


            <div class="login_form_holder">
                <div class="form_holder">
                    <form class="form_main form-control">
                        <div class="mb-3 input_label">
                            <label for="username" class="form-label">username</label>
                            <input v-model="form.username" type="text" class="form-control" id="username"
                                placeholder="Bill">
                        </div>
                        <div class="mb-3 input_label">
                            <label for="email" class="form-label">Email address</label>
                            <input v-model="form.email" type="email" class="form-control" id="email"
                                placeholder="test@gmail.com">
                        </div>
                        <div class="mb-3 input_label">
                            <label for="pass" class="form-label">Password</label>
                            <input v-model="form.password" type="password" class="form-control" id="pass">
                        </div>
                        <div class="mb-3 input_label">
                            <label for="pass" class="form-label">Password Confirmation</label>
                            <input v-model="form.passwordConf" type="password" class="form-control" id="pass">
                        </div>
                        <div class="mb-3 input_label login-button">
                            <button @click="submitForm" class="button_login" type="button">Register</button>
                        </div>
                        <div class="mb-3 input_label">
                            <button @click="redirectToLogin" class="button_register reg_hidden" type="button">Login</button>
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