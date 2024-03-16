<template>
    <div class="steps_container">
        <div class="heading_step">
            <h3>Journey To Your Event</h3>
            <p>Discover the steps leading to your event and make the most out of your experience. From registration to
                participation, embark on a memorable journey!</p>
        </div>
        <div class="steps_holder">
            <div class="step_card">
                <div class="step_illustrator">
                    <img src="images/apply.png" alt="apply">
                </div>
                <div class="step_name">
                    Apply for the event
                </div>
                <div class="step_description">
                    Fill out the application form to register for the event.
                </div>
            </div>

            <div class="step_card">
                <div class="step_illustrator">
                    <img src="images/wait.png" alt="wait">
                </div>
                <div class="step_name">
                    Wait for event date
                </div>
                <div class="step_description">
                    Await confirmation of your registration and stay updated for the event date announcement.
                </div>
            </div>

            <div class="step_card">
                <div class="step_illustrator">
                    <img src="images/party.png" alt="party">
                </div>
                <div class="step_name">
                    Attend the event
                </div>
                <div class="step_description">
                    Join the event on the specified date and enjoy the festivities!
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.steps_container {
    background: var(--main-blue);
    height: auto;
    width: 100%;
    color: var(--main-white);
    padding: 1rem;
}


.heading_step {
    text-align: center;

    & h3 {
        font-size: 3rem;
    }
}

.step_name,
.step_description {
    text-align: center;
}

.step_name {
    color: var(--main-orange);
    font-weight: bold;
    font-size: 1.3rem;
}

.step_illustrator {
    --ilust-height: 300px;
    width: 100%;
    height: var(--ilust-height);
    padding: 1rem;

    & img {
        width: 100%;
        height: 100%;
    }
}



.steps_holder {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-top: 5rem;
    position: relative;
}

.step_card {
    width: calc(30% - 20px);
    margin-bottom: 20px;
    height: 500px;
    box-shadow: 2px 3px 20px rgba(0, 0, 0, 0.4);
    border-radius: 0.4rem;
}

@media screen and (max-width: 767px) {
    .steps_holder {
        flex-direction: column;
        align-items: stretch;
    }

    .step_card {
        width: 100%;
    }
}
</style>