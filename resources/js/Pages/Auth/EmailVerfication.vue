<script>
import SweetAlerts from '@/components/SweetAlerts.vue'
import axios from 'axios'
export default {
    data() {
        return {
            email: "",
            buttonsDisabled: false,
            loading: false,
            sent: false,
            failed: false
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
                this.loading = true
                this.requestSend(this.email)
            } else {
                this.$refs.SweetAlerts.showNotificationError('Invalid Email')
            }
        },
        requestSend(email) {
            axios.post("api/email/verify", { email: email }).then((res) => {
                if (res.data.error) {
                    this.$refs.SweetAlerts.showNotificationError("Failed to send, " + res.data.message)
                    this.failed = true
                } else {
                    this.$refs.SweetAlerts.showNotification(res.data.message)
                    this.sent = true
                    this.failed = false
                }
                console.log(res.data)
            }).catch((err) => {
                this.$refs.showMessage(err)
                this.failed = true
            })

        }
        , goBack() {
            window.history.back()
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

        <span v-if="loading && !sent && !failed" class="loader-icon"></span>
        <form v-if="(!loading && !sent) || failed" @submit.prevent="submitForm" class="verification-form">
            <div class="mb-3 input_label">
                <input v-model="email" type="email" class="form-control" placeholder="Enter your active email address"
                    id="pass" required>
            </div>
            <div class="button-container">
                <button :disabled="buttonsDisabled" class="verification-button verification-cancel" @click="goBack"
                    type="button">Cancel</button>
                <button :disabled="buttonsDisabled" class="verification-button verification-send" type="submit">Send
                    Email</button>
            </div>
        </form>
        <h4 v-if="sent" class="sent-message">Email Sent to {{ email }}</h4>
    </section>
</template>
<style>
.header-ver {
    color: var(--main-blue);
    margin-top: 2em;
}

.sent-message {
    color: var(--main-orange);
    margin-top: 3em;
}

.section-email-ver {
    height: 100vh;
    display: flex;
    max-width: 1500px !important;
    width: 100%;
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

.loader-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: inline-block;
    border-top: 4px solid var(--main-blue);
    border-right: 4px solid transparent;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
}

.loader-icon::after {
    content: '';
    box-sizing: border-box;
    position: absolute;
    left: 0;
    top: 0;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border-left: 4px solid var(--main-orange);
    border-bottom: 4px solid transparent;
    animation: rotation 0.5s linear infinite reverse;
}

.verification-button {
    color: var(--main-white) !important;
}

.verification-button:hover {
    background-color: var(--main-blue);
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
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