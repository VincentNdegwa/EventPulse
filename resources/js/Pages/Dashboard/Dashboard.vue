<script>
import SideNav from './components/SideNav.vue';
import DashMain from "./layouts/DashMain.vue"
import Loader from '@/components/Loader.vue';
import SweetAlerts from '@/components/SweetAlerts.vue';
import axios from 'axios';
export default {
    props: {
        userId: Number,
    },
    data() {
        return {
            user_id: "",
            dashData: {},
            loading: false
        }
    },
    components: {
        SideNav,
        DashMain,
        Loader,
        SweetAlerts
    }, mounted() {
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
        this.requestData()
    }, methods: {
        requestData() {
            this.loading = true
            axios.post("api/dashboard/retrieve", { user_id: this.user_id }).then(res => {
                if (!res.data.error) {
                    this.dashData = res.data
                    this.loading = false
                    console.log(res.data)
                }
            }).catch(err => {
                console.log(err)
                this.$refs.sweetAlert.showMessage("An error occurred")
            })
        }
    }
}
</script>

<template>
    <SweetAlerts ref="sweetAlert"></SweetAlerts>
    <Loader :loading="loading" />
    <section class="main-section">
        <SideNav />
        <DashMain :dashData="dashData" />
    </section>
</template>
<style>
@import url("../../../css/app.css");
@import url("./styles/sidenav.css");
</style>