<script>
import SideNav from "../Dashboard/components/SideNav.vue"
import ProfileDetails from "./components/ProfileDetails.vue"
import ProfileImage from "./components/ProfileImage.vue"
export default {
    data() {
        return {
            openUpdate: false,
            updateData: {
                first_name: "",
                last_name: "",
                phone_name: "",
                country: "",
                state: "",
                profile_image: ""

            }, file: ""
        }
    },
    components: {
        SideNav,
        ProfileDetails,
        ProfileImage
    }, methods: {
        toggleUpdate() {
            this.openUpdate = true
        },
        handleProfile(event) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.file = e.target.result;
                this.updateData.profile_image = this.file;
            };
            reader.readAsDataURL(this.file);
        }
    }
}
</script>
<template>
    <div class="main-section">
        <SideNav />
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
                        <input v-model="updateData.phone_name" required type="text" class="form-control" id="Phone Number">
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
                <ProfileDetails />
                <ProfileImage @toggle_update="toggleUpdate" />
            </div>
        </div>
    </div>
</template>
<style>
@import url("./styles/Profile.css");
</style>