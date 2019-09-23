import requiredGuest from './guards/required-guest';
import Register from '@/js/views/auth/Register.vue';
import Login from '@/js/views/auth/Login.vue';
import Register2 from '@/js/views/auth/Register2.vue';
import Recovery from '@/js/views/auth/Recovery.vue';

export default [
  {
    path: '/auth/register',
    name: 'register',
    component: Register,
    meta: { layout: 'no-dashboard' },
    beforeEnter: requiredGuest,
  },
  {
    path: '/register',
    name: 'user.register',
    component: Register2,
    meta: { layout: 'no-dashboard' },
    beforeEnter: requiredGuest,
  },
  {
    path: '',
    name: 'login',
    component: Login,
    meta: { layout: 'no-dashboard' },
    beforeEnter: requiredGuest,
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { layout: 'no-dashboard' },
    beforeEnter: requiredGuest,
  },
  {
    path: '/recovery',
    name: 'user.recovery',
    component: Recovery,
    meta: { layout: 'no-dashboard' },
    beforeEnter: requiredGuest,
  },
];
