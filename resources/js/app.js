/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
import './bootstrap';
import Vue from 'vue';
import Routes from '@/js/routes.js';
import App from '@/js/App.vue';
import store from './stores/index.js'
import VueResource from 'vue-resource'

Vue.use(VueResource);
const app = new Vue({
    el: '#app',
    router: Routes,
    store,
    render: h => h(App)
});

console.log(process);   
export default app;