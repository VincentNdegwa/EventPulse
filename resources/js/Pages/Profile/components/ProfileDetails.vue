<script>
export default {
    props: {
        userData: Object
    }, methods: {

    },
}
</script>

<template>
    <div v-if="userData.profile" class="profile-details">
        <div class="profile-details-items">
            <span>First Name:</span>
            <p>{{ userData.profile.first_name ? userData.profile.first_name : "No Name" }}</p>
        </div>
        <div class="profile-details-items">
            <span>Last Name</span>
            <p>{{ userData.profile.last_name ? userData.profile.last_name : "No Name" }}</p>
        </div>
        <div class="profile-details-items">
            <span>Email</span>
            <p>{{ userData.email }}</p>
        </div>
        <div class="profile-details-items">
            <span>Email Status</span>
            <p>Inactive</p>
        </div>
        <div class="profile-details-items">
            <span>Phone No</span>
            <p>{{ userData.profile.phone_number ? userData.profile.phone_number : "No Phone" }}</p>
        </div>
        <div class="profile-details-items">
            <span>Phone Status</span>
            <p>Inactive</p>
        </div>
        <div class="profile-details-items">
            <span>Address</span>
            <p>{{ userData.profile.country ? userData.profile.country : "N/A" }},{{ userData.profile.state ?
                userData.profile.state : "N/A" }} </p>
        </div>
    </div>
</template>