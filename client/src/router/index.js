import { createRouter, createWebHistory } from 'vue-router';
import store from '../store';
import routesAdmin from './admin.js';
import routesDefault from './default.js';

const routes = [
  {
    path: '/',
    name: 'home',
    component: () => import('@/views/customer/Home.vue'),
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/home',
    redirect: { name: 'home' }
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/components/ui/Login.vue'),
    meta: {
      requiresAuth: false
    }
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('@/components/ui/Register.vue'),
    meta: {
      requiresAuth: false
    }
  },
  ...routesAdmin,
  ...routesDefault
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  scrollBehavior() {
    return {
      top: 0
    };
  }
});

router.beforeEach((to, from, next) => {
  const user = localStorage.getItem('token');
  if (to.meta.requiresAuth) {
    if (user) {
      next();
    } else {
      next({ name: 'login', params: {} });
    }
  } else if (to.name == 'login' && store.state.user) {
    next({ name: 'home', params: {} });
  } else {
    next();
  }
});

export default router;
