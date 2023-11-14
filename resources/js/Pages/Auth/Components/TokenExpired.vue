<script>
export default {
    methods: {
        requestToken() {
            window.location.href = "/register"
        },
        goHome() {
            window.location.href = "/"
        }
    }
}
</script>
<template>
    <section class="section-small">
        <h1 class="oops-icon"><i class='bx bx-x-circle'></i></h1>
        <h4 class="oops-text">Oops!</h4>
        <h2 class="normal-text status-text">Verification Token Expired</h2>
        <p class="normal-text paragraph-text">Your verification token has expired. Please request a new verification token.
        </p>
        <div class="holder-butttons">
            <button @click="goHome" class="request-button home-buuton">Home</button>
            <button @click="requestToken" class="request-button">Request</button>
        </div>
    </section>
</template>
<style>
.section-small {
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: 1px 4px 3px rgba(0, 0, 0, 0.3);
    max-width: 1500px !important;
    width: 100%;
}

.oops-icon>i {
    font-size: 2em;
    color: red;
}

.oops-text {
    color: red;
}

.normal-text {
    color: var(--main-blue);
}

.paragraph-text,
.status-text {
    width: 90%;
    text-align: center;
}

.request-button {
    background-color: var(--main-green);
    padding: 1em;
    border-radius: 0.3em;
    color: var(--main-white);
}

.home-buuton {
    background-color: var(--main-blue);
}

.holder-butttons {
    width: 60%;
    display: flex;
    gap: 1em;
    justify-content: space-evenly;
}

.holder-butttons>* {
    width: 90%;
}

.holder-butttons>*:hover {
    transition: all ease 1s;
    background-color: var(--main-orange);
}

@media screen and (max-width:400px) {

    .holder-butttons {
        width: 98%;
        flex-direction: column;
        align-items: center;
    }

}
</style>