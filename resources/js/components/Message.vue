<script>
export default {
    props: {
        message: String,
        error: Boolean
    }, data() {
        return {
        }
    }, mounted() {
        setTimeout(() => {
            this.message = ""
        }, 5000);
    },
}
</script>
<template>
    <div v-if="message != ''" :class="{ 'message_holder error': error, 'message_holder message': !error }">
        <p>{{ message }}</p>
    </div>
</template>
<style>
.message_holder {
    width: 30%;
    height: auto;
    position: fixed;
    top: 0.5em;
    left: 30%;
    z-index: 50;
    padding: 0.5em;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--main-white);
}

.error {
    background: red;
}

.message {
    background: var(--main-green);
}

@media screen and (max-width:950px) {
    .message_holder {
        min-width: 50%;
        left: 25%;
    }
}

@media screen and (max-width:500px) {
    .message_holder {
        min-width: 70%;
        right: 0;
    }
}
</style>
