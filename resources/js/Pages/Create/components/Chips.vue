<script>
export default {
    props: {
        eventData: Object
    },
    data() {
        return {
            category: [

            ]
        }
    }, methods: {
        updateCategory(event) {
            // this.category.push({
            //     event
            // })
            console.log(this.eventData)
        }
    }
}
</script>

<template>
    <div class="chips-container">
        <!-- Business and Networking Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="businessNetworking" value="Business" name="category">
            <label for="businessNetworking">Business</label>
        </div>

        <!-- Entertainment Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="entertainment" value="Entertainment" name="category">
            <label for="entertainment">Entertainment</label>
        </div>

        <!-- Educational and Academic Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="educationalAcademic" value="Educational" name="category">
            <label for="educationalAcademic">Educational</label>
        </div>

        <!-- Sports and Fitness Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="sportsFitness" value="Sports" name="category">
            <label for="sportsFitness">Sports</label>
        </div>

        <!-- Cultural and Heritage Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="culturalHeritage" value="Cultural" name="category">
            <label for="culturalHeritage">Cultural</label>
        </div>

        <!-- Community and Charity Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="communityCharity" value="Community" name="category">
            <label for="communityCharity">Community</label>
        </div>

        <!-- Tech and Innovation Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="techInnovation" value="Tech" name="category">
            <label for="techInnovation">Tech</label>
        </div>

        <!-- Weddings and Social Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="weddingsSocial" value="Socials" name="category">
            <label for="weddingsSocial">Socials</label>
        </div>

        <!-- Health and Wellness Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="healthWellness" value="Health" name="category">
            <label for="healthWellness">Health</label>
        </div>

        <!-- Environmental and Sustainability Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="environmentalSustainability" value="Environmental"
                name="category">
            <label for="environmentalSustainability">Environmental</label>
        </div>

        <!-- Art and Creative Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="artCreative" value="Creativity" name="category">
            <label for="artCreative">Creativity</label>
        </div>

        <!-- Fashion and Beauty Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="fashionBeauty" value="Fashion" name="category">
            <label for="fashionBeauty">Fashion</label>
        </div>

        <!-- Food and Beverage Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="foodBeverage" value="Food" name="category">
            <label for="foodBeverage">Food</label>
        </div>

        <!-- Travel and Adventure Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="travelAdventure" value="Adventure" name="category">
            <label for="travelAdventure">Adventure</label>
        </div>

        <!-- Religious and Spiritual Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="religiousSpiritual" value="Religious" name="category">
            <label for="religiousSpiritual">Religious</label>
        </div>

        <!-- Science and Technology Events -->
        <div class="chip">
            <input v-model="eventData.category" type="radio" id="scienceTechnology" value="Science" name="category">
            <label for="scienceTechnology">Science</label>
        </div>
    </div>
</template>
