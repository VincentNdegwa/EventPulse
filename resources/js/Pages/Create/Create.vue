<script>
import SideNav from "../Dashboard/components/SideNav.vue"
import Chips from "./components/Chips.vue"
export default {
    data() {
        return {
            openHost: false,
            formFilledA: false,
            // hostArray: [],
            eventOnline: false,
            entryFee: false,
            ageLimits: false,
            eventData: {
                event_image: Object,
                title: "",
                description: "",
                deadline_application: "",
                event_date: "",
                category: "",
                venue: "",
                price: 0,
                address: "",
                age_limit: "0",
                meeting_link: "",
                hostArray: [],
                fee: this.entryFee
            }

        }
    },
    components: {
        SideNav,
        Chips
    },
    methods: {
        checkFormIsFilled() {
            const eventData = this.eventData;


            if (
                !eventData.event_date.trim() ||
                !eventData.title.trim() ||
                !eventData.description.trim() ||
                !eventData.deadline_application.trim() ||
                !eventData.category.trim() ||
                !eventData.venue.trim() ||
                !eventData.event_image
            ) {
                alert("Please fill in all required fields.");
                return false;
            }

            if (!this.ageLimits) {
                this.eventData.age_limit = "0"
            } else {
                if (!eventData.age_limit.trim()) {
                    alert("Please fill in all required fields.");
                    return false;
                }
            }
            if (!this.entryFee) {
                this.eventData.price = 0
            } else {
                if (eventData.price < 0) {
                    alert("Please fill in all required fields.");
                    return false;
                }
            }

            if (this.eventOnline) {
                if (!eventData.meeting_link.trim()) {
                    alert("Please fill in the meeting link.");
                    return false;
                }
            } else {
                if (!eventData.address.trim()) {
                    alert("Please fill in the address.");
                    return false;
                }
            }

            let eventDate = new Date(eventData.event_date);
            let deadlineDate = new Date(eventData.deadline_application);
            let currentDate = new Date();

            if (deadlineDate < currentDate) {
                alert("Deadline date cannot be in the past.");
                return false;
            } else if (deadlineDate > eventDate) {
                alert("Deadline date cannot be past the event date.");
                return false;
            }

            return true;
        }
        ,
        navigateToHost() {
            if (this.checkFormIsFilled()) {
                this.openHost = true
                localStorage.setItem("browsing_state", JSON.stringify({ openHost: true }))
            } else {
                this.openHost = false
            }
        },
        addNewHost() {
            this.eventData.hostArray.push({
                name: "",
                email: "",
                profession: "",
                linkedin: "",
                profile_image: Object
            })
        }, removeHost(index) {
            this.eventData.hostArray.splice(index, 1)
        }, navigateToCreate() {
            this.openHost = false
        }, changeEventVenue(event) {
            if (event.target.value == "online") {
                this.eventOnline = true
                // this.eventData.address = null
            } else {
                this.eventOnline = false
                // this.eventData.meeting_link = null
            }
        }, changeEntryFee(event) {
            if (event.target.value == "yes") {
                this.entryFee = true
                this.eventData.price = 0;
            } else {
                this.entryFee = false
            }

        }, changeAgeLimit(event) {
            if (event.target.value == "yes") {
                this.ageLimits = true
                this.eventData.age_limit = "0"
            } else {
                this.ageLimits = false
            }
        }, handleWindowLoading(event) {
            event.returnValue = "are you sure?"
        }, savedDataLocalStorage() {
            console.log("saving....")
            localStorage.setItem("eventData", JSON.stringify(this.eventData))
        }, handleEventFile(event) {
            let file = event.target.files[0]
            if (file) {
                if (file.type.startsWith("image/")) {
                    if (file.size <= 3 * 1024 * 1024) {
                        this.eventData.event_image = file
                    } else {
                        alert(`Your image file exceeds 3mbs which is ${file.size / 1024 / 1024}`)
                        event.target.value = ""

                    }
                } else {
                    alert(`Required image file type, found ${file.type}`)
                    event.target.value = ""
                }
            }
        }, handleHostFile(index, event) {
            let file = event.target.files[0]
            if (file) {
                if (file.type.startsWith("image/")) {
                    if (file.size <= 3 * 1024 * 1024) {
                        this.eventData.hostArray[index].profile_image = file
                        // this.eventData.event_image = file
                    } else {
                        alert(`Your image file exceeds 3mbs which is ${file.size / 1024 / 1024}`)
                        event.target.value = ""

                    }
                } else {
                    alert(`Required image file type, found ${file.type}`)
                    event.target.value = ""
                }
            }
        }
    }, mounted() {
        // this.addNewHost()
        let savedData = localStorage.getItem("eventData");
        let browersState = localStorage.getItem("browsing_state");
        if (browersState) {
            let state = JSON.parse(browersState);
            this.openHost = state.openHost
        }
        if (savedData) {
            this.eventData = JSON.parse(savedData)
        }
    }, watch: {
        eventData: {
            handler: function (newData, oldData) {
                this.eventData = newData
                this.savedDataLocalStorage()
            },
            deep: true
        }
    }
}
</script>

