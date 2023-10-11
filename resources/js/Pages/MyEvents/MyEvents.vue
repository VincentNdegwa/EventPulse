<script>
import SideNav from "../Dashboard/components/SideNav.vue"
import MyEventsHeader from "./components/MyEventsHeader.vue";
import Loader from "@/components/Loader.vue";
import axios from "axios";
export default {
    data() {
        return {
            errorText: "",
            openMore: false,
            loading: false,
            userid: "",
            myEventsData: [],
        }
    },
    components: {
        SideNav,
        MyEventsHeader,
        Loader
    },
    methods: {
        toggleMore() {
            this.openMore = true
            console.log(this.myEventsData)
        },
        closeMore() {
            this.openMore = false
        }, requestData() {
            this.loading = true
            axios.post("/user-id").then(res => {
                if (res) {
                    this.userid = res.data.userId
                    if (res.data.userId) {
                        axios.post("api/get-events", { userId: res.data.userId }).then(res => {
                            this.loading = false
                            if (res) {
                                if (!res.data.error) {
                                    this.errorText = ""
                                    this.myEventsData = res.data.data
                                } else {
                                    this.errorText = res?.data?.message
                                }
                            } else {
                                this.errorText = "Failed to fetch data";
                            }
                        }).catch(err => {
                            this.loading = false
                            this.errorText = err
                        })
                    }
                } else {
                    console.log("errr in getting user");
                }
            }).catch(err => {
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

        }, eveluatePrice(price) {
            if (price <= 0) {
                return "Free"
            } else if (price > 0) {
                return `${price} Ksh`
            }
        }
    }, mounted() {
        this.requestData()
    }
}
</script>
<template>
    <Loader :loading="loading" />
    <div class="main-section">
        <SideNav />
        <div class="dash-main">
            <div class="events-container">
                <MyEventsHeader />
                <div class="event-body">
                    <div class="my-events-container">
                        <div class="my-events-cards-holder event-container">

                            <div @click="toggleMore" class="card" v-for="(item, index) in myEventsData" :key="index">
                                <img :src="item.event_image" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">{{ item.title }}</p>
                                    <span>{{ item.description }}</span>
                                    <div class="event-desc-display">
                                        <span>{{ item.venue }}</span>
                                        <span>{{ item.category }}</span>
                                        <p>{{ this.calculateDays(item.event_date) }} Days to Event</p>
                                    </div>
                                    <h6>{{ this.eveluatePrice(item.price) }}</h6>
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
@import url("../Events/styles/events.css");
@import url("./styles/my-events.css");
</style>