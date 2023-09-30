<script>
export default {

}
</script>

<template>
    <span class="loader"></span>
</template>
<style>
.loading-section {
    position: fixed;
    width: 100%;
    height: 100vh;
    display: grid;
    place-items: center;
    z-index: 20;
    background: linear-gradient(10deg, var(--main-orange), var(--main-blue));
}

.loader {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: inline-block;
    border: 2px solid #FF3D00;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
}

.loader::after {
    content: '';
    box-sizing: border-box;
    position: absolute;
    left: 4px;
    top: 4px;
    border: 2px solid #FFF;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>