<script>
export default {
    data() {

    }, methods: {
        toggleUpdate() {
            this.$emit("toggle_update")
        }
    }
}
</script>
<template>
    <div class="profile-image-container">
        <div class="profile-image-holder">
            <img src="" alt="">
        </div>
        <div class="profile-details-items profile-name">
            <span>Username</span>
            <p>Vincent</p>
        </div>
        <div class="profile-details-items profile-name">
            <span>Account Created</span>
            <p>2 days ago</p>
        </div>

        <div class="profile-details-items profile-name">
            <button @click="toggleUpdate">Update Profile</button>
        </div>
    </div>
</template>