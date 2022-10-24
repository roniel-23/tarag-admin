import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createPinia } from 'pinia';
import { Bundle } from 'magic-string';

const imageURL = import.meta.env.VITE_IMAGE_URL;

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app: inertiaApp, props, plugin }) {

        const app = createApp({ render: () => h(inertiaApp, props) })
            .use(pinia)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            

        app.config.globalProperties.$imageURL = imageURL;
        app.mount(el);
        return app;
    },
    title: title => "Tara G! - " + title
});

// createInertiaApp({
//     title: (title) => `${title} - ${appName}`,
//     resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
//     setup({ el, app, props, plugin }) {
//         return createApp({ render: () => h(app, props) })
//             .use(pinia)
//             .use(plugin)
//             .use(ZiggyVue, Ziggy)
//             .mount(el);
//     },
//     title: title => "Tara G! - " + title
// });

InertiaProgress.init({ 
    color: 'orange',
    showSpinner: true
 });
