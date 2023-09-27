<script>
import MainPage from './pages/Home/MainPage.vue';
import Login from './pages/Auth/Login.vue';
import Regster from './pages/Auth/Register.vue'
export default {
    data() {
        return {

        }
    },
    components: {
        MainPage,
        Login,
        Regster
    }
}
</script>

<template>
    <div>
        <MainPage />
        <Login />
        <Regster/>
    </div>
</template>