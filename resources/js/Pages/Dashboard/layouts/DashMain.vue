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
                            <v-img src="images/hero.jpg" height="200px" cover></v-img>

                            <div class="event-details">
                                <div class="event-descriptions">

                                    <v-card-title class="event-title">
                                        India Tour Event
                                    </v-card-title>

                                    <v-card-subtitle class="event-place">
                                        Mumbai/India
                                    </v-card-subtitle>

                                    <v-card-subtitle class="event-date">
                                        May3,2023
                                    </v-card-subtitle>
                                </div>
                                <div class="event-actions">
                                    <v-card-title>
                                        price:1000
                                    </v-card-title>
                                    <v-card-actions>
                                        <v-btn class="book_button" variant="text">
                                            Book Ticket
                                        </v-btn>

                                        <v-spacer></v-spacer>
                                    </v-card-actions>
                                </div>
                            </div>

                        </v-card>

                        <div class="top-places">

                            <v-card>
                                <div class="small-card-holder">
                                    <v-img src="images/hero.jpg"></v-img>
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
                    hello
                </div>

            </div>
            <div class="botton-dash">world</div>
        </div>
    </div>
</template>
<style>
.dash-main {
    width: 100%;
    height: 100vh;
    padding-left: 15rem;
}

.dash-holder {
    width: 100%;
    height: 100%;
    display: grid;
    padding: 2em;
    grid-template-rows: 1fr 1fr;

}

.top-dash {
    display: grid;
    gap: 0.3em;
    grid-template-columns: 55% 45%;
}

.travel-advert {
    width: 100%;
    height: 100%;
    box-shadow: 2px 3px 4px rgba(0, 0, 0, 0.25);
    border-radius: 0.3em;
    /* border: 1px solid; */
}

.travel-vcard {
    display: grid;
    gap: 1em;
    grid-template-columns: 60% 30%;
    width: 100%;
}

.mx-auto {
    /* border: 2px solid green !important; */
    margin-left: -5em !important;
    width: 100% !important;
}

.event-details {
    display: grid;
    grid-template-columns: 57% 40%;
    justify-content: space-between;
    height: 9rem;
}

.event-actions {
    display: flex;
    width: 100%;
    flex-direction: column;
    align-items: end;
    justify-content: space-evenly;
}

.event-actions>.v-card-title {
    color: var(--main-blue) !important;
    font-size: 0.9em;
    display: grid;
    place-items: center;
    padding: 0.1em;
    background: var(--main-orange);
    border-radius: 0.4em;
}

.book_button {
    background: var(--main-green) !important;
    color: var(--main-white) !important;
}

.event-title {
    color: var(--main-blue) !important;
}

.event-place {
    color: var(--main-orange);
    font-size: 1em !important;
}

.event-date {
    color: var(--main-green);
    margin-top: 2em;
}

.small-card-holder {
    display: flex;
}

.text-event-place {
    font-size: 1.2em !important;
    color: var(--main-green) !important;
    font-weight: bold !important;
}

.text-carfd-holder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-evenly;
}

.text-event-count {
    color: var(--main-orange);
}

.top-places {
    display: flex;
    flex-direction: column;
    gap: 0.3em;
}

/* top-right */
.event-navigation {
    background: gray;
}

/* bottom dash */

/* .botton-dash {
    border: 1px solid;
} */

@media screen and (max-width: 1200px) {
    .dash-main {
        padding-left: 20%;
    }
}
</style>