import { createRouter, createWebHistory } from 'vue-router';
import Instances from './views/admin/instance/index.vue';
import Users from './views/admin/user/index.vue';
import RoadOrder from './views/admin/roadOrder/index.vue';
import InstanceUsers from './views/admin/InstanceUser/index.vue';
import Orders from './views/user/order/index.vue';
import OrderDetail from './views/user/orderDetail/index.vue';
import Layout from './components/Layout.vue';
import Login from './components/Login.vue';
const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login
},
{
    path: '/',
    redirect:'orders',
    component: Layout,
    children: [
       
        {
            path: 'instances',
            name: 'Instances',
            component: Instances
        },
        {
            path: 'users',
            name: 'Users',
            component: Users
        },
        {
            path: 'order-types',
            name: 'RoadOrder',
            component: RoadOrder
        },
        {
            path: 'instance-users',
            name: 'InstanceUsers',
            component: InstanceUsers
        },
        {
            path: 'orders',
            name: 'Orders',
            component: Orders
        },
        {
            path: 'order-detail',
            name: 'OrderDetail',
            component: OrderDetail
        }
    ]
}
];

const router = createRouter({
  history: createWebHistory(import.meta.env.VITE_API_URL),
  routes
});

export default router;
