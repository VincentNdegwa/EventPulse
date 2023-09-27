<script>
export default {
    data() {
        return {

        }
    },
    methods: {
        redirectToLogin() {
            window.location.href = "/login"
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
            <button @click="redirectToLogin" class="button_register" type="button">Login</button>

        </div>


        <div class="login_form_holder">
            <div class="form_holder">
                <form action="" class="form_main form-control">
                    <div class="mb-3 input_label">
                        <label for="username" class="form-label">username</label>
                        <input type="text" class="form-control" id="username" placeholder="Bill">
                    </div>
                    <div class="mb-3 input_label">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="test@gmail.com">
                    </div>
                    <div class="mb-3 input_label">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pass">
                    </div>
                    <div class="mb-3 input_label">
                        <label for="pass" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" id="pass">
                    </div>
                    <div class="mb-3 input_label login-button">
                        <button class="button_login" type="button">Register</button>
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
</template>
<style>
@import url("./styles/login.css");
</style>