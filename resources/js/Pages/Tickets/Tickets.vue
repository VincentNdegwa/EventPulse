<script>
import SideNav from '../Dashboard/components/SideNav.vue';
import SweetAlerts from '@/components/SweetAlerts.vue';
import axios from 'axios';
import dayjs from 'dayjs';
import relativeTime from "dayjs/plugin/relativeTime"
export default {
    data() {
        return {
            openTicket: false,
            user_id: "",
            ticketsData: [],
            eventData: {}
        }
    },
    components: {
        SideNav,
        SweetAlerts
    },
    methods: {
        toggleTicket(id) {
            this.openTicket = !this.openTicket
            let clickedData = this.ticketsData.find((item) => item.event_application_id == id)
            this.eventData = clickedData
            console.log(this.eventData)
        },
        closeTicket() {
            this.openTicket = false
        }, requestData() {
            axios.post("api/applicant/tickets", { user_id: this.user_id }).then(res => {
                if (res.data.error) {
                    this.$refs.sweetAlerts.showMessage("An error occured, Please try again later");
                } else {
                    this.ticketsData = res.data.data;
                }
                // console.log(res.data.data)
            }).catch(err => {
                console.log(err)
                this.$refs.sweetAlerts.showMessage("An error occured, Please try again later");
            })
        }, readableDate(date) {
            dayjs.extend(relativeTime)
            return dayjs(date).fromNow()
        }
    }, mounted() {
        let user = localStorage.getItem("user_details");

        if (user) {
            let user_id = JSON.parse(user).user_id;
            this.user_id = user_id
        }
        this.requestData()
    }
}

</script>

<template>
    <div class="main-section">
        <SideNav />
        <SweetAlerts ref="sweetAlerts"></SweetAlerts>
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
                            <div @click="toggleTicket(item.event_application_id)" class="tickets-item"
                                v-for="(item, index) in ticketsData" :key="index">
                                <div class="tickets-heading-status">
                                    <span>{{ item.event.title }}</span>
                                    <p>{{ item.status }}</p>
                                </div>
                                <p>{{ item.event.description }}</p>
                            </div>

                        </div>
                        <div v-if="openTicket" class="event-more-desc">
                            <i @click="closeTicket" class='bx bx-x close-event-desc'></i>
                            <div class="ticket-details">
                                <div class="ticket-status">
                                    <h5>DevOps Summit 2023</h5>
                                    <div class="ticket-status-holder">
                                        <p>Date Applied</p>
                                        <span>{{ readableDate(eventData.created_at) }}</span>
                                    </div>
                                    <div class="ticket-status-holder">
                                        <p>Status</p>
                                        <span>{{ eventData.status }}</span>
                                    </div>
                                    <div class="ticket-status-holder">
                                        <p>Cash</p>
                                        <span>{{ eventData.event.price }}</span>
                                    </div>
                                </div>

                                <div class="ticket-place">
                                    <div class="ticket-place-holder">
                                        <p>Venue</p>
                                        <span>{{ eventData.event.venue }}</span>
                                    </div>

                                    <div class="ticket-place-holder">
                                        <p>Address</p>
                                        <span>{{ eventData.event.address }}</span>
                                    </div>

                                    <div class="ticket-place-holder">
                                        <p>Time</p>
                                        <span>{{ readableDate(eventData.event.event_date) }}</span>
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