<script>
export default {
    props: {
        eventData: Object
    }, methods: {
        handleHostFile(index, $event) {
            this.$emit("handle-host-file", index, $event)
        }, removeHost(index) {
            this.$emit("remove-host", index)
        }, addNewHost() {
            this.$emit("add-new-host")
        }
    }
}
</script>
<template>
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
                        <input type="text" placeholder="Mary" required v-model="item.host_name">
                    </div>
                    <div class="inputs-host-holder">
                        <input type="email" placeholder="mary@gmail.com" required v-model="item.host_email">
                    </div>
                    <div class="inputs-host-holder">
                        <input type="text" placeholder="Senior Software Engineer" required v-model="item.host_occupation">
                    </div>
                    <div class="inputs-host-holder">
                        <input type="text" placeholder="https://wwww.linkedin.com/mary" required v-model="item.host_social">
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
</template>