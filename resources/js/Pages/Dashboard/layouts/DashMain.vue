<script>
import { router } from '@inertiajs/vue3'
import dayjs from 'dayjs'
import relativeTime from "dayjs/plugin/relativeTime"
export default {
    props: {
        dashData: Object
    }, data() {
        return {
            categories: [],
            randomEvent: this.dashData.randomEvent,
            userTickets: this.dashData.userTickets,
            recommendedEvents: this.dashData.recommendedEvents,
        }
    }, methods: {
        getData() {
            // console.log(this.dashData)
            let randomCat = []
            for (let index = 0; index < 4; index++) {
                let randomIndex = Math.floor(Math.random() * this.dashData.categories.length);
                let randomItem = this.dashData.categories[randomIndex]
                if (!randomCat.includes(randomItem)) {
                    randomCat.push(randomItem)
                }
            }
            this.categories = randomCat
        },
        readableDate(data) {
            dayjs.extend(relativeTime)
            return dayjs(data).fromNow()
        }, book(id) {
            router.visit(`/view/${id}`)
        }
    }, mounted() {
        this.getData()
    }
}
</script>

<template>
    <div class="dash-main">
        <div class="dash-holder">
            <div class="top-dash">
                <!-- top left -->
                <div class="travel-advert">
                    <div class="travel-vcard">

                        <v-card v-if="randomEvent" class="mx-auto" max-width="auto">
                            <v-img :src="randomEvent.event_image"></v-img>

                            <div class="event-details">
                                <div class="event-descriptions">

                                    <v-card-title class="event-title">
                                        {{ randomEvent.title }}
                                    </v-card-title>

                                    <v-card-subtitle class="event-place">
                                        {{ randomEvent.venue == "online" ? "Online" : randomEvent.address }}
                                    </v-card-subtitle>

                                    <p class="event-date">
                                        {{ readableDate(randomEvent.event_date) }}
                                    </p>
                                </div>
                                <!-- <div class="event-actions"> -->
                                <v-card-actions class="ev-actions">
                                    <v-card-title class="ev-price">
                                        price:{{ randomEvent.price }}
                                    </v-card-title>
                                    <v-btn class="book_button" @click="book(randomEvent.id)">
                                        Book Ticket
                                    </v-btn>
                                </v-card-actions>
                                <!-- </div> -->
                            </div>

                        </v-card>

                        <div class="top-places">

                            <v-card>
                                <div class="small-card-holder">
                                    <v-img src="images/hero.jpg" cover></v-img>
                                    <div class="text-carfd-holder">
                                        <v-card-subtitle class="text-event-place">
                                            Paris
                                        </v-card-subtitle>
                                        <v-card-subtitle class="text-event-count">
                                            10k
                                        </v-card-subtitle>

                                    </div>
                                </div>
                            </v-card>


                        </div>

                    </div>
                </div>
                <!-- top right -->
                <div class="event-navigation">
                    <div class="events-category-select">
                        <div class="select-item" v-for="(item, index) in categories" :key="index">
                            <i class='bx bx-briefcase-alt'></i>
                            <span>{{ item.category_name }}</span>
                        </div>

                    </div>
                    <div class="tickets-display">
                        <p>
                            Your Tickets
                        </p>
                        <div class="tickets-cards-holder">
                            <v-card v-for="(item, index) in userTickets" :key="index">
                                <v-img class="ticket-image" src="images/hero.jpg" cover></v-img>
                                <p class="ticket-title">{{ item.event.title }}</p>
                                <p class="ticket-number">{{ readableDate(item.event.event_date) }}</p>
                            </v-card>

                        </div>
                    </div>
                </div>

            </div>
            <div class="botton-dash">
                <div class="recommended">
                    <p>Recommended</p>
                    <div class="recommended-holder">
                        <div v-for="(item, index) in recommendedEvents" :key="index">
                            <img class="recomended-img" :src="item.event_image" cover />
                            <div class="recondend-items-holder">
                                <p class="text-caption text-center rec-date">{{ readableDate(item.event_date)
                                }}</p>
                                <p class="text-body-2 rec-title ext-center">
                                    {{ item.title }}
                                </p>
                                <p class="text-h7 rec-place text-center">
                                    {{ item.venue == "online" ? "Online" : item.address }}
                                </p>
                                <p class="text-caption rec-price text-center">
                                    {{ item.price }}
                                </p>

                            </div>

                        </div>

                    </div>
                </div>
                <div class="saved-events">
                    <p>Saved Events</p>
                    <div class="saved-events-holder">
                        <v-card class="saved-events-card">
                            <div class="saved-holder">
                                <v-img src="images/image2.jpg" cover></v-img>
                                <div class="saved-details">
                                    <p class="text-caption saved-heading text-center">
                                        Talk Machine Learning
                                    </p>
                                    <p class="saved-date">
                                        12June,2023
                                    </p>
                                    <p class="saved-price">
                                        2000
                                    </p>
                                </div>
                            </div>
                        </v-card>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
@import url('../styles/dashmain.css');
</style>