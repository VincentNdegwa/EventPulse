<script>
export default {
    data() {
        return {
            menu: false
        }
    },
    methods: {
        toggleNav() {
            this.menu = !this.menu
        },
        removeMenu() {
            this.menu = false
        },
        naviagteToLogin() {
            window.location.href = "/login"
        }
    }, mounted() {
        window.addEventListener("resize", (ev) => {
            console.log(window.innerWidth)
            if (window.innerWidth > 800) {
                this.menu = false
            }
        })
    }
}

</script>

<template>
    <header>
        <div>
            <h4 class="logo-text">
                EventPulse
            </h4>
        </div>

        <nav :class="{ 'nav_right_active': menu, 'nav_right': !menu }">
            <div>
                <button @click="removeMenu">
                    <a href="#home">
                        Home
                    </a>
                </button>
                <button @click="removeMenu">
                    <a href="#events">
                        Events
                    </a>
                </button>
                <button @click="removeMenu">
                    <a href="#Support">
                        Support
                    </a>
                </button>
                <button @click="removeMenu">
                    <a href="#">
                        Home
                    </a>
                </button>
                <button @click="removeMenu">
                    <a href="#">
                        Home
                    </a>

                </button>
            </div>
            <button @click="naviagteToLogin">
                Login/Register
            </button>
        </nav>
        <i v-if="menu" @click="toggleNav" class='bx bx-x'></i>
        <i v-else @click="toggleNav" class='bx bx-menu-alt-right'></i>

    </header>
</template>
<!-- nav_right_active -->