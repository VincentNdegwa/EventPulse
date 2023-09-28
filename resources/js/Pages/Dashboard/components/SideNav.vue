<script>

export default {
    data() {
        return {
            menu: false,
        };
    },
    methods: {
        openMenu() {
            this.menu = !this.menu;
        },
        navigate(routerName) {

        },
    },
    mounted() {
        window.addEventListener("resize", (ev) => {
            if (window.innerWidth > 800) {
                this.menu = false;
            }
        });
    },
};
</script>
<template>
    <div :class="{ 'side-nav-active': menu, 'side-nav': !menu }">
        <div class="nav-logo">
            <v-avatar color="green"></v-avatar>
            <span>
                Vincent
            </span>
        </div>
        <nav class="nav-holder">
            <button @click="navigate('dashboard')" class="nav-item">
                <div class="icon">
                    <i class='bx bxs-dashboard'></i>
                </div>
                <div class="nav-text">
                    Dashboard
                </div>
            </button>
            <button @click="navigate('events')" class="nav-item">
                <div class="icon">
                    <i class='bx bx-calendar'></i>
                </div>
                <div class="nav-text">
                    Events
                </div>
            </button>
        </nav>
    </div>
    <i v-if="menu" @click="opemMenu" class='bx bx-x menu-active'></i>
    <i v-else @click="opemMenu" class='bx bx-menu-alt-left menu-active'></i>
</template>
<style>
@import url("../../../../css/app.css");
</style>