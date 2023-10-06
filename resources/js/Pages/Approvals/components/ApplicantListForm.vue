<script>
export default {
    props: {
        applicants: Array
    }, methods: {
        calculateDays(date) {
            let current = new Date();
            let eventTime = new Date(date)
            if (eventTime) {
                let diffMill = eventTime - current
                let days = Math.ceil(diffMill / (1000 * 60 * 60 * 24));
                return days;
            } else {
                return "N/A"
            }

        }, calculatePrice(price) {
            if (price <= 0) {
                return "Free"
            } else if (price > 0) {
                return `${price} Ksh`
            }
        }, viewApplication(id) {
            this.$emit("view_application", id)
        }
    }
}
</script>
<template>
    <form class="events-part-content">

        <div class="event-part-item" v-for="(item, index) in applicants" :key="index">
            <div class="part-name">
                <span>{{ item.user.username }}</span>
                <p>{{ item.user.time_registered }}</p>
            </div>
            <div class="part-action">
                <button type="button" @click="viewApplication(item.event_application_id)">view</button>
                <div class="form-check">
                    <input v-model="item.state" class="form-check-input" type="checkbox" value="accepted"
                        id="flexCheckDefault">
                </div>
            </div>
        </div>

    </form>
</template>
