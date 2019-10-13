import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '@/js/pages/Login';
import Orders from  '@/js/pages/Orders';
import CreateOrder from  '@/js/pages/CreateOrder';
import EditOrder from '@/js/pages/EditOrder';

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
        },
        {
            path: "/orders/create",
            name: "create-order",
            component: CreateOrder
        },
        {
            path: "/orders/:id/edit",
            name: "edit-order",
            component: EditOrder
        }
    ]
});

export default router;