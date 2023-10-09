<script>
export default {
    props: {
        categories: Array
    }, mounted() {
    }, methods: {
        handleCategory(event) {
            this.$emit("handle-category", event.target.value)
        }
    }
}

</script>

<template>
    <div class="event-header">
        <div class="event-header-container">
            <div class="event-category">
                <p>Events</p>
                <div class="category-input">
                    <span>Category</span>
                    <select @change="handleCategory($event)" class="form-select select-input"
                        aria-label="Default select example" v-if="categories">
                        <option selected>All</option>
                        <option v-for="(item, index) in categories" :key="index" :value="item.category_name">{{
                            item.category_name
                        }}</option>
                    </select>
                </div>
            </div>
            <div class="event-search">
                <!-- <button>My Tasks</button> -->
                <div class="input-group mt-3">
                    <span class="input-group-text"><i class='bx bx-search-alt'></i></span>
                    <input type="text" class="form-control search-input" aria-label="Amount (to the nearest dollar)">
                </div>

            </div>
        </div>
    </div>
</template>