<script>
import Events from '@/Pages/Events/Events.vue';
import SweetAlerts from '@/components/SweetAlerts.vue';
import axios from 'axios';
import { router } from "@inertiajs/vue3"
// import EventCreation from '@/Pages/Create/components/EventCreation.vue';
export default {

    props: {
        viewUpdate: Boolean,
        eventData: Object
    }, data() {
        return {
            updateData: {},
            onlineVenue: false,
            errorMessage: ""
        }
    }, components: {
        SweetAlerts
    }, methods: {
        dataRefresh(data) {
            this.updateData = data
            if (this.updateData.venue == "physical") {
                this.onlineVenue = false
            } else {
                this.onlineVenue = true
            }
        },
        removeUpdate() {
            this.$emit("remove_update")
        },
        addHost() {
            console.log(this.updateData)
            const hostObject = {
                host_event_id: 3,
                host_name: "",
                host_email: "",
                host_occupation: "",
                host_social: "",
                profile_image: ""
            };
            this.updateData?.hosts?.push(hostObject)
        }, removeHost(index) {
            console.log(index)
            this.updateData.hosts.splice(index, 1)
        }, updateHostImage(index, event) {
            let file = event.target.files[0]
            if (file) {
                let reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onload = () => {
                    let filebase64 = reader.result
                    this.updateData.hosts[index].profile_image = filebase64
                }
            }
        }, updateEventImage(event) {
            let file = event.target.files[0]
            if (file) {
                let reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onload = () => {
                    let filebase64 = reader.result
                    this.updateData.event_image = filebase64
                }
            }

        }, validateData() {
            let valid = true;

            if (this.onlineVenue) {
                if (!this.updateData.meeting_link.trim()) {
                    this.errorMessage = "Meeting link cannot be empty when the venue is online";
                    valid = false;
                }
            } else {
                if (!this.updateData.address.trim()) {
                    this.errorMessage = "Address cannot be empty when the venue is physical";
                    valid = false;
                }
            }

            if (!this.updateData.title.trim()) {
                this.errorMessage = "Please provide the event title";
                valid = false;
            }

            if (!this.updateData.description.trim()) {
                this.errorMessage = "Please provide the event description";
                valid = false;
            }


            let eventDate = new Date(this.updateData.event_date);
            let deadlineDate = new Date(this.updateData.deadline_application);
            let currentDate = new Date();

            if (deadlineDate < currentDate) {
                this.errorMessage = "Deadline date cannot be in the past."
                valid = false;
            } else if (deadlineDate > eventDate) {
                this.errorMessage = "Deadline date cannot be past the event date."
                valid = false;
            }

            this.updateData.hosts.forEach(item => {
                if (!item.host_name.trim()) {
                    this.errorMessage = "Please provide a name for the host";
                    valid = false;
                }
                if (!item.host_email.trim()) {
                    this.errorMessage = "Please provide an email for the host";
                    valid = false;
                }
                if (!item.host_occupation.trim()) {
                    this.errorMessage = "Please provide an occupation for the host";
                    valid = false;
                }
                if (!item.host_social.trim()) {
                    this.errorMessage = "Please provide a social link for the host";
                    valid = false;
                }
                if (item.profile_image === "") {
                    this.errorMessage = "Please provide the host's image";
                    valid = false;
                }
            });

            return valid;
        }
        , submitUpdates(event) {
            event.preventDefault();
            if (this.validateData()) {
                console.log(this.updateData)
                axios.post("api/myevents/update", this.updateData).then(res => {
                    if (res.data.error) {
                        this.$refs.sweetAlerts.showNotificationError(res.data.message)
                    } else {
                        router.visit(route("my-events"));
                        this.$refs.sweetAlerts.showNotification("Event updated successfully!!")
                    }
                }).catch(err => {
                    this.$refs.sweetAlerts.showNotificationError(err)
                })
            } else {
                this.$refs.sweetAlerts.showNotificationError(this.errorMessage)
            }
        }
    }, mounted() {
        this.updateData = this.eventData
    }, watch: {
        eventData: {
            immediate: true,
            handler: function (newData, oldData) {
                this.dataRefresh(newData)
            }, deep: true
        }
    }
}
</script>
<template>
    <form @submit.prevent="submitUpdates($event)" v-if="viewUpdate" class="update-event-container">
        <SweetAlerts ref="sweetAlerts"></SweetAlerts>
        <div class="event-update-fillables">
            <div class="button-top-nav">
                <button type="button" @click="removeUpdate" class="update-exit-button">EXIT</button>
                <button type="submit" class="update-button">Update Event</button>
            </div>
            <h4>Event</h4>
            <!--  -->
            <div class="input-holder mb-2 update-input-holder">
                <label class="event-label">Event Name</label>
                <input v-model="updateData.title" type="text" class="event-form" required>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Event Description</label>
                <textarea v-model="updateData.description" type="text" class="event-form event-text-area"
                    required></textarea>
            </div>
            <!--  -->
            <div class="event-image-update">
                <img :src="updateData.event_image" alt="">
                <div class="input-holder mb-2">
                    <label class="event-label">Event Barner</label>
                    <input type="file" @change="updateEventImage($event)" class="event-form">
                </div>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Event Date</label>
                <input v-model="updateData.event_date" type="date" class="event-form" required>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Registration Deadline</label>
                <input v-model="updateData.deadline_application" type="date" class="event-form" required>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Venue</label>
                <select v-model="updateData.venue" class="event-form" @change="changeEventVenue" required>
                    <option value="online">Online</option>
                    <option value="physical" selected>Physical</option>
                </select>
            </div>
            <!--  -->
            <div class="input-holder mb-2" v-if="onlineVenue">
                <label class="event-label">Meeting Link</label>
                <input v-model="updateData.meeting_link" type="text" class="event-form" required>
            </div>
            <!--  -->
            <div class="input-holder mb-2" v-else>
                <label class="event-label">Address</label>
                <input v-model="updateData.address" type="text" class="event-form" required>
            </div>
        </div>
        <div class="event-host-update">
            <h4>Hosts</h4>
            <button class="floating-button" @click="addHost" type="button"><i class='bx bx-plus-medical'></i></button>
            <div v-for="(item, index) in  updateData.hosts " :key="index" class="host-update-holder">
                <div class="host-image-update">
                    <img :src="item.profile_image ? item.profile_image : 'images/avatar.jpg'" alt="">
                    <div class="event-functions">
                        <input type="file" @change="updateHostImage(index, $event)" class="event-form">
                        <button type="button" @click="removeHost(index)">Remove</button>
                    </div>
                </div>
                <div class="input-holder mb-2">
                    <label class="event-label">Host Name</label>
                    <input v-model="item.host_name" type="text" class="event-form" required>
                </div>
                <div class="input-holder mb-2">
                    <label class="event-label">Host Email</label>
                    <input v-model="item.host_email" type="text" class="event-form" required>
                </div>

                <div class="input-holder mb-2">
                    <label class="event-label">Occupation</label>
                    <input v-model="item.host_occupation" type="text" class="event-form" required>
                </div>
                <div class="input-holder mb-2">
                    <label class="event-label">Host Social</label>
                    <input v-model="item.host_social" type="text" class="event-form" required>
                </div>
            </div>

        </div>
    </form>
</template>
<style>
@import url("../styles/updateevent.css");
</style>