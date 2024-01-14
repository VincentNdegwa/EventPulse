<script>
import Sponsor from '@/data/sponsors';
export default {
    props: {

    },
    data() {
        return {
            Sponsor
        }
    },
}
</script>
<template>
    <div class="company-card" v-for="(item, index) in  Sponsor " :key="index">
        <img :src="item.url" alt="Company 1 Logo">
        <h2>{{ item.name }}</h2>
        <div>
            <p>{{ item.description }}</p>
        </div>
        <a :href="item.website" target="_blank">Visit Website</a>
    </div>
</template>

<style>
.company-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 20px;
    width: 300px;
    height: 30rem;
    position: relative;
}



.company-card img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    margin-bottom: 10px;
}

.company-card>a {
    text-decoration: none;
    padding: 1rem;
    background: var(--main-green);
    border-radius: 0.3rem;
    color: var(--main-white);
    font-weight: bold;
    position: absolute;
    bottom: 1.5rem;
    left: 50%;
    transform: translateX(-50%);

}

.company-card>div {
    max-height: 9rem;
    overflow: hidden;
}

.company-card>div p {
    margin: 0;
    white-space: wrap;
    overflow: hidden;
    text-overflow: ellipsis;
}


.company-card:hover img {
    /* object-fit: cover; */
    height: 100%;
    width: 100%;
    transition-property: width;
}

.company-card>h2 {
    z-index: 10;
}

.company-card:hover h2 {
    position: absolute;
    top: 20%;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    transition-property: position, top, left, transform;
}

.company-card:hover p {
    position: absolute;
    top: 20%;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    transition-property: position, top, left, transform, opacity;
    opacity: 0;
}

.company-card:hover div>p {
    opacity: 0;
    z-index: -10;
    transition-property: opacity, z-index;
}

.company-card:hover {
    background-color: var(--main-green);
    padding: 40px;
    transition-property: background-color, padding;
}

.company-card:hover a {
    bottom: 2.5rem;
    background-color: var(--main-orange);
    transition-property: bottom, background-color;
}




.company-card>img,
h2,
div>p,
a,
.company-card {
    transition-duration: 1.5s;
    transition-timing-function: ease-in-out;
}
</style>