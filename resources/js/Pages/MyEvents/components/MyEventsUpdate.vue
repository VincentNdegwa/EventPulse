<script>
import Events from '@/Pages/Events/Events.vue';

// import EventCreation from '@/Pages/Create/components/EventCreation.vue';
export default {

    props: {
        viewUpdate: Boolean,
        eventData: Object
    }, data() {
        return {
            updateData: {}
        }
    }, methods: {
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
        }
    }, mounted() {
        this.updateData = this.eventData
    }, watch: {
        eventData: {
            immediate: true,
            handler: function (newData, oldData) {
                this.updateData = newData
            }, deep: true
        }
    }
}
</script>
<template>
    <form v-if="viewUpdate" class="update-event-container">
        <div class="event-update-fillables">
            <div class="button-top-nav">
                <button type="button" @click="removeUpdate" class="update-exit-button">EXIT</button>
                <button type="button" class="update-button">Update Event</button>
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
            <div class="input-holder mb-2">
                <label class="event-label">Meeting Link</label>
                <input v-model="updateData.meeting_link" type="text" class="event-form" required>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
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