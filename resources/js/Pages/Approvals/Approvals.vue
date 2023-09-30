<script>
import SideNav from '../Dashboard/components/SideNav.vue';
export default {
    data() {
        return {
            approval: false

        }
    },
    components: {
        SideNav
    },
    methods: {
        openApproval() {
            this.approval = true
        },
        closeApproval() {
            this.approval = false
        }
    }
}

</script>

<template>
    <div class="main-section">
        <SideNav />
        <div class="dash-main">
            <div class="approve-tickets-container">
                <span>Future Events</span>
                <div class="future-events-holder">
                    <div class="events-item-holder event-container">

                        <div @click="openApproval" class="card" style="">
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
                                <div class="future-events-buttons">
                                    <button @click="openApproval">View Applicants</button>
                                    <button>Approve All</button>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div v-if="approval" class="event-more-desc events-participants">
                        <i @click="closeApproval" class='bx bx-x close-event-desc'></i>
                        <div class="evemts-part-header">
                            <span>Applicants</span>
                            <button>Select All</button>
                        </div>
                        <form class="events-part-content">

                            <div class="event-part-item">
                                <div class="part-name">
                                    <span>Edwin pip</span>
                                    <p>12May,2023</p>
                                </div>
                                <div class="part-action">
                                    <button>view</button>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                </div>
                            </div>

                        </form>
                        <button class="approve-btn">Approve</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<style>
@import url("./styles/approval.css");
/* @import url("../Events/styles/events.css"); */
</style>