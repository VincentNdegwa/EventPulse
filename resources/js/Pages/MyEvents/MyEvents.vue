<script>
import SideNav from "../Dashboard/components/SideNav.vue"
import MyEventsHeader from "./components/MyEventsHeader.vue";
import MyEventsUpdate from "./components/MyEventsUpdate.vue";
import Loader from "@/components/Loader.vue";
import axios from "axios";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime"
export default {
    data() {
        return {
            errorText: "",
            openMore: false,
            loading: false,
            userid: "",
            myEventsData: [],
            categories: [],
            openedData: {},
            viewUpdate: false
        }
    },
    components: {
        SideNav,
        MyEventsHeader,
        Loader,
        MyEventsUpdate
    },
    methods: {
        openUpdate() {
            this.viewUpdate = true
        },
        toggleMore(id) {
            this.openMore = true
            this.openedData = this.myEventsData.find(item => item.id === id)
            // console.log(this.openedData)
        },
        closeMore() {
            this.openMore = false
        }, requestData() {
            this.loading = true
            axios.post("/user-id").then(res => {
                if (res) {
                    this.userid = res.data.userId
                    if (res.data.userId) {
                        axios.post("api/myevents", { userId: res.data.userId }).then(res => {
                            this.loading = false
                            if (res) {
                                if (!res.data.error) {
                                    this.errorText = ""
                                    this.myEventsData = res.data.data
                                    this.categories = res.data.categories
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
            let eventTime = new Date(date)
            if (eventTime) {
                dayjs.extend(relativeTime);
                return dayjs(date).fromNow()
            } else {
                return "N/A"
            }

        }, eveluatePrice(price) {
            if (price <= 0) {
                return "Free"
            } else if (price > 0) {
                return `${price} Ksh`
            }
        }, handleCategory(category) {

            axios.post("api/myevents", { userId: this.userid, category: category }).then(res => {
                if (res) {
                    if (!res.data.error) {
                        this.myEventsData = res.data.data
                        this.loading = false
                    }
                }
            }).catch(err => {
                console.log(err)
            })
        }
        , searchResults(text) {
            axios.post("api/myevents", { userId: this.userid, search: text }).then(res => {
                if (res) {
                    if (!res.data.error) {
                        this.myEventsData = res.data.data
                        this.loading = false
                    }
                }
                console.log(res.data)
            }).catch(err => {
                console.log(err)
            })
        }, removeUpdate() {
            this.viewUpdate = false
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
                <MyEventsHeader :categories="categories" @handle-category="handleCategory" @handle-search="searchResults" />
                <div class="event-body">
                    <div class="my-events-container">
                        <div class="my-events-cards-holder event-container">
                            <div class="card" v-for="(item, index) in myEventsData" :key="index">
                                <img :src="item.event_image" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text">{{ item.title }}</p>
                                    <span>{{ item.description }}</span>
                                    <div class="event-desc-display">
                                        <span>{{ item.venue }}</span>
                                        <span>{{ item.category }}</span>
                                        <p>{{ this.calculateDays(item.event_date) }}</p>
                                    </div>
                                    <!-- <h6>{{ eveluatePrice(item.price) }}</h6> -->
                                    <button @click="toggleMore(item.id)" class="book_button">View</button>
                                </div>
                            </div>

                        </div>
                        <div v-if="openMore" class="event-more-desc">
                            <i @click="closeMore" class='bx bx-x close-event-desc'></i>
                            <div class="events-details-display-action">
                                <div class="desc-card">
                                    <div class="desc-card-header">
                                        <v-avatar :image="openedData.event_image"></v-avatar>
                                        <p>{{ openedData.title }}</p>
                                    </div>
                                    <p class="desc-card-desc">{{ openedData.description }}</p>
                                    <div class="desc-card-participanats">
                                        <p>Participants</p>
                                        <p class="desc-card-partcipants">{{ openedData.event_applicants_count }}</p>
                                    </div>
                                    <div class="desc-card-price">
                                        <p>prices</p>
                                        <p class="desc-card-price">{{ openedData.price }}</p>
                                    </div>
                                    <div class="desc-card-payment">
                                        <p>E.P</p>
                                        <p class="desc-e-p">{{ openedData.event_applicants_count * openedData.price }}</p>
                                    </div>
                                </div>
                                <div class="event-details-buttons">
                                    <button @click="openUpdate">Update</button>
                                    <button>Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <MyEventsUpdate :viewUpdate="viewUpdate" :eventData="openedData" @remove_update="removeUpdate" />
    </div>
</template>

<style>
@import url("../Events/styles/event-header.css");
@import url("../Events/styles/events.css");
@import url("./styles/my-events.css");
</style>