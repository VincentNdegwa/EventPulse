<script>
import SideNav from '../Dashboard/components/SideNav.vue';
import EventHeader from './components/EventHeader.vue';
export default {
    components: {
        SideNav,
        EventHeader
    }
}

</script>

<template>
    <div class="main-section">
        <SideNav />
        <div class="dash-main">
            <div class="events-container">
                <EventHeader />
                <div class="event-body">
                    <div class="event-container">
                        <div class="card" style="">
                            <img src="images/image2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Tech Innovators Symposium</p>
                                <span>A gathering of leading tech visionaries discussing the future of innovation</span>
                                <div class="event-desc-display">
                                    <span>Silicon Valley</span>
                                    <span>Technology</span>
                                    <p>12May,2023::12pm</p>
                                </div>
                                <h6>1000ksh</h6>
                            </div>
                        </div>
                        <div class="card" style="">
                            <img src="images/image2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Tech Innovators Symposium</p>
                                <span>A gathering of leading tech visionaries discussing the future of innovation</span>
                                <div class="event-desc-display">
                                    <span>Silicon Valley</span>
                                    <span>Technology</span>
                                    <p>12May,2023::12pm</p>
                                </div>
                                <h6>1000ksh</h6>
                            </div>
                        </div>

                        <div class="card" style="">
                            <img src="images/image2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">Tech Innovators Symposium</p>
                                <span>A gathering of leading tech visionaries discussing the future of innovation</span>
                                <div class="event-desc-display">
                                    <span>Silicon Valley</span>
                                    <span>Technology</span>
                                    <p>12May,2023::12pm</p>
                                </div>
                                <h6>1000ksh</h6>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<style>
@import url("./styles/event-header.css");
@import url("./styles//events.css");
</style>