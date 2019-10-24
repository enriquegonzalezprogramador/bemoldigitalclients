import requiredAuth from './guards/required-auth';
import WList from '@/js/views/warehouse/warehouse/List.vue';
import WCreate from '@/js/views/warehouse/warehouse/Create.vue';
import WShow from '@/js/views/warehouse/warehouse/Show.vue';
import WEdit from '@/js/views/warehouse/warehouse/Edit.vue';
import IList from '@/js/views/warehouse/inventary/List.vue';
import ICreate from '@/js/views/warehouse/inventary/Create.vue';
import IShow from '@/js/views/warehouse/inventary/Show.vue';
import IEdit from '@/js/views/warehouse/inventary/Edit.vue';
import INList from '@/js/views/warehouse/inputmaterial/List.vue';
import INCreate from '@/js/views/warehouse/inputmaterial/Create.vue';
import INShow from '@/js/views/warehouse/inputmaterial/Show.vue';
import INEdit from '@/js/views/warehouse/inputmaterial/Edit.vue';
import OUList from '@/js/views/warehouse/outputmaterial/List.vue';
import OUCreate from '@/js/views/warehouse/outputmaterial/Create.vue';
import OUShow from '@/js/views/warehouse/outputmaterial/Show.vue';
import OUEdit from '@/js/views/warehouse/outputmaterial/Edit.vue';
import RQList from '@/js/views/warehouse/requirementmaterial/List.vue';
import RQCreate from '@/js/views/warehouse/requirementmaterial/Create.vue';
import RQShow from '@/js/views/warehouse/requirementmaterial/Show.vue';
import RQEdit from '@/js/views/warehouse/requirementmaterial/Edit.vue';
import TList from '@/js/views/warehouse/tool/List.vue';
import TCreate from '@/js/views/warehouse/tool/Create.vue';
import TShow from '@/js/views/warehouse/tool/Show.vue';
import TEdit from '@/js/views/warehouse/tool/Edit.vue';

export default [
  {
    path: '/warehouse/list',
    name: 'warehouse.list',
    component: WList,
    beforeEnter: requiredAuth,
  },
  {
    path: '/warehouse/create',
    name: 'warehouse.create',
    component: WCreate,
    beforeEnter: requiredAuth,
  },
  {
    path: '/warehouse/show/:id',
    name: 'warehouse.show',
    component: WShow,
    beforeEnter: requiredAuth,
  },
  {
    path: '/warehouse/edit/:id',
    name: 'warehouse.edit',
    component: WEdit,
    beforeEnter: requiredAuth,
  },
  {
    path: '/inventary/list',
    name: 'inventary.list',
    component: IList,
    beforeEnter: requiredAuth,
  },
  {
    path: '/inventary/create',
    name: 'inventary.create',
    component: ICreate,
    beforeEnter: requiredAuth,
  },
  {
    path: '/inventary/show/:id',
    name: 'inventary.show',
    component: IShow,
    beforeEnter: requiredAuth,
  },
  {
    path: '/inventary/edit/:id',
    name: 'inventary.edit',
    component: IEdit,
    beforeEnter: requiredAuth,
  },
  {
    path: '/inputmaterial/list',
    name: 'inputmaterial.list',
    component: INList,
    beforeEnter: requiredAuth,
  },
  {
    path: '/inputmaterial/create',
    name: 'inputmaterial.create',
    component: INCreate,
    beforeEnter: requiredAuth,
  },
  {
    path: '/inputmaterial/show/:id',
    name: 'inputmaterial.show',
    component: INShow,
    beforeEnter: requiredAuth,
  },
  {
    path: '/inputmaterial/edit/:id',
    name: 'inputmaterial.edit',
    component: INEdit,
    beforeEnter: requiredAuth,
  },
  {
    path: '/outputmaterial/list',
    name: 'outputmaterial.list',
    component: OUList,
    beforeEnter: requiredAuth,
  },
  {
    path: '/outputmaterial/create',
    name: 'outputmaterial.create',
    component: OUCreate,
    beforeEnter: requiredAuth,
  },
  {
    path: '/outputmaterial/show/:id',
    name: 'outputmaterial.show',
    component: OUShow,
    beforeEnter: requiredAuth,
  },
  {
    path: '/outputmaterial/edit/:id',
    name: 'outputmaterial.edit',
    component: OUEdit,
    beforeEnter: requiredAuth,
  },
  {
    path: '/requirementmaterial/list',
    name: 'requirementmaterial.list',
    component: RQList,
    beforeEnter: requiredAuth,
  },
  {
    path: '/requirementmaterial/create',
    name: 'requirementmaterial.create',
    component: RQCreate,
    beforeEnter: requiredAuth,
  },
  {
    path: '/requirementmaterial/show/:id',
    name: 'requirementmaterial.show',
    component: RQShow,
    beforeEnter: requiredAuth,
  },
  {
    path: '/requirementmaterial/edit/:id',
    name: 'requirementmaterial.edit',
    component: RQEdit,
    beforeEnter: requiredAuth,
  },
  {
    path: '/tool/list',
    name: 'tool.list',
    component: TList,
    beforeEnter: requiredAuth,
  },
  {
    path: '/tool/create',
    name: 'tool.create',
    component: TCreate,
    beforeEnter: requiredAuth,
  },
  {
    path: '/tool/show/:id',
    name: 'tool.show',
    component: TShow,
    beforeEnter: requiredAuth,
  },
  {
    path: '/tool/edit/:id',
    name: 'tool.edit',
    component: TEdit,
    beforeEnter: requiredAuth,
  },
];
