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
                profile_image: ""

            }, file: "",
            loading: false,
            userData: Object
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
            this.userData.first_name = this.updateData.first_name
            this.userData.last_name = this.updateData.last_name
            this.userData.phone_number = this.updateData.phone_number
            this.userData.state = this.updateData.state
            this.userData.country = this.updateData.country

        },
        handleProfile(event) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.file = e.target.result;
                this.updateData.profile_image = this.file;
            };
            reader.readAsDataURL(this.file);
        }, requestData() {
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
                console.log(this.userData)
            }).catch(err => {
                this.loading = false
                this.$refs.sweetAlerts.showMessage(err)
                console.log(err)
            })

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
                    <button class="mt-3 update-button">Update</button>

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