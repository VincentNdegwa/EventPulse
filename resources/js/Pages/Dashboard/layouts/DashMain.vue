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
        }, sortCategory(category) {

            router.visit("/category", {
                method: "get", data: {
                    category: category
                }
            })
        }
    }, mounted() {
        this.getData()
        console.log(this.userTickets)
    }
}
</script>

<template>
    <div class="dash-main">
        <div class="dash-holder">
            <div class="dash-holder">
                <div class="dash-display-container">
                    <!-- stats -->
                    <div class="user-stats">
                        <span>Stats</span>
                        <div class="stats-container">
                            <div class="stats-item">
                                <span>Total Events Attended</span>
                                <div class="stats-count">20</div>
                            </div>

                            <div class="stats-item">
                                <span>Total Events Attended</span>
                                <div class="stats-count">20</div>
                            </div>

                            <div class="stats-item">
                                <span>Total Events Attended</span>
                                <div class="stats-count">20</div>
                            </div>
                        </div>
                    </div>
                    <!-- Events on application -->
                    <div class="events-application">
                        <span>Events Holding</span>
                        <div class="event-holding-container">
                            <div class="event-holding-item">
                                <span class="event-holding-name">Name of the Events Name of the Events Name of the
                                    Events</span>
                                <span class="event-holding-venue">Venue</span>
                                <span class="event-holding-participants">20<span>Participants</span></span>
                            </div>
                            <div class="event-holding-item">
                                <span class="event-holding-name">Name of the Events Name of the Events Name of the
                                    Events</span>
                                <span class="event-holding-venue">Venue</span>
                                <span class="event-holding-participants">20<span>Participants</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- trending event -->
                    <div class="event-trending-display">
                        <span>Top Recommended Event</span>
                        <div class="event-trending-container">
                            <div class="event-display-details-holder">
                                <div class="events-image-holder">
                                    <img src="images/image1.jpeg" alt="">
                                </div>
                                <div class="events-display-details">
                                    <div class="left-event-display">
                                        <span class="left-event-name">Event name</span>
                                        <span class="left-event-des">Description</span>
                                        <span class="left-event-time">Time</span>
                                        <span class="left-event-venue">Venue</span>

                                    </div>
                                    <button>-></button>
                                </div>
                            </div>
                            <div class="event-host-display">
                                <div class="hosts-holder">
                                    <div class="event-host-item">
                                        <div class="host-image-item-holder">
                                            <img src="images/image1.jpeg" alt="">
                                        </div>
                                        <div class="host-details">
                                            <span class="host-details-name">Vincent</span>
                                            <span class="host-details-carreer">Software Dveloper</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tickets -->
                    <div class="event-tickets-display">
                        <span>
                            <span>Tickets</span>
                            <button>View All</button>
                        </span>
                        <div class="event-tickets-item-holder">
                            <div class="ticket-item">
                                <img src="images/image1.jpeg" alt="">
                                <div class="ticket-details-display">
                                    <span class="event-ticket-dislay-name">Name of the event</span>
                                    <span class="event-ticket-dislay-venue">Venue</span>
                                    <span class="event-ticket-dislay-status">status</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- saved -->
                    <div class="saved-event-display">
                        <span>Event Bookmark</span>
                        <div class="saved-events-items-holder">
                            <div class="saved-events-item">
                                <span>Event name</span>
                                <p class="deadline">20/3/23</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<style>
@import url('../styles/dash.css');
</style>
