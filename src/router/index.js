import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'auth.login',
        component: () => import("../views/auth/login.vue")
    },
    {
        path: '/register',
        name: 'auth.register',
        component: () => import("../views/auth/register.vue")
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;