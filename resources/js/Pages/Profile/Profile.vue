<script>
import SideNav from "../Dashboard/components/SideNav.vue"
import ProfileDetails from "./components/ProfileDetails.vue"
import ProfileImage from "./components/ProfileImage.vue"
import Loader from "@/components/Loader.vue"
import SweetAlerts from "@/components/SweetAlerts.vue"
import axios from "axios"
export default {
    data() {
        return {
            openUpdate: false,
            updateData: {
                first_name: "",
                last_name: "",
                phone_number: "",
                country: "",
                state: "",
                profile_image: "",
                user_id: "",

            }, file: "",
            loading: false,
            userData: Object,
            user_id: ""
        }
    },
    components: {
        SideNav,
        ProfileDetails,
        ProfileImage,
        Loader,
        SweetAlerts
    }, methods: {
        toggleUpdate() {
            this.openUpdate = true
            this.updateData.first_name = this.userData.profile.first_name
            this.updateData.last_name = this.userData.profile.last_name
            this.updateData.phone_number = this.userData.profile.phone_number
            this.updateData.state = this.userData.profile.state
            this.updateData.country = this.userData.profile.country
            this.updateData.user_id = this.userData.id

            this.file = this.userData.profile.profile_image
            console.log(this.userData)

        },
        handleProfile(event) {
            const reader = new FileReader();
            const file = event.target.files[0];

            reader.onload = (e) => {
                const fileData = e.target.result;
                this.updateData.profile_image = fileData;
                this.file = fileData
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }
        , requestData() {
            this.loading = true
            let user = localStorage.getItem("user_details");

            if (user) {
                let user_id = JSON.parse(user).user_id;
                this.user_id = user_id
            }
            axios.post("api/profile/retrieve", { user_id: this.user_id }).then(res => {
                this.loading = false
                if (!res.data.error) {
                    this.userData = res.data.data
                } else {
                    this.$refs.sweetAlerts.showNotificationError(res.data.message)
                }
            }).catch(err => {
                this.loading = false
                this.$refs.sweetAlerts.showMessage(err)
                console.log(err)
            })

        }, updateProfile() {
            this.loading = true
            axios.post("api/profile/update", this.updateData).then(res => {
                this.openUpdate = false
                if (!res.data.error) {
                    this.$refs.sweetAlerts.showNotification(res.data.message)
                } else {
                    this.$refs.sweetAlerts.showNotificationError(res.data.message)
                }
                this.loading = false
            }).catch(err => {
                this.$refs.sweetAlerts.showMessage("An error occured,Please try again")
                console.log('err', err)
                this.loading = false
            })
        }, goBack() {
            window.history.back()
        }
    }, mounted() {
        this.requestData()
    }
}
</script>
<template>
    <Loader :loading="loading" />
    <div class="main-section">
        <SideNav />
        <SweetAlerts ref="sweetAlerts"></SweetAlerts>
        <div class="dash-main">

            <div v-if="openUpdate" class="update-profile">
                <div class="profile-image-test">
                    <img :src="file ? file : 'images/avatar.jpg'" alt="">
                </div>
                <form action="">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Profile Image</label>
                        <input @change="handleProfile($event)" class="form-control" type="file" id="formFile">
                    </div>
                    <div class="mb-3">
                        <label for="First Name" class="form-label">First Name</label>
                        <input v-model="updateData.first_name" required type="text" class="form-control" id="First Name">
                    </div>
                    <div class="mb-3">
                        <label for="Last Name" class="form-label">Last Name</label>
                        <input v-model="updateData.last_name" required type="text" class="form-control" id="Last Name">
                    </div>
                    <div class="mb-3">
                        <label for="Phone Number" class="form-label">Phone Number</label>
                        <input v-model="updateData.phone_number" required type="text" class="form-control"
                            id="Phone Number">
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <input v-model="updateData.country" required type="text" class="form-control"
                                placeholder="Country" aria-label="Country">
                        </div>
                        <div class="col">
                            <input v-model="updateData.state" required type="text" class="form-control" placeholder="State"
                                aria-label="State">
                        </div>
                    </div>
                    <button type="button" @click="updateProfile" class="mt-3 update-button">Update</button>
                    <button type="button" @click="goBack" class="mt-3 update-button ml-6 cancel-button">Cancel</button>


                </form>
            </div>


            <div v-else class="profile-container">
                <ProfileDetails :userData="userData" />
                <ProfileImage @toggle_update="toggleUpdate" :userData="userData" />
            </div>
        </div>
    </div>
</template>
<style>
@import url("./styles/Profile.css");
</style>