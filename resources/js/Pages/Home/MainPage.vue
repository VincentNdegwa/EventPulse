<script>
import TopHeader from './components/TopHeader.vue';
import HeroSection from './components/HeroSection.vue';
import Events from './components/Events.vue';

import Sponsors from "../../data/sponsors"
export default {
    data() {
        return {
            Sponsors
        }
    },
    components: {
        TopHeader,
        HeroSection,
        Events
    },
    setup() {
        return {
        }
    }
}
</script>

<template>
    <section class="main_section">
        <div class="home-conatiner">
            <TopHeader />
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
</style>

