<script>
import ApplicationForm from './ApplicationForm.vue';
export default {
    props: {
        data: Array
    }, data() {
        return {
            eventsData: Object,
            openApply: false,
            userInputs: {
                eventId: "",
                event_agenda: "",
                expectations: "",
                similar_event: "",
                learning_objective: "",
                suggestions: ""
            },
            browserState: {
                started: false
            }
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
            this.openApply = false;
            window.history.back()
        }, apply() {
            this.openApply = true
            this.browserState.started = true
            this.saveBrowserState()
        }, saveInputsToLocal() {
            localStorage.setItem("user_inputs", JSON.stringify(this.userInputs));
        }, saveBrowserState() {
            localSotrage.setItem("application_status", JSON.stringify(this.browserState));
        }, submitForm() {
            console.log("hello")
        }
    }, mounted() {
        this.eventsData = this.data[0]
        let storedInputs = localStorage.getItem("user_inputs");
        let jsonInputs = JSON.parse(storedInputs);
        if (jsonInputs.eventId == this.eventsData.id) {
            this.userInputs = jsonInputs
        } else {
            localStorage.removeItem("user_inputs")
            this.userInputs.eventId = this.eventsData.id
        }
        let state = localStorage.getItem("application_status");
        let jsonState = JSON.parse(state);
        console.log(jsonState);
        if (jsonState.started) {
            this.openApply = true
        }
    }, components: {
        ApplicationForm
    }, watch: {
        userInputs: {
            handler: function (newValue, oldValue) {
                this.saveInputsToLocal()
            },
            deep: true
        }
    }
}
</script>
<template>
    <div class="single-events-container">
        <div class="event-button-navigation">
            <button @click="goBack"><i class='bx bx-arrow-back'></i></button>
            <button v-if="!openApply" @click="apply">View Application</button>
            <button v-else>Apply</button>
        </div>
        <div v-if="!openApply" class="single-event-holder">
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
        <div v-else class="application-container">
            <span class="apply-headline">Apply for the {{ eventsData.title }}</span>
            <ApplicationForm :userInputs="userInputs" @submiting_form="submitForm" />
        </div>
    </div>
</template>

<style>
@import url("./style/singleEvent.css");
</style>