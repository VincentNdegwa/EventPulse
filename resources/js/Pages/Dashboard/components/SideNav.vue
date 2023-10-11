<script>
import { router } from "@inertiajs/vue3"

export default {
    data() {
        return {
            menu: false,
            userData: {}
        };
    },
    methods: {
        openMenu() {
            this.menu = !this.menu;
        },
        navigate(routerName) {
            router.visit(route(routerName))
        },
    },
    mounted() {
        window.addEventListener("resize", (ev) => {
            if (window.innerWidth > 800) {
                this.menu = false;
            }
        });

        let user = localStorage.getItem("user")
        if (user) {
            let userData = JSON.parse(user)
            this.userData = userData
            // console.log(this.userData)
        } else {
            console.log("no data")
        }
    },
};
</script>
<template>
    <div :class="{ 'side-nav-active': menu, 'side-nav': !menu }">
        <div class="nav-logo">
            <v-avatar v-if="userData?.profile?.profile_image" :image="userData?.profile?.profile_image"></v-avatar>
            <v-avatar v-else image="images/avatar.jpg"></v-avatar>

            <span>
                {{ userData.username }}
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
            <button @click="navigate('my-events')" class="nav-item">
                <div class="icon">
                    <i class='bx bxs-calendar-heart'></i>
                </div>
                <div class="nav-text">
                    My Events
                </div>
            </button>
            <button @click="navigate('tickets')" class="nav-item">
                <div class="icon">
                    <i class='bx bx-receipt'></i>
                </div>
                <div class="nav-text">
                    Tickets
                </div>
            </button>
            <button @click="navigate('create_event')" class="nav-item">
                <div class="icon">
                    <i class='bx bx-add-to-queue'></i>
                </div>
                <div class="nav-text">
                    Create
                </div>
            </button>
            <!-- <i class='bx bxs-user-detail'></i> -->
            <button @click="navigate('approvals')" class="nav-item">
                <div class="icon">
                    <i class='bx bxs-hourglass'></i>
                </div>
                <div class="nav-text">
                    Approvals
                </div>
            </button>
            <button @click="navigate('profile')" class="nav-item">
                <div class="icon">
                    <i class='bx bxs-user-detail'></i>
                </div>
                <div class="nav-text">
                    Profile
                </div>
            </button>
            <button @click="navigate('logout')" class="nav-item">
                <div class="icon">
                    <i class='bx bxs-exit'></i>
                </div>
                <div class="nav-text">
                    Logout
                </div>
            </button>
        </nav>
    </div>
    <i v-if="menu" @click="openMenu" class='bx bx-x menu-active'></i>
    <i v-else @click="openMenu" class='bx bx-menu-alt-left menu-active'></i>
</template>
<style>
@import url("../../../../css/app.css");
</style>
<!-- approvals -->