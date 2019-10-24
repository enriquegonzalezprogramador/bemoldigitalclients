import requiredAuth from './guards/required-auth';
import List from '@/js/views/employee/employee/List.vue';
import Create from '@/js/views/employee/employee/Create.vue';
import Show from '@/js/views/employee/employee/Show.vue';
import Edit from '@/js/views/employee/employee/Edit.vue';

export default [
  {
    path: '/employee/list',
    name: 'employee.list',
    component: List,
    beforeEnter: requiredAuth,
  },
  {
    path: '/employee/create',
    name: 'employee.create',
    component: Create,
    beforeEnter: requiredAuth,
  },
  {
    path: '/employee/show/:id',
    name: 'employee.show',
    component: Show,
    beforeEnter: requiredAuth,
  },
  {
    path: '/employee/edit/:id',
    name: 'employee.edit',
    component: Edit,
    beforeEnter: requiredAuth,
  },
];
