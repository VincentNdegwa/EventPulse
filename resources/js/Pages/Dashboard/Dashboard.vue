<script>
import SideNav from './components/SideNav.vue';
import DashMain from "./layouts/DashMain.vue"
import Loader from '@/components/Loader.vue';
import SweetAlerts from '@/components/SweetAlerts.vue';
export default {
    props: {
        userId: Number,
    },
    data() {
        return {
            user_id: ""
        }
    },
    components: {
        SideNav,
        DashMain,
        Loader,
        SweetAlerts
    }, mounted() {
        this.requestData()
        let loginStatus = localStorage.getItem("login")
        if (loginStatus) {
            let status = JSON.parse(loginStatus).login
            if (status) {
                this.$refs.sweetAlert.showNotification("You are signed in")
                localStorage.removeItem("login")
            }
        }
        let user = localStorage.getItem("user_details");
        if (user) {
            let user_id = JSON.parse(user).user_id;
            this.user_id = user_id
        }
    }, methods: {
        requestData() {

        }
    }
}
</script>

<template>
    <SweetAlerts ref="sweetAlert"></SweetAlerts>
    <section class="loading-section" v-if="false">
        <Loader />
    </section>
    <section class="main-section">
        <SideNav />
        <DashMain />
    </section>
</template>
<style>
@import url("../../../css/app.css");
@import url("./styles/sidenav.css");
</style>