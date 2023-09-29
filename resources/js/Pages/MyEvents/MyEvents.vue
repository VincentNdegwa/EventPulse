<script>
import SideNav from "../Dashboard/components/SideNav.vue"
import MyEventsHeader from "./components/MyEventsHeader.vue";
export default {
    data() {
        return {
            openMore: false
        }
    },
    components: {
        SideNav,
        MyEventsHeader
    },
    methods: {
        toggleMore() {
            this.openMore = true
        },
        closeMore() {
            this.openMore = false
        }
    }
}
</script>
<template>
    <div class="main-section">
        <SideNav />
        <div class="dash-main">
            <div class="events-container">
                <MyEventsHeader />
                <div class="event-body">
                    <div class="my-events-container">
                        <div class="my-events-cards-holder event-container">

                            <div @click="toggleMore" class="card" style="">
                                <img src="images/image2.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">Tech Innovators Symposium</p>
                                    <span>A gathering of leading tech visionaries discussing the future of innovation</span>
                                    <div class="event-desc-display">
                                        <span>Silicon Valley</span>
                                        <span>Technology</span>
                                        <p>12May,2023::12pm</p>
                                    </div>
                                    <h6>1000ksh</h6>
                                </div>
                            </div>


                        </div>
                        <div v-if="openMore" class="event-more-desc">
                            <i @click="closeMore" class='bx bx-x close-event-desc'></i>
                            <div class="events-details-display-action">
                                <div class="desc-card">
                                    <div class="desc-card-header">
                                        <v-avatar color="indigo"></v-avatar>
                                        <p>Tech Innovators Symposium</p>
                                    </div>
                                    <p class="desc-card-desc">A gathering of leading tech visionaries discussing the future
                                        of
                                        innovation</p>
                                    <div class="desc-card-participanats">
                                        <p>Participants</p>
                                        <p class="desc-card-partcipants">2.3k</p>
                                    </div>
                                    <div class="desc-card-price">
                                        <p>prices</p>
                                        <p class="desc-card-price">1000</p>
                                    </div>
                                    <div class="desc-card-payment">
                                        <p>E.P</p>
                                        <p class="desc-e-p">2.3M</p>
                                    </div>
                                </div>
                                <div class="event-details-buttons">
                                    <button>Update</button>
                                    <button>Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<style>
@import url("../Events/styles/event-header.css");
@import url("../Events//styles/events.css");
@import url("./styles/my-events.css");
</style>