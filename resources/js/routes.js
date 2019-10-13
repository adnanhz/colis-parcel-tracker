import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '@/js/pages/Login';
import Orders from  '@/js/pages/Orders';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/orders",
            name: "orders",
            component: Orders
        }
    ]
});

export default router;