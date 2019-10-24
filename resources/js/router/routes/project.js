import requiredAuth from './guards/required-auth';
import List from '@/js/views/project/project/List.vue';
import Show from '@/js/views/project/project/Show.vue';
import Edit from '@/js/views/project/project/Edit.vue';
import Create from '@/js/views/project/project/Create.vue';
import OList from '@/js/views/project/obre/List.vue';
import OShow from '@/js/views/project/obre/Show.vue';
import OEdit from '@/js/views/project/obre/Edit.vue';
import OCreate from '@/js/views/project/obre/Create.vue';
import AList from '@/js/views/project/activity/List.vue';
import AShow from '@/js/views/project/activity/Show.vue';
import AEdit from '@/js/views/project/activity/Edit.vue';
import ACreate from '@/js/views/project/activity/Create.vue';

export default [
  {
    path: '/project/list',
    name: 'project.list',
    component: List,
    beforeEnter: requiredAuth,
  },
  {
    path: '/project/create',
    name: 'project.create',
    component: Create,
    beforeEnter: requiredAuth,
  },
  {
    path: '/project/show/:id',
    name: 'project.show',
    component: Show,
    beforeEnter: requiredAuth,
  },
  {
    path: '/project/edit/:id',
    name: 'project.edit',
    component: Edit,
    beforeEnter: requiredAuth,
  },
  {
    path: '/obre/list',
    name: 'obre.list',
    component: OList,
    beforeEnter: requiredAuth,
  },
  {
    path: '/obre/create',
    name: 'obre.create',
    component: OCreate,
    beforeEnter: requiredAuth,
  },
  {
    path: '/obre/show/:id',
    name: 'obre.show',
    component: OShow,
    beforeEnter: requiredAuth,
  },
  {
    path: '/obre/edit/:id',
    name: 'obre.edit',
    component: OEdit,
    beforeEnter: requiredAuth,
  },
  {
    path: '/activity/list',
    name: 'activity.list',
    component: AList,
    beforeEnter: requiredAuth,
  },
  {
    path: '/activity/create',
    name: 'activity.create',
    component: ACreate,
    beforeEnter: requiredAuth,
  },
  {
    path: '/activity/show/:id',
    name: 'activity.show',
    component: AShow,
    beforeEnter: requiredAuth,
  },
  {
    path: '/activity/edit/:id',
    name: 'activity.edit',
    component: AEdit,
    beforeEnter: requiredAuth,
  },
];
