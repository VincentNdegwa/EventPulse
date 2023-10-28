<script>
import axios from 'axios';
export default {
    props: {
        mainData: Object
    },
    data() {
        return {
            eventsData: {},
            latestEvents: [],
            recomendedEvents: [],
            trendingEvents: [],
            upCommingEvents: []
        }
    }, methods: {
        joinData() {
            console.log(this.eventsData)
            this.latestEvents = this.eventsData.latestEvents
            this.recomendedEvents = this.eventsData.recomendedEvents
            this.trendingEvents = this.eventsData.trendingEvents
            this.upCommingEvents = this.eventsData.upCommingEvents
        }
    },
    mounted() {
    },
    watch: {
        immediate: true,
        mainData: {
            handler: function (newData, oldEvents) {
                this.eventsData = newData
                this.joinData()
                console.log("changed")
            }, deep: true
        }
    }

}
</script>

<template>
    <div class="view-container" id="events">
        <div class="view-holder">
            <span>Latest Events</span>
            <div class="event-latest">
                <div class="card-container" v-for="(item, index) in latestEvents" :key="index">
                    <div class="card">
                        <div class="card-image">
                            <img :src="item.event_image" alt="">
                        </div>
                        <div class="event-date">{{ item.event_date }}</div>
                        <div class="event-title">{{ item.title }}</div>
                        <div class="event-description">{{ item.description }}</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>
                <div class="card-container">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/hero.jpg" alt="">
                        </div>
                        <div class="event-date">Wed/March 15 12:00pm</div>
                        <div class="event-title">FutureTech Symposium: Shaping Tomorrow's World</div>
                        <div class="event-description">Explore the frontiers of innovation at our FutureTech
                            Symposium,
                            where
                            visionaries converge to discuss emerging technologies</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>

                <div class="card-container">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/hero.jpg" alt="">
                        </div>
                        <div class="event-date">Wed/March 15 12:00pm</div>
                        <div class="event-title">FutureTech Symposium: Shaping Tomorrow's World</div>
                        <div class="event-description">Explore the frontiers of innovation at our FutureTech
                            Symposium,
                            where
                            visionaries converge to discuss emerging technologies</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>




                <div class="card-container">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/hero.jpg" alt="">
                        </div>
                        <div class="event-date">Wed/March 15 12:00pm</div>
                        <div class="event-title">FutureTech Symposium: Shaping Tomorrow's World</div>
                        <div class="event-description">Explore the frontiers of innovation at our FutureTech
                            Symposium,
                            where
                            visionaries converge to discuss emerging technologies</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="view-holder">
            <span>Top Events</span>
            <div class="event-latest">
                <div class="card-container" v-for="(item, index) in trendingEvents" :key="index">
                    <div class="card">
                        <div class="card-image">
                            <img :src="item.event_image" alt="">
                        </div>
                        <div class="event-date">{{ item.event_date }}</div>
                        <div class="event-title">{{ item.title }}</div>
                        <div class="event-description">{{ item.description }}</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>
                <div class="card-container">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/hero.jpg" alt="">
                        </div>
                        <div class="event-date">Wed/March 15 12:00pm</div>
                        <div class="event-title">FutureTech Symposium: Shaping Tomorrow's World</div>
                        <div class="event-description">Explore the frontiers of innovation at our FutureTech
                            Symposium,
                            where
                            visionaries converge to discuss emerging technologies</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>

                <div class="card-container">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/hero.jpg" alt="">
                        </div>
                        <div class="event-date">Wed/March 15 12:00pm</div>
                        <div class="event-title">FutureTech Symposium: Shaping Tomorrow's World</div>
                        <div class="event-description">Explore the frontiers of innovation at our FutureTech
                            Symposium,
                            where
                            visionaries converge to discuss emerging technologies</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>

                <div class="card-container">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/hero.jpg" alt="">
                        </div>
                        <div class="event-date">Wed/March 15 12:00pm</div>
                        <div class="event-title">FutureTech Symposium: Shaping Tomorrow's World</div>
                        <div class="event-description">Explore the frontiers of innovation at our FutureTech
                            Symposium,
                            where
                            visionaries converge to discuss emerging technologies</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>



                <div class="card-container">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/hero.jpg" alt="">
                        </div>
                        <div class="event-date">Wed/March 15 12:00pm</div>
                        <div class="event-title">FutureTech Symposium: Shaping Tomorrow's World</div>
                        <div class="event-description">Explore the frontiers of innovation at our FutureTech
                            Symposium,
                            where
                            visionaries converge to discuss emerging technologies</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>



                <div class="card-container">
                    <div class="card">
                        <div class="card-image">
                            <img src="images/hero.jpg" alt="">
                        </div>
                        <div class="event-date">Wed/March 15 12:00pm</div>
                        <div class="event-title">FutureTech Symposium: Shaping Tomorrow's World</div>
                        <div class="event-description">Explore the frontiers of innovation at our FutureTech
                            Symposium,
                            where
                            visionaries converge to discuss emerging technologies</div>
                        <div class="event-cta">View More&gt;</div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>