<script>
import SideNav from './components/SideNav.vue';
import DashMain from "./layouts/DashMain.vue"
import Loader from '@/components/Loader.vue';
export default {
    data() {

    },
    components: {
        SideNav,
        DashMain,
        Loader
    }, mounted() {
        this.requestData()
    }, methods: {
        requestData() {
            console.log("hello dash")
        }
    }
}
</script>

<template>
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