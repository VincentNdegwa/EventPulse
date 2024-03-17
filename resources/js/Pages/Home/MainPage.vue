<script>
import TopHeader from './components/TopHeader.vue';
import HeroSection from './components/HeroSection.vue';
import Events from './components/Events.vue';
import Loader from '@/components/Loader.vue';
import axios from 'axios';
import SweetAlerts from '@/components/SweetAlerts.vue';
import SponsorComponent from "./components/SponsorComponent.vue"
import Steps from './components/Steps.vue';
import AboutUs from './components/AboutUs.vue';
import Faqs from './components/Faqs.vue';
export default {
    props: {
        userId: Number,
        loggedIn: Boolean
    },
    data() {
        return {
            loading: false,
            mainData: {}
        }
    },
    components: {
        TopHeader,
        HeroSection,
        Events,
        Loader,
        SweetAlerts,
        SponsorComponent,
        Steps,
        AboutUs,
        Faqs,
    }, mounted() {
        this.requestData()
    }, methods: {
        requestData() {
            this.loading = true
            axios.post("api/retrieve").then(res => {
                this.loading = false
                if (!res.data.error) {
                    this.mainData = res.data
                } else {
                    this.$refs.SweetAlerts.showMessage(res.data.message)
                    this.loading = false
                }
                // console.log(res.data)
            }).catch(err => {
                this.$refs.SweetAlerts.showMessage(err)
                console.log(err)
            })
        }
    }
}
</script>

<template>
    <section class="main_section">
        <Loader :loading="loading" />
        <SweetAlerts ref="SweetAlerts"></SweetAlerts>
        <div class="home-conatiner">
            <TopHeader :loggedIn="loggedIn" />
            <HeroSection />
            <Steps />
            <AboutUs />
            <Faqs />
            <Events :mainData="mainData" />

            <div class="sponsors-holder cont" id="Support">
                <div class="sponsors-container">
                    <span>Companies That Support EventPulse</span>
                    <div class="sponsor-cards">
                        <SponsorComponent />
                        <!-- <div class="sponsor-car-item" v-for="(item, index) in Sponsors" :key="index">
                            <p>{{ item.name }}</p>
                            <img :src="item.url" alt="">
                        </div> -->

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
