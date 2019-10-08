import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '@/js/pages/Login';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: "/",
            name: "test",
            component: Login
        }
    ]
});

export default router;