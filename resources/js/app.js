import { createApp } from 'vue'
import App from './layouts/App.vue'

import router from './router'

import VueApexCharts from "vue3-apexcharts";
import Vue3EasyDataTable from 'vue3-easy-data-table';
import VueTippy from 'vue-tippy'

// CSS
import 'vue3-toastify/dist/index.css';
import 'vue3-easy-data-table/dist/style.css';
import "tippy.js/dist/tippy.css";


createApp(App)
    .use(router)
    .use(VueApexCharts)
    .use(VueTippy)
    .component('EasyDataTable', Vue3EasyDataTable)
    .mount('#app')