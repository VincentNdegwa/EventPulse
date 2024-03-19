<script>
import { register } from 'swiper/element/bundle';
register()
export default {
    data() {
        return {
            items: [1, 2, 3, 4]
        }
    }
}
</script>
<template>
    <div class="testimonial_container mt-10 p-4">
        <h2 class="section-title text-center">Customer sentiments</h2>
        <div class="testimonials_holder">

            <div class="test_item_holder" v-for="(item, index) in items" :key="index">

                <div class="testimonial_item">
                    <img class="image_test" src="images/avatar.jpg" alt="test-image" />
                    <div class="test_details">
                        <div class="test_quo">
                            <div></div>
                            <div></div>

                        </div>
                        <div class="text_testimony">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolores
                            molestiae, recusandae voluptas aut ipsa dignissimos earum eveniet doloremque, velit beatae
                            perspiciatis harum quo suscipit. Placeat veniam distinctio id delectus doloribus!</div>
                        <p class="name_testimony">Elana Mosco</p>
                        <small>Head of Commmunity @Coldman</small>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>
<style>
.testimonial_container {
    background: var(--main-blue);
    height: auto;
    color: var(--main-white);
}

.test_quo {
    display: flex;
    gap: 5px;
}

.test_quo>div {
    position: relative;
    width: 30px;
    background-image: linear-gradient(to top, var(--main-white), var(--main-orange));
    height: 30px;
    overflow: hidden;
    border: 0 !important;
}

.test_quo>div::before {
    background: var(--main-blue);
    position: absolute;
    top: 20%;
    left: 0;
    width: 200%;
    height: 100%;
    content: "";
    transform: rotate(-45deg);
}


.testimonials_holder {
    height: auto;
    display: flex;
    gap: 2rem;
    overflow-x: scroll;
    padding-bottom: 30px;

    &::-webkit-scrollbar {
        width: 10px;
        /* Set the width of the scrollbar */
        height: 10px;
        /* Set the height of the scrollbar */
    }

    &::-webkit-scrollbar-thumb {
        background: var(--main-orange);
        /* Set the color of the thumb (the draggable handle) */
        border-radius: 5px;
        /* Set the border radius of the thumb */
    }

    &::-webkit-scrollbar-track {
        background: var(--main-white);
        /* Set the color of the track (the area behind the thumb) */
    }

}



.testimonial_item {
    position: relative;

    &>img {
        position: absolute;
        width: 100px;
        height: 100px;
        border-bottom-left-radius: 50%;
        top: 0;
        right: 0;
    }

}

.test_item_holder {
    --holder-height: 450px;
    --holder-width: 450px;
    padding: 2rem;
    height: var(--holder-height);
    width: var(--holder-width);
    min-width: var(--holder-width);
    border: 1px solid var(--main-green);
    box-shadow: 2px 3px 30px var(--main-green);
    border-radius: 1rem;
}

.test_details {
    padding-top: calc(100px - 30px);
    height: calc(var(--holder-height) - 4rem);

}

.text_testimony {
    margin-top: 20px !important;
    min-height: fit-content;
    height: auto;
    max-height: 230px;
    overflow-y: scroll;
    text-wrap: wrap;
    font-weight: bold;
}

.text_testimony::-webkit-scrollbar {
    display: none;
}

p {
    margin: 0;
}

.name_testimony {
    margin-top: 10px;
    color: var(--main-green);
}

small {
    color: gray;
}


@media screen and (max-width: 550px) {
    .test_item_holder {
        --holder-height: 450px;
        --holder-width: 100%;
        width: 100%;
    }
}
</style>