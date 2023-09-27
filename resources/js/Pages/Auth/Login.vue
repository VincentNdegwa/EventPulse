<script>
export default {
    data() {
        return {

        }
    },
    methods: {
        redirectToRegister() {
            window.location.href = "/register"
        }
    }
}
</script>

<template>
    <div class="login_main">

        <div class="login_details">
            <h1>
                Welcome to our EventPulse, where you can access exclusive content and personalized features for an enriched
                event experience
            </h1>
            <button @click="redirectToRegister" class="button_register" type="button">Register</button>

        </div>


        <div class="login_form_holder login-main-container">
            <div class="form_holder">
                <form action="" class="form_main form-control">
                    <div class="mb-3 input_label">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="test@gmail.com">
                    </div>
                    <div class="mb-3 input_label">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pass">
                    </div>
                    <span class="forgot-text">Forgot password?</span>
                    <div class="mb-3 input_label login-button">
                        <button class="button_login" type="button">Login</button>
                    </div>
                    <div class="mb-3 input_label">
                        <button @click="redirectToRegister" class="button_register reg_hidden"
                            type="button">Register</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="back-icon">
            <i class='bx bx-left-arrow-alt'></i>
        </div>

    </div>
</template>
<style>
@import url("./styles/login.css");
</style>