<script>
export default {
    props: {
        data: Array
    }, data() {
        return {
            eventsData: Object
        }
    }, methods: {
        calculateDays(date) {
            let current = new Date();
            let eventTime = new Date(date)
            if (eventTime) {
                let diffMill = eventTime - current
                let days = Math.ceil(diffMill / (1000 * 60 * 60 * 24));
                return days;
            } else {
                return "N/A"
            }

        }, goBack() {
            window.history.back()
        }
    }, mounted() {
        this.eventsData = this.data[0]
        console.log(this.eventsData)
    }
}
</script>
<template>
    <div class="single-events-container">
        <div class="event-button-navigation">
            <button @click="goBack"><i class='bx bx-arrow-back'></i></button>
            <button>Apply</button>
        </div>
        <div class="single-event-holder">
            <div class="single-events-details">
                <div class="single-event-item">
                    <h4>{{ eventsData.title }}</h4>
                    <span>{{ eventsData.description }}</span>
                    <p>Price: {{ eventsData.price }}</p>
                    <p>{{ eventsData.address }}</p>
                    <p>Event date: {{ eventsData.event_date }}</p>
                    <p>Days remaining: {{ calculateDays(eventsData.event_date) }}</p>
                    <p>Deadline: in {{ calculateDays(eventsData.deadline_application) }} days</p>
                </div>
                <div class="single-event-item event-image-container">
                    <div class="event-image-holder">
                        <img :src="eventsData.event_image" alt="event image">
                    </div>
                </div>
            </div>
            <div class="event-host-details host-holder">
                <div class="host-item-holder">
                    <div class="host-item" v-for="(item, index) in eventsData.hosts" :key="index">
                        <div class="host-image-holder">
                            <img :src="item.profile_image" alt="">
                        </div>
                        <di v class="host-details">
                            <span>
                                <p>Host:</p> {{ item.host_name }}
                            </span>
                            <span>
                                <p>Profession:</p> {{ item.host_occupation }}
                            </span>
                        </di>
                        <a :href="item.host_social" target="_blank"><i class='bx bxl-linkedin-square'></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
@import url("./style/singleEvent.css");
</style>