<script>
import axios from 'axios';
import SideNav from '../Dashboard/components/SideNav.vue';
import EventHeader from './components/EventHeader.vue';
import Loader from "@/components/Loader.vue";
import SingleEvent from "../SingleEvent/SingleEvents.vue"
import { router } from '@inertiajs/vue3';
export default {
    props: {
        error: Boolean,
        message: String,
        catEvents: Array
    },
    data() {
        return {
            loading: false,
            errorText: "",
            eventsData: [],
            openedEvent: Object,
            categories: [],
            propsData: false
        }
    },
    components: {
        SideNav,
        EventHeader,
        Loader,
        SingleEvent
    }, mounted() {
        if (this.error) {
            console.log(this.message)
        }

        if (this.catEvents !== undefined) {
            console.log(this.catEvents)
            this.eventsData = this.catEvents
        } else {
            this.requestData()
        }
    }, methods: {
        requestData() {
            this.loading = true

            axios.post("api/retrieve/events/all").then(res => {
                if (res) {
                    if (!res.data.error) {
                        this.eventsData = res.data.data
                        this.categories = res.data.categories
                        this.loading = false
                    } else {
                        this.errorText = res.data.message;
                    }
                }
            }).catch(err => {
                this.loading = false
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
        }, openEvent(id) {
            this.loading = true
            router.get(`/view/${id}`)
        },
        handleCategory(category) {
            axios.get(`api/events/category/${category}`).then((res) => {
                if (res) {
                    if (!res.data.error) {
                        this.eventsData = res.data.data
                        this.loading = false
                    }
                }
            }).catch((err) => {
                console.log(err)
            })
        }, searchResults(text) {
            axios.post("api/events/search", { search: text }).then((res) => {
                if (res) {
                    if (!res.data.error) {
                        this.eventsData = res.data.data
                        this.loading = false
                    }
                }
            }).catch((err => {
                console.log(err)
            }))
        }
    }, watch: {
        catEvents: {
            handler: function (newValue, oldValue) {
                console.log(newValue)
            },
            deep: true
        }
    }
}


</script>

<template>
    <Loader :loading="loading" />
    <div class="main-section">
        <SideNav />
        <div class="dash-main">
            <div class="events-container" v-if="categories">
                <EventHeader :categories="categories" @handle-category="handleCategory" @handle-search="searchResults" />
                <div class="event-body">
                    <div v-if="eventsData.length > 0" class="event-container">

                        <div @click="openEvent(item.id)" class="card" v-for="(item, index) in eventsData" :key="index">
                            <img :src="item.event_image" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">{{ item.title }}</p>
                                <span>{{ item.description }}</span>
                                <div class="event-desc-display">
                                    <span>{{ item.venue }}</span>
                                    <span>{{ item.category }}</span>
                                    <p>{{ this.calculateDays(item.event_date) }} Days to Event</p>
                                </div>
                                <h6>{{ eveluatePrice(item.price) }}</h6>
                            </div>
                        </div>

                    </div>

                    <div v-else class="no-events">
                        <h4>No events found</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- <SingleEvent :openedEvent="openedEvent" />a -->
    </div>
</template>
<style>
@import url("./styles/event-header.css");
@import url("./styles//events.css");
</style>