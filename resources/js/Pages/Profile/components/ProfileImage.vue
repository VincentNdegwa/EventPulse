<script>
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime"
export default {
    props: {
        userData: Object
    },
    data() {

    }, methods: {
        toggleUpdate() {
            this.$emit("toggle_update")
        },
        readableDate(date) {
            dayjs.extend(relativeTime);
            return dayjs(date).fromNow()
        }
    }
}
</script>
<template>
    <div v-if="userData.profile" class="profile-container-holder">

        <div class="profile-image-container">
            <div class="profile-image-holder">
                <img :src="userData.profile.profile_image ? userData.profile.profile_image : 'images/avatar.jpg'" alt="">
            </div>
            <div class="profile-details-items profile-name">
                <span>Username</span>
                <p>{{ userData.username }}</p>
            </div>
            <div class="profile-details-items profile-name">
                <span>Account Created</span>
                <p>{{ readableDate(userData.created_at) }}</p>
            </div>

            <div class="profile-details-items profile-name">
                <button @click="toggleUpdate">Update Profile</button>
            </div>
        </div>

    </div>
</template>