<script>
import SideNav from '../Dashboard/components/SideNav.vue';
export default {
    data() {
        return {
            openTicket: false
        }
    },
    components: {
        SideNav
    },
    methods: {
        toggleTicket() {
            this.openTicket = true
        },
        closeTicket() {
            this.openTicket = false
        }
    }
}

</script>

<template>
    <div class="main-section">
        <SideNav />
        <div class="dash-main">
            <div class="tickets-container">
                <div class="tickets-sort">
                    <div class="ticket-sort-holder">
                        <i class='bx bxs-plane-take-off'></i>
                        <p>Adventure</p>
                    </div>
                </div>

                <div class="applied-tickets">
                    <span>Applied Tickets</span>
                    <div class="applied-tickets-container">
                        <div class="tickets-holder">
                            <!-- start -->
                            <div @click="toggleTicket" class="tickets-item">
                                <div class="tickets-heading-status">
                                    <span>DevOps Summit 2023</span>
                                    <p>Pending</p>
                                </div>
                                <p>A gathering of leading tech visionaries discussing the future of innovation</p>
                            </div>

                        </div>
                        <div v-if="openTicket" class="event-more-desc">
                            <i @click="closeTicket" class='bx bx-x close-event-desc'></i>
                            <div class="ticket-details">
                                <div class="ticket-status">
                                    <h5>DevOps Summit 2023</h5>
                                    <div class="ticket-status-holder">
                                        <p>Date Applied</p>
                                        <span>3May 2023</span>
                                    </div>
                                    <div class="ticket-status-holder">
                                        <p>Status</p>
                                        <span>pending</span>
                                    </div>
                                    <div class="ticket-status-holder">
                                        <p>Cash</p>
                                        <span>1000</span>
                                    </div>
                                </div>

                                <div class="ticket-place">
                                    <div class="ticket-place-holder">
                                        <p>Venue</p>
                                        <span>Nairobi, Kenya</span>
                                    </div>

                                    <div class="ticket-place-holder">
                                        <p>Address</p>
                                        <span>Ronald Ngara</span>
                                    </div>

                                    <div class="ticket-place-holder">
                                        <p>Time</p>
                                        <span>12:30pm, 20May,2023</span>
                                    </div>
                                </div>

                                <div class="ticket-actions">
                                    <button>Cancel</button>
                                    <button>Print</button>

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
@import url("./styles/tickets.css");
</style>