import { createInertiaApp } from '@inertiajs/vue3';
import './bootstrap';
// import "../css/custom-boostrap.scss"
import "../../css/custom-boostrap.min.css"
import { createApp, h } from 'vue';
import { createVuetify } from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import 'vuetify/styles';

import * as VuetifyComponents from 'vuetify/components';
import * as VuetifyDirectives from 'vuetify/directives';
import axios from 'axios';

import VueSweetalert2 from 'vue-sweetalert2';
import "sweetalert2/dist/sweetalert2.min.css"
axios.defaults.withCredentials = true
const vuetify = createVuetify({
    components: VuetifyComponents,
    directives: VuetifyDirectives,
});

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(VueSweetalert2)
            .mount(el);
    }
});
