<script>
import TopHeader from './components/TopHeader.vue';
import HeroSection from './components/HeroSection.vue';
import Events from './components/Events.vue';
import Sponsors from "../../data/sponsors"
import Loader from '@/components/Loader.vue';
import axios from 'axios';
export default {
    props: {
        userId: Number,
        loggedIn: Boolean
    },
    data() {
        return {
            Sponsors,
            loading: false
        }
    },
    components: {
        TopHeader,
        HeroSection,
        Events,
        Loader
    }, mounted() {
        this.requestData()
    }, methods: {
        requestData() {
            axios.post("api/retrieve").then(res => {
                console.log(res.data)
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>

<template>
    <section class="main_section">
        <Loader :loading="loading" />
        <div class="home-conatiner">
            <TopHeader :loggedIn="loggedIn" />
            <HeroSection />
            <Events />
            <div class="sponsors-holder cont" id="Support">
                <div class="sponsors-container">
                    <span>Companies That Support EventPulse</span>
                    <div class="sponsor-cards">
                        <div class="sponsor-car-item" v-for="(item, index) in Sponsors" :key="index">
                            <p>{{ item.name }}</p>
                            <img :src="item.url" alt="">
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>
</template>

<style>
@import url("./styles//header.css");
@import url("./styles//hero.css");
@import url("./styles/events.css");
@import url("./styles/sponsor.css");
@import url("../../../css/app.css");
</style>

