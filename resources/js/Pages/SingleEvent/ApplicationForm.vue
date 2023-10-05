<script>
export default {
    props: {
        userInputs: Object
    }, methods: {
        submittData() {
            this.$emit("submiting_form")
        }
    }

}
</script>
<template>
    <div class="form-container-application">
        <form @submit.prevent="submittData" action="" class="form-control container">
            <span>Marked <p class="red-asterik">*</p> are requied inputs</span>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Tell us about your main agenda for
                    attending this event<p class="red-asterik">*</p></label>
                <input v-model="userInputs.main_agenda" class="form-control" id="exampleFormControlTextarea1" rows="3"
                    name="main_agenda" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea2" class="form-label">What do you expect to gain from this
                    event?<p class="red-asterik">*</p></label>
                <textarea v-model="userInputs.expectations" class="form-control" id="exampleFormControlTextarea2" rows="3"
                    name="expectations" required></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea4" class="form-label">Have you attended similar events in
                    the
                    past? If so, which one?<p class="red-asterik">*</p></label>
                <input v-model="userInputs.similar_event" class="form-control" id="exampleFormControlTextarea4" rows="3"
                    name="previous_experience" required />
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea6" class="form-label">Learning Objectives: What specific
                    knowledge or skills do you hope to gain from this event?</label>
                <textarea v-model="userInputs.learning_objective" class="form-control" id="exampleFormControlTextarea6"
                    rows="3" name="learning_objectives"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea7" class="form-label">Do you have any suggestions or ideas
                    for
                    improving this event?</label>
                <textarea v-model="userInputs.suggestions" class="form-control" id="exampleFormControlTextarea7" rows="3"
                    name="event_improvements"></textarea>
            </div>
            <button type="submit" class="application-button">Apply</button>
        </form>
    </div>
</template>