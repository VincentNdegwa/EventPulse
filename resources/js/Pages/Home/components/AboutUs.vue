<template>
    <div class="about_container p-4">
        <div class="background">
            <img src="images/background3D.jpg" alt="background">
        </div>
        <div class="about_holder">

            <h3 class="text-center fs-1">Who Are We?</h3>
            <p class="mb-2 text-center">We are Joy Bringers, we believe that every event has the potential to be
                extraordinary. As a leading
                provider of event management solutions, we are dedicated to empowering individuals and organizations to
                create memorable and impactful experiences that bring communities together. With our user-friendly
                platform,
                you can effortlessly plan, promote, and manage events of all sizes, from intimate gatherings to
                large-scale
                conferences and festivals.
            </p>
            <div class="details_container mt-10">


                <div class="details_item">
                    <div class="line">
                        <span>
                            <i class='bx bx-wifi-0'></i>
                        </span>
                        <p>

                        </p>
                    </div>
                    <div class="content">
                        <div class="fs-4 text-center">Our Mission</div>
                        <div class="more_content_container">
                            <div class="fs-6 content_text">
                                Our mission is to democratize event planning by providing accessible tools and resources
                                that enable anyone to bring their vision to life. We strive to simplify the event
                                management
                                process, streamline communication between organizers and attendees, and foster
                                meaningful
                                connections that leave a lasting impression.
                            </div>
                            <div class="illustator_holder">
                                <img src="images/mission.png" alt="mission">
                            </div>
                        </div>
                    </div>
                </div>


                <!-- end -->

                <div class="details_item opp">

                    <div class="content">
                        <div class="fs-4 text-center">Our Vision</div>
                        <div class="more_content_container">
                            <div class="fs-6 content_text">
                                Our vision is to be the premier destination for event creators and attendees alike,
                                offering
                                a seamless and immersive experience that transcends traditional event planning
                                boundaries.
                                We envision a world where events are not just occasions but transformative experiences
                                that
                                inspire, educate, and entertain.
                            </div>
                            <div class="illustator_holder">
                                <img src="images/vision.png" alt="mission">
                            </div>
                        </div>
                    </div>

                    <div class="line">
                        <span>
                            <i class='bx bx-wifi-0'></i>
                        </span>
                        <p>

                        </p>
                    </div>
                </div>


                <!-- end -->

                <div class="details_item">
                    <div class="line">
                        <span>
                            <i class='bx bx-wifi-0'></i>
                        </span>
                        <p>

                        </p>
                    </div>
                    <div class="content">
                        <div class="fs-4 text-center">Goals</div>
                        <div class="more_content_container">
                            <div class="fs-6 content_text">
                                <ul>
                                    <li>Empowerment: Provide event organizers with tools and support for successful
                                        planning.</li>
                                    <li>Accessibility: Make event planning intuitive and affordable for all.</li>
                                    <li>Community Building: Foster an inclusive community for idea sharing and
                                        collaboration.</li>
                                    <li>Innovation: Drive industry innovation with technology and creative solutions.
                                    </li>
                                    <li>Impact: Create events that promote diversity, sustainability, and social
                                        responsibility.</li>
                                </ul>
                            </div>
                            <div class="illustator_holder">
                                <img src="images/goal.png" alt="mission">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- end -->
        </div>
    </div>
</template>
<style>
.about_container {
    position: relative;

}

.about_holder {
    z-index: 1;
    position: relative;
}

.background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;

    &>img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        object-position: center;
    }
}

.details_container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.details_item {
    display: grid;
    grid-template-columns: 1fr 10fr;
    height: auto;
    width: 100%;
    max-width: 900px;
}

.opp {
    display: grid;
    grid-template-columns: 10fr 1fr;
    height: auto;
    width: 100%;
    max-width: 900px;
}

.line {
    position: relative;
    /* background: var(--main-blue); */

    & span {
        position: absolute;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 5rem;
        margin: 0;
        color: var(--main-orange);
    }

    & p {
        position: absolute;
        height: 100%;
        width: 1px;
        background: var(--main-orange);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
}

.content {
    background: var(--main-white);
    box-shadow: 2px 3px 12px rgba(0, 0, 0, 0.4);
    padding: 1rem;
}

.more_content_container {
    display: grid;
    grid-template-columns: 2fr 1fr;
}

.content_text {
    align-self: center;
}

.illustator_holder,
.illustator_holder>img {
    width: 100%;
    height: 100%;
}
</style>