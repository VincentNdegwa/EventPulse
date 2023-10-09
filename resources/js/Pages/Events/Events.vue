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
        message: String
    },
    data() {
        return {
            loading: false,
            errorText: "",
            eventsData: [],
            openedEvent: Object
        }
    },
    components: {
        SideNav,
        EventHeader,
        Loader,
        SingleEvent
    }, mounted() {
        this.requestData()
        if (this.error) {
            console.log(this.message)
        }
    }, methods: {
        requestData() {
            this.loading = true
            axios.post("api/retrieve/events/all").then(res => {
                this.loading = false
                if (res) {
                    if (!res.data.error) {
                        this.eventsData = res.data.data
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
        }
    }
}


</script>

<template>
    <Loader :loading="loading" />
    <div class="main-section">
        <SideNav />
        <div class="dash-main">
            <div class="events-container">
                <EventHeader />
                <div class="event-body">
                    <div class="event-container">

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