<template>
    <div class="main-section">
        <SideNav />
        <div class="dash-main">
            <form class="create-container">
                <!-- create -->
                <div v-if="!openHost" class="creating-event">
                    <span>Create New Events</span>
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
                                <select type="text" v-model="eventData.venue" class="event-form" @change="changeEventVenue"
                                    required>
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
                                    <input type="radio" id="fee" value="yes" name="fee" @change="changeEntryFee">
                                    <p>Yes</p>
                                </label>
                                <label class="fee-select-input">
                                    <input type="radio" id="fee" value="no" name="fee" checked @change="changeEntryFee">
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
                                    <input type="radio" id="age" value="yes" @change="changeAgeLimit" name="age">
                                    <p>Yes</p>
                                </label>
                                <label class="fee-select-input">
                                    <input type="radio" id="age" value="no" @change="changeAgeLimit" name="age" checked>
                                    <p>No</p>
                                </label>
                            </div>
                            <!--  -->
                            <div class="input-holder mb-2" v-if="ageLimits">
                                <label class="event-label">Select age limit</label>
                                <select name="age" v-model="eventData.age_limit" class="event-form" required>
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
                </div>
                <!-- add host -->
                <div v-else class="create-host">
                    <div class="create-host-container">
                        <div class="create-host-holder">
                            <div class="create-header">
                                <span>Host Name</span>
                                <span>Host Email</span>
                                <span>Profession</span>
                                <span>Linkedin Url</span>
                                <span>Phote image</span>
                            </div>
                            <div class="create-host-items-holder">


                                <div v-for="(item, index) in eventData.hostArray" :key="index" class="create-host-item">
                                    <div class="inputs-host-holder">
                                        <input type="text" placeholder="Mary" required v-model="item.name">
                                    </div>
                                    <div class="inputs-host-holder">
                                        <input type="email" placeholder="mary@gmail.com" required v-model="item.email">
                                    </div>
                                    <div class="inputs-host-holder">
                                        <input type="text" placeholder="Senior Software Engineer" required
                                            v-model="item.profession">
                                    </div>
                                    <div class="inputs-host-holder">
                                        <input type="text" placeholder="https://wwww.linkedin.com/mary" required
                                            v-model="item.linkedin">
                                    </div>
                                    <div class="inputs-host-holder">
                                        <input type="file" @change="handleHostFile(index, $event)" required>
                                    </div>
                                    <i class='bx bx-x-circle clear-icon' @click="removeHost(index)"></i>
                                </div>

                                <div class="add-icon-host" @click="addNewHost">
                                    <i class='bx bx-plus-circle'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navigations-host">
                        <button type="button" @click="navigateToCreate">Back</button>
                        <button type="submit">Create Event</button>

                    </div>
                </div>
                <!-- end -->

            </form>
        </div>
    </div>
</template>
<style>
@import url("./styles/create.css");
</style>