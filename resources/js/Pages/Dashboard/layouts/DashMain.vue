<script>
import { router } from '@inertiajs/vue3'
import dayjs from 'dayjs'
import relativeTime from "dayjs/plugin/relativeTime"
export default {
    props: {
        dashData: Object
    }, data() {
        return {
            randomEvent: this.dashData.randomEvent,
            userTickets: this.dashData.userTickets,
            eventsAttended: this.dashData.eventsAttended,
            eventsCreated: this.dashData.eventsCreated,
            eventsApplied: this.dashData.eventsApplied,
            eventApplicants: this.dashData.eventApplicants
        }
    }, methods: {
        getData() {

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
        }, openRandomEvent(id) {
            router.visit(`/view/${id}`)
        }
    }, mounted() {
        this.getData()
        console.log(this.dashData)
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
                                <span>Events Attended</span>
                                <div class="stats-count">{{ eventsAttended }}</div>
                            </div>

                            <div class="stats-item">
                                <span>Events Applied</span>
                                <div class="stats-count">{{ eventsApplied }}</div>
                            </div>

                            <div class="stats-item">
                                <span>Events Created</span>
                                <div class="stats-count">{{ eventsCreated }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Events on application -->
                    <div class="events-application">
                        <span>Events Holding</span>
                        <div class="event-holding-container">
                            <div v-if="eventApplicants && eventApplicants.length > 0"
                                v-for="(item, index) in eventApplicants" :key="index" class="event-holding-item">
                                <span class="event-holding-name">{{ item.title }}</span>
                                <span class="event-holding-venue">{{ item.venue == "physical" ? item.address : "Online"
                                }}</span>
                                <span class="event-holding-participants">{{ item.event_applicants_count
                                }}<span>Participants</span></span>
                            </div>

                            <div v-else class="no-event">
                                <span>There are currently no events with application on going</span>
                            </div>
                        </div>
                    </div>

                    <!-- trending event -->
                    <div class="event-trending-display">
                        <span>Top Recommended Event</span>
                        <div v-if="randomEvent" class="event-trending-container">
                            <div class="event-display-details-holder">
                                <div class="events-image-holder">
                                    <img :src="randomEvent.event_image" alt="">
                                </div>
                                <div class="events-display-details">
                                    <div class="left-event-display">
                                        <span class="left-event-name">{{ randomEvent.title }}</span>
                                        <span class="left-event-des">{{ randomEvent.description }}</span>
                                        <span class="left-event-time">{{ randomEvent.event_date }}</span>
                                        <span class="left-event-venue">{{ randomEvent.venue == "physical" ?
                                            randomEvent.address : "Online"
                                        }}</span>

                                    </div>
                                    <button @click="openRandomEvent(randomEvent.id)">-></button>
                                </div>
                            </div>
                            <div class="event-host-display">
                                <div class="hosts-holder">
                                    <div v-for="(item, index) in randomEvent.hosts" :key="index" class="event-host-item">
                                        <div class="host-image-item-holder">
                                            <img :src="item.profile_image" alt="">
                                        </div>
                                        <div class="host-details">
                                            <span class="host-details-name">{{ item.host_name }}</span>
                                            <span class="host-details-carreer">{{ item.host_occupation }}</span>
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
                            <div v-for="(item, index) in userTickets" :key="index" class="ticket-item">
                                <img :src="item.event.event_image" alt="">
                                <div class="ticket-details-display">
                                    <span class="event-ticket-dislay-name">{{ item.event.title }}</span>
                                    <span class="event-ticket-dislay-venue">{{ item.event.venue == "physical" ?
                                        item.event.address :
                                        "Online"
                                    }}</span>
                                    <span class="event-ticket-dislay-status">{{ item.status }}</span>
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
