import requiredAuth from './guards/required-auth';
import List from '@/js/views/user/List.vue';
import Show from '@/js/views/user/Show.vue';
import Edit from '@/js/views/user/Edit.vue';
import Create from '@/js/views/user/Create.vue';

export default [
  {
    path: '/user/list',
    name: 'user.list',
    component: List,
    beforeEnter: requiredAuth,
  },
  {
    path: '/user/create',
    name: 'user.create',
    component: Create,
    beforeEnter: requiredAuth,
  },
  {
    path: '/user/show/:id',
    name: 'user.show',
    component: Show,
    beforeEnter: requiredAuth,
  },
  {
    path: '/user/edit/:id',
    name: 'user.edit',
    component: Edit,
    beforeEnter: requiredAuth,
  },
];
