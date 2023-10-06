<script>
import SideNav from '../Dashboard/components/SideNav.vue';
import axios from 'axios';
import SweetAlerts from '@/components/SweetAlerts.vue';
import ApplicantListForm from "./components/ApplicantListForm.vue"
import Loader from '@/components/Loader.vue';
import { router } from '@inertiajs/vue3';
export default {
    data() {
        return {
            approval: false,
            application: false,
            mainData: Array,
            applicants: Array,
            applicantDetails: Object,
            sendingData: [],
            event_id: "",
            loading: false
        }
    },
    components: {
        SideNav,
        SweetAlerts,
        ApplicantListForm,
        Loader
    },
    methods: {
        openApproval(id) {
            let data = this.mainData.find((item) => item.id == id)
            this.applicants = data.event_applicants;
            this.approval = true
            this.event_id = id
            this.application = false

            this.applicants.forEach((item) => {
                item.state = false;
            })
        },
        closeApproval() {
            this.approval = false
            this.application = false
        }, requestData() {
            this.loading = true
            axios.post("/user-id").then(res => {
                let userId = res?.data.userId
                axios.post("api/events/approvals", { user_id: userId }).then(res => {
                    if (!res.data.error) {
                        this.loading = false
                        this.mainData = res.data.data
                        if (res.data.data.length <= 0) {
                            this.$refs.sweetAlerts.showMessage("There are no applicants in your events")
                            // setTimeout(() => {
                            //     router.visit("/dashboard")
                            // }, 3000)
                        }
                    } else {
                        this.loading = false
                        this.$refs.sweetAlerts.showNotificationError("An error occured")
                        console.log(res.data.message)
                    }
                }).catch(err => {
                    this.loading = false
                    this.$refs.sweetAlerts.showNotificationError(err)
                    console.log(err)
                })
            }).catch(err => {
                this.loading = false
                this.$refs.sweetAlerts.showNotificationError(err)
                console.log(err)

            })
        }, calculateDays(date) {
            let current = new Date();
            let eventTime = new Date(date)
            if (eventTime) {
                let diffMill = eventTime - current
                let days = Math.ceil(diffMill / (1000 * 60 * 60 * 24));
                return days;
            } else {
                return "N/A"
            }

        }, calculatePrice(price) {
            if (price <= 0) {
                return "Free"
            } else if (price > 0) {
                return `${price} Ksh`
            }
        }, viewApplication(id) {
            this.application = true
            this.approval = false
            let data = this.applicants.find((item) => item.event_application_id == id)
            this.applicantDetails = data
        }, closeApplicantView() {
            this.application = false
            this.approval = true
        }, submitApproved() {

            let data = this.applicants.map(item => {
                let userData = {
                    applicant_id: item.user_id,
                    state: item.state
                };
                this.sendingData.push(userData);
            })
            axios.post("api/applicant/approve", { event_id: this.event_id, applicants: this.sendingData }).then((res) => {
                if (!res.data.error) {
                    this.$refs.sweetAlerts.showNotification("Applicants Approved");
                    this.approval = false
                    this.application = false
                    this.requestData()
                } else {
                    this.$refs.sweetAlerts.showNotificationError(res.data.message);
                }
            }).catch((err) => {
                console.log(err)
                this.$refs.sweetAlerts.showNotificationError(err);
            })
        }, markAllSelected() {
            return new Promise((resolve) => {
                for (let i = 0; i < this.applicants.length; i++) {
                    this.applicants[i].state = true;
                }
                resolve()
            });
        }, async approveAll() {
            await this.markAllSelected()
            this.submitApproved()
        }
    }, mounted() {
        this.requestData()
    }
}

</script>

<template>
    <SweetAlerts ref="sweetAlerts"></SweetAlerts>
    <div class="main-section">
        <Loader :loading="loading" />
        <SideNav />
        <div class="dash-main">
            <div class="approve-tickets-container">
                <span>Future Events</span>
                <div class="future-events-holder">
                    <div class="events-item-holder event-container">

                        <div @click="openApproval(item.id)" class="card" style="" v-for="(item, index) in mainData"
                            :key="index">
                            <img :src="item.event_image" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">{{ item.title }}</p>
                                <span>{{ item.description }}</span>
                                <div class="event-desc-display">
                                    <span>{{ item.venue }}</span>
                                    <span>{{ item.category }}</span>
                                    <p>In {{ calculateDays(item.event_date) }} Days</p>
                                </div>
                                <h6>{{ calculatePrice(item.price) }}</h6>
                                <div class="future-events-buttons">
                                    <button @click="openApproval(item.id)">View Applicants</button>


                                </div>
                            </div>
                        </div>

                    </div>

                    <div v-if="approval" class="event-more-desc events-participants">
                        <i @click="closeApproval" class='bx bx-x close-event-desc'></i>
                        <div class="evemts-part-header">
                            <span>Applicants</span>
                            <button @click="markAllSelected">Select All</button>
                        </div>
                        <ApplicantListForm :applicants="applicants" @view_application="viewApplication" />
                        <button @click="submitApproved" class="approve-btn">Approve</button>
                    </div>


                    <div v-if="application" class="event-more-desc events-participants applicants-view">
                        <i @click="closeApproval" class='bx bx-x close-event-desc'></i>
                        <span @click="closeApplicantView" class="close-applicant-view"><i
                                class='bx bx-arrow-back'></i></span>
                        <div class="applicant-details-container">
                            <div class="applicant-item">
                                <p>Name:</p>
                                <span>{{ applicantDetails.user.username }}</span>
                            </div>
                            <div class="applicant-item p">
                                <p>Agenda</p>
                                <span>{{ applicantDetails.event_agenda }}</span>
                            </div>
                            <div class="applicant-item p">
                                <p>expectation</p>
                                <span>{{ applicantDetails.expectation }}</span>
                            </div>
                            <div class="applicant-item p">
                                <p>similar event</p>
                                <span>{{ applicantDetails.similar_event }}</span>
                            </div>
                            <div class="applicant-item p">
                                <p>learning objective</p>
                                <span>{{ applicantDetails.learning_objective }}</span>
                            </div>
                        </div>
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