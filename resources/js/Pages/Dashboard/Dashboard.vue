<script>
import SideNav from './components/SideNav.vue';
import DashMain from "./layouts/DashMain.vue"
export default {
    data() {

    },
    components: {
        SideNav,
        DashMain
    }
}
</script>

<template>
    <section class="main-section">
        <SideNav />
        <DashMain />
    </section>
</template>
<style>
@import url("../../../css/app.css");
@import url("./styles/sidenav.css");


</style>