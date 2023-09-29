<script>
import SideNav from "../Dashboard/components/SideNav.vue"
import MyEventsHeader from "./components/MyEventsHeader.vue";
export default {
    components: {
        SideNav,
        MyEventsHeader
    }
}
</script>
<template>
    <SideNav />
    <div class="dash-main">
        <div class="events-container">
            <MyEventsHeader />
            <div class="event-body">
            </div>
        </div>
    </div>
</template>

<style>
@import url("../Events/styles/event-header.css");
</style>