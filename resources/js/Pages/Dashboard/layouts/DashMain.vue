<script>
export default {

}
</script>

<template>
    <div class="dash-main">
        <div class="dash-holder">
            <div class="top-dash">
                <!-- top left -->
                <div class="travel-advert">
                    <div class="travel-vcard">

                        <v-card class="mx-auto" max-width="auto">
                            <v-img src="images/hero.jpg"></v-img>

                            <div class="event-details">
                                <div class="event-descriptions">

                                    <v-card-title class="event-title">
                                        India Tour Event
                                    </v-card-title>

                                    <v-card-subtitle class="event-place">
                                        Mumbai/India
                                    </v-card-subtitle>

                                    <p class="event-date">
                                        May3,2023
                                    </p>
                                </div>
                                <!-- <div class="event-actions"> -->
                                <v-card-actions class="ev-actions">
                                    <v-card-title class="ev-price">
                                        price:1000
                                    </v-card-title>
                                    <v-btn class="book_button">
                                        Book Ticket
                                    </v-btn>
                                </v-card-actions>
                                <!-- </div> -->
                            </div>

                        </v-card>

                        <div class="top-places">

                            <v-card>
                                <div class="small-card-holder">
                                    <v-img src="images/hero.jpg" cover></v-img>
                                    <div class="text-carfd-holder">
                                        <v-card-subtitle class="text-event-place">
                                            Paris
                                        </v-card-subtitle>
                                        <v-card-subtitle class="text-event-count">
                                            10k
                                        </v-card-subtitle>

                                    </div>
                                </div>
                            </v-card>


                        </div>

                    </div>
                </div>
                <!-- top right -->
                <div class="event-navigation">
                    <div class="events-category-select">
                        <div class="select-item">
                            <i class='bx bx-briefcase-alt'></i>
                            <span>Business</span>
                        </div>

                    </div>
                    <div class="tickets-display">
                        <p>
                            Your Tickets
                        </p>
                        <div class="tickets-cards-holder">
                            <v-card>
                                <v-img class="ticket-image" src="images/hero.jpg" cover></v-img>
                                <p class="ticket-title">DevOps Summit</p>
                                <p class="ticket-number">th568</p>
                                <p class="ticket-date">12May,2023</p>
                                <p class="ticket-time">12:00pm</p>
                            </v-card>

                        </div>
                    </div>
                </div>

            </div>
            <div class="botton-dash">
                <div class="recommended">
                    <p>Recommended</p>
                    <div class="recommended-holder">
                        <v-card>
                            <v-img src="images/image2.jpg" cover></v-img>
                            <v-card-subtitle class="text-caption text-center rec-date">20thMay,2023</v-card-subtitle>
                            <v-card-text class="text-body-2 rec-title ext-center">
                                Let’s Talk Machine Learning
                            </v-card-text>
                            <v-card-subtitle class="text-h7 rec-place text-center">
                                Nairobi
                            </v-card-subtitle>
                            <v-card-subtitle class="text-caption rec-price text-center">
                                500ksh
                            </v-card-subtitle>

                        </v-card>

                    </div>
                </div>
                <div class="saved-events">
                    <p>Saved Events</p>
                    <div class="saved-events-holder">
                        <v-card class="saved-events-card">
                            <div class="saved-holder">
                                <v-img src="images/image2.jpg" cover></v-img>
                                <div class="saved-details">
                                    <p class="text-caption saved-heading text-center">
                                        Talk Machine Learning
                                    </p>
                                    <p class="saved-date">
                                        12June,2023
                                    </p>
                                    <p class="saved-price">
                                        2000
                                    </p>
                                </div>
                            </div>
                        </v-card>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
@import url('../styles/dashmain.css');
</style>