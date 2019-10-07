import Vue from 'vue';
import VueRouter from 'vue-router';
import TestPage from '@/js/pages/TestPage';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: "/",
            name: "test",
            component: TestPage
        }
    ]
});

export default router;