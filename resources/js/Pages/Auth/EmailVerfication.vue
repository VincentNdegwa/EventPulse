<script>
import SweetAlerts from '@/components/SweetAlerts.vue'
export default {
    data() {
        return {
            email: "",
            buttonsDisabled: false
        }
    },
    components: {
        SweetAlerts
    },
    methods: {
        validate(email) {
            let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
            if (regex.test(email)) {
                return true
            } else {
                return false
            }
        },
        submitForm(event) {
            if (this.validate(this.email)) {
                this.requestSend(this.email)
            } else {
                this.$refs.SweetAlerts.showNotificationError('Invalid Email')
            }
        },
        requestSend(email) {
            this.$refs.SweetAlerts.showNotification("Email Sent" + email)
        }
    }
}
</script>

<template>
    <SweetAlerts ref="SweetAlerts"></SweetAlerts>
    <section class="section-email-ver">
        <h3 class="header-ver">Email Verification</h3>
        <p class="desc-email-pupose">Please enter your email address in the field below. We'll use this email to send you
            important updates and
            notifications.</p>
        <form @submit.prevent="submitForm" class="verification-form">
            <div class="mb-3 input_label">
                <input v-model="email" type="email" class="form-control" placeholder="Enter your active email address"
                    id="pass" required>
            </div>
            <div class="button-container">
                <button :disabled="buttonsDisabled" class="verification-cancel" type="button">Cancel</button>
                <button :disabled="buttonsDisabled" class="verification-send" type="submit">Send Email</button>
            </div>
        </form>
    </section>
</template>
<style>
.header-ver {
    color: var(--main-blue);
    margin-top: 2em;
}

.section-email-ver {
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 2px 3px 4px rgba(0, 0, 0, 0.3);
}

.desc-email-pupose {
    width: 70%;
    text-align: center;
    margin-top: 1em;
    color: var(--main-green);
}

.verification-form {
    width: 60%;
    height: fit-content;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 10%;
}

.input_label {
    width: 100%;
}

.button-container {
    width: 100%;
    height: fit-content;
    display: flex;
    gap: 1em;
    justify-content: space-evenly;
}


.verification-cancel {
    padding: 1em;
    width: 100%;
    background-color: var(--main-green);
    color: var(--main-white);
    border-radius: 1em;
}

.verification-send {
    padding: 1em;
    width: 100%;
    background-color: var(--main-orange);
    color: var(--main-white);
    border-radius: 1em;
}


@media screen and (max-width:600px) {
    .desc-email-pupose {
        width: 90%;

    }

    .verification-form {
        width: 95%;
    }

}

@media screen and (max-width:400px) {


    .button-container {
        width: 100%;
        margin-top: 1em;
        height: fit-content;
        display: flex;
        flex-direction: column;
        gap: 1em;
        justify-content: space-evenly;
    }

    .verification-send,
    .verification-cancel {
        padding: 0.5em;
    }

    .desc-email-pupose {
        font-size: 0.8em;
    }
}
</style>