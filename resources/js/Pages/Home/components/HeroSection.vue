<template>
    <div class="hero_section" id="home">
        <div class="hero_content">
            <h1 class="hero_title">Crafting Unforgettable Moments</h1>
            <p class="hero_subtitle">Every Detail, Every Event, Every Time</p>
            <div class="button-holder">
                <a href="#">
                    <button class="create_event_btn">Create Your Event <i class='bx bxs-plus-square'></i></button>
                </a>
                <a href="#">
                    <button class="find_event_btn">Find Events <i class='bx bx-search-alt'></i></button>
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>
.hero_section {
    position: relative;
    height: 100vh;
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: linear-gradient(135deg,
            rgba(20, 50, 100, 0.1),
            rgba(256, 96, 0, 0.4)), url("images/bg.jpg");

}

.hero_content {
    text-align: center;
    color: var(--main-white);
    padding: 0 20px;
}

.hero_title {
    font-size: 3rem;
    margin-bottom: 10px;
    letter-spacing: 2px;
}

.hero_subtitle {
    font-size: 1.5rem;
    margin-bottom: 30px;
}

.button-holder {
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 5;
}


.create_event_btn,
.find_event_btn {
    display: flex;
    align-items: center;
    gap: 1rem;

    &>i {
        font-size: 1.6rem;
        color: var(--main-orange);
    }
}

.button-holder>a {
    background-color: var(--main-blue);
    color: #fff;
    border: none;
    padding: 15px 25px;
    margin: 0 10px;
    font-size: 1.2rem;
    font-weight: bold;
    text-transform: uppercase;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}

.button-holder>a:hover {
    background-color: var(--main-white);
    color: var(--main-blue);
    transition: all 1s ease;
}
</style>
