
<script>
import Chips from './Chips.vue'
export default {
    props: {
        eventData: Object,
        eventOnline: Boolean,
        entryFee: Boolean,
        ageLimits: Boolean,
    }, components: {
        Chips
    },
    methods: {
        handleEventFile(event) {
            let file = event.target.files[0]
            if (file) {
                if (file.type.startsWith("image/")) {
                    if (file.size <= 3 * 1024 * 1024) {

                        const reader = new FileReader()
                        reader.readAsDataURL(file)
                        reader.onload = () => {
                            let fileBase64 = reader.result
                            localStorage.setItem("event_image", fileBase64);
                        }
                    } else {
                        alert(`Your image file exceeds 3mbs which is ${file.size / 1024 / 1024}`)
                        event.target.value = ""

                    }
                } else {
                    alert(`Required image file type, found ${file.type}`)
                    event.target.value = ""
                }
            }
        }, changeEventVenue(event) {
            this.$emit("change-event-venue", event)
        }, changeEntryFee(event) {
            this.$emit("change-entry-fee", event)
        }, changeAgeLimit(event) {
            this.$emit("change-age-limit", event)
        }, navigateToHost() {
            this.$emit("navigate-host")
        }
    }

}
</script>
<template>
    <div class="fillable-container">
        <div class="part-one-fillables">
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Event Name</label>
                <input v-model="eventData.title" type="text" class="event-form" required>
                <span class="helper-text">This will be the display name of your event</span>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Event Description</label>
                <textarea v-model="eventData.description" type="text" class="event-form event-text-area"
                    required></textarea>
                <span class="helper-text">Add a description that explains what will be in the event and what
                    the event is all about</span>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Event Barner</label>
                <input type="file" @change="handleEventFile" class="event-form" required>
                <span class="helper-text">Select an image burner that suites your event for advert
                    purposes</span>
                <span class="helper-text" style="color: red;">The file should be image only and less than
                    3.1mbs</span>

            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Event Date</label>
                <span class="helper-text">When will be the event?</span>
                <span class="helper-text">Note that the date of the event should be after the deadline
                    registration</span>
                <input v-model="eventData.event_date" type="date" class="event-form" required>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Registration Deadline</label>
                <span class="helper-text">Add the date for closing the registration</span>
                <input v-model="eventData.deadline_application" type="date" class="event-form" required>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Venue</label>
                <select v-model="eventData.venue" class="event-form" @change="changeEventVenue" required>
                    <!-- <option value="" selected hidden>Select Venue</option> -->
                    <option value="online">Online</option>
                    <option value="physical" selected>Physical</option>
                </select>
                <span class="helper-text">This will be the display name of your event</span>
            </div>
            <!--  -->
            <div class="input-holder mb-2" v-if="eventOnline">
                <label class="event-label">Meeting Link</label>
                <input v-model="eventData.meeting_link" type="text" class="event-form" required>
                <span class="helper-text">Provide the meeting link of your event</span>
            </div>
            <!--  -->
            <div class="input-holder mb-2" v-else>
                <label class="event-label">Address</label>
                <input v-model="eventData.address" type="text" class="event-form" required>
                <span class="helper-text">This will be the display place where you event will happen</span>
            </div>
            <!--  -->

        </div>
        <div class="part-two-fillables">
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Would you like to add the entry price of the event?, If not by
                    default will be free entry</label>
                <label class="fee-select-input">
                    <input v-model="eventData.setFee" type="radio" id="fee" value="yes" @change="changeEntryFee">
                    <p>Yes</p>
                </label>
                <label class="fee-select-input">
                    <input v-model="eventData.setFee" type="radio" id="fee" value="no" @change="changeEntryFee">
                    <p>No</p>
                </label>
            </div>
            <!--  -->
            <div class="input-holder mb-2" v-if="entryFee">
                <label class="event-label">Entry price per persion</label>
                <input v-model="eventData.price" type="number" class="event-form" required>
                <span class="helper-text">Every applicants will have to pay this amount</span>
            </div>
            <!--  -->

            <div class="input-holder mb-2">
                <label class="event-label">Do you have any age limit of your participants?</label>
                <label class="fee-select-input">
                    <input v-model="eventData.setAge" type="radio" id="age" value="yes" @change="changeAgeLimit" name="age">
                    <p>Yes</p>
                </label>
                <label class="fee-select-input">
                    <input v-model="eventData.setAge" type="radio" id="age" value="no" @change="changeAgeLimit" name="age">
                    <p>No</p>
                </label>
            </div>
            <!--  -->
            <div class="input-holder mb-2" v-if="ageLimits">
                <label class="event-label">Select age limit</label>
                <select v-model="eventData.age_limit" class="event-form" required>
                    <option value="" selected hidden>Select Age</option>
                    <option value="under_18">Under 18</option>
                    <option value="18_plus">18+</option>
                    <option value="18_24">18 - 24</option>
                    <option value="25_34">25 - 34</option>
                    <option value="35_44">35 - 44</option>
                    <option value="45_54">45 - 54</option>
                    <option value="55_plus">55+</option>
                </select>

                <span class="helper-text">Only participants ranging in that age limit can attend your
                    event</span>
            </div>
            <!--  -->
            <div class="input-holder mb-2">
                <label class="event-label">Select event category</label>
                <Chips :eventData="eventData" />
            </div>
            <!--  -->

            <div class="input-holder add-host-btn">
                <button @click="navigateToHost" type="button">Add Host</button>
            </div>
            <!--  -->

        </div>
    </div>
</template>