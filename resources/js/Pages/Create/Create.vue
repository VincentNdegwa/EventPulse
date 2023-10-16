<script>
import SideNav from "../Dashboard/components/SideNav.vue"
import axios from "axios"
import EventCreation from "./components/EventCreation.vue"
import HostComp from "./components/Host.vue"
import SweetAlerts from "@/components/SweetAlerts.vue"
import { router } from "@inertiajs/vue3"
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
                event_image: "",
                title: "",
                description: "",
                deadline_application: "",
                event_date: "",
                category: "",
                creator_id: "",
                venue: "",
                price: 0,
                address: "",
                age_limit: "0",
                meeting_link: "",
                hostArray: [],
                setFee: "no",
                setAge: "no"
            }

        }
    },
    components: {
        SideNav,
        EventCreation,
        HostComp, SweetAlerts
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
                this.$refs.sweetAlerts.showNotificationError("Please fill in all required fields.")
                return false;
            }

            if (!this.ageLimits) {
                this.eventData.age_limit = "0"
            } else {
                if (!eventData.age_limit.trim()) {
                    this.$refs.sweetAlerts.showNotificationError("Please fill in all required fields.")
                    return false;
                }
            }
            if (!this.entryFee) {
                this.eventData.price = 0
            } else {
                if (eventData.price < 0) {
                    this.$refs.sweetAlerts.showNotificationError("Please fill in all required fields.")
                    return false;
                }
            }

            if (this.eventOnline) {
                if (!eventData.meeting_link.trim() || eventData.meeting_link == "null") {
                    this.$refs.sweetAlerts.showNotificationError("Please fill in in the meeting link.")
                    // this.eventData.address = "null"
                    return false;
                }
            } else {
                if (!eventData.address.trim() || eventData.address == "null") {
                    this.$refs.sweetAlerts.showNotificationError("Please fill in in the adsdress")
                    // this.eventData.meeting_link = "null"
                    return false;
                }
            }
            if (this.eventData.setAge == "yes") {
                if (!eventData.age_limit.trim() || eventData.age_limit == "0") {
                    this.$refs.sweetAlerts.showNotificationError("Please add age limit or select 'no'")
                    return false;
                }
            }
            if (this.eventData.setFee == "yes") {
                if (eventData.price <= 0) {
                    this.$refs.sweetAlerts.showNotificationError("Please add age price or select 'no'")
                    return false;
                }
            }

            let eventDate = new Date(eventData.event_date);
            let deadlineDate = new Date(eventData.deadline_application);
            let currentDate = new Date();

            if (deadlineDate < currentDate) {
                this.$refs.sweetAlerts.showNotificationError("Deadline date cannot be in the past.")
                return false;
            } else if (deadlineDate > eventDate) {
                this.$refs.sweetAlerts.showNotificationError("Deadline date cannot be past the event date.")
                return false;
            }

            return true;
        }
        ,
        navigateToHost() {
            if (this.checkFormIsFilled()) {
                this.openHost = true
            } else {
                this.openHost = false
            }
        },
        addNewHost() {
            this.eventData.hostArray.push({
                host_name: "",
                host_email: "",
                host_occupation: "",
                host_social: "",
                profile_image: ""
            })
        }, changeEventVenue(event) {
            if (event.target.value == "online") {
                this.eventOnline = true
                this.eventData.address = "null"
            } else {
                this.eventOnline = false
                this.eventData.meeting_link = "null"
            }
        }, changeEntryFee(event) {
            if (event.target.value == "yes") {
                this.entryFee = true
            } else {
                this.entryFee = false
                this.eventData.price = 0;
            }

        }, changeAgeLimit(event) {
            if (event.target.value == "yes") {
                this.ageLimits = true
                this.eventData.age_limit = "0"
            } else {
                this.ageLimits = false
            }
        }, removeHost(index) {
            this.eventData.hostArray.splice(index, 1)
        }, navigateToCreate() {
            this.openHost = false
        }, handleWindowLoading(event) {
            event.returnValue = "are you sure?"
        }, savedDataLocalStorage() {
            localStorage.setItem("eventData", JSON.stringify(this.eventData))
        }, updatedBrowserState() {
            localStorage.setItem("browsing_state", JSON.stringify({
                openHost: this.openHost,
                eventOnline: this.eventOnline,
                entryFee: this.entryFee,
                ageLimits: this.ageLimits,
            }))

        }, handleHostFile(index, event) {
            let file = event.target.files[0];
            if (file) {
                if (file.type.startsWith("image/")) {
                    if (file.size <= 3 * 1024 * 1024) {
                        const reader = new FileReader()
                        reader.readAsDataURL(file)
                        reader.onload = () => {
                            let fileBase64 = reader.result
                            this.eventData.hostArray[index].profile_image = fileBase64;
                            localStorage.setItem(`host_image_${index}`, fileBase64);
                        }
                    } else {
                        this.$refs.sweetAlerts.showMessage(`Host image exceeds 3mbs which is ${file.size / 1024 / 1024}`)
                        event.target.value = "";
                    }
                } else {
                    this.$refs.sweetAlerts.showMessage(`Required image file type, found ${file.type}`)
                    event.target.value = "";
                }
            }
        }, createEvent() {
            axios.post("/user-id").then(res => {
                if (res) {
                    let userid = res?.data.userId
                    this.eventData.creator_id = userid
                    axios.post("api/create-event", this.eventData).then(res => {
                        if (res) {
                            if (!res?.data?.error) {
                                router.visit(route("my-events"));
                                localStorage.removeItem("eventData")
                                localStorage.removeItem("browsing_state")
                            } else {
                                this.$refs.sweetAlerts.showNotificationError(res.data.message)
                            }
                        } else {
                            this.$refs.sweetAlerts.showNotificationError("Creating event failed")
                        }
                    }).catch(err => {
                        this.$refs.sweetAlerts.showNotificationError(err)
                    })
                }
            }).catch(err => {
                this.$refs.sweetAlerts.showMessage("An error occurred")
            })
        }
    }, mounted() {
        let savedData = localStorage.getItem("eventData");
        let browersState = localStorage.getItem("browsing_state");
        let savedEventImage = localStorage.getItem("event_image");
        if (browersState) {
            let state = JSON.parse(browersState);
            this.openHost = state.openHost
            this.eventOnline = state.eventOnline
            this.entryFee = state.entryFee
            this.ageLimits = state.ageLimits
        }
        if (savedData) {
            this.eventData = JSON.parse(savedData)
        }
        if (savedEventImage) {
            this.eventData.event_image = savedEventImage;
        }
        this.eventData.hostArray.forEach((host, index) => {
            const savedHostImage = localStorage.getItem(`host_image_${index}`);
            if (savedHostImage) {
                host.profile_image = savedHostImage;
            }
        });

    }, watch: {
        eventData: {
            handler: function (newData, oldData) {
                this.eventData = newData
                this.savedDataLocalStorage()
            },
            deep: true
        },
        openHost: {
            handler: function (newHost, oldHost) {
                this.updatedBrowserState()
                this.openHost = newHost
            },
            deep: true
        }, eventOnline: {
            handler: function (latest, old) {
                this.updatedBrowserState();
                this.eventOnline = latest;
            },
            deep: true,
        },
        entryFee: {
            handler: function (latest, old) {
                this.updatedBrowserState();
                this.entryFee = latest;
            },
            deep: true,
        },
        ageLimits: {
            handler: function (latest, old) {
                this.updatedBrowserState();
                this.ageLimits = latest;
            },
            deep: true,
        },
    }
}
</script>

<template>
    <SweetAlerts ref="sweetAlerts"></SweetAlerts>
    <div class="main-section">
        <SideNav />
        <div class="dash-main">
            <form @submit.prevent="createEvent" class="create-container">
                <!-- create -->
                <div v-if="!openHost" class="creating-event">
                    <span>Create New Events</span>
                    <EventCreation :eventData="eventData" :eventOnline="eventOnline" :entryFee="entryFee"
                        :ageLimits="ageLimits" @navigate-host="navigateToHost" @change-event-venue="changeEventVenue"
                        @change-entry-fee="changeEntryFee" @change-age-limit="changeAgeLimit" />
                </div>
                <!-- add host -->
                <div v-else class="create-host">
                    <HostComp :eventData="eventData" @handle-host-file="handleHostFile" @remove-host="removeHost"
                        @add-new-host="addNewHost" />
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