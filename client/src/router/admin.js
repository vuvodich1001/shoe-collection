import Shoe from '@/views/admin/shoes/Index.vue';
import ShoeList from '@/views/admin/shoes/List.vue';
import ShoeForm from '@/views/admin/shoes/Form.vue';
import UserList from '@/views/admin/users/List.vue';
import UserForm from '@/views/admin/users/Form.vue';
import User from '@/views/admin/users/Index.vue';

export default [
  {
    path: '/admin',
    name: 'admin',
    component: () => import('@/views/admin/Home.vue'),
    meta: {
      layout: 'Admin'
      // requiresAuth: true
    }
  },
  {
    path: '/admin/shoe',
    name: 'shoe',
    component: Shoe,
    children: [
      {
        path: '',
        name: 'shoe.index',
        component: ShoeList
      },
      {
        path: 'create',
        name: 'shoe.create',
        component: ShoeForm
      },
      {
        path: 'edit/:id',
        name: 'shoe.edit',
        component: ShoeForm
      }
    ],
    meta: {
      layout: 'Admin'
    }
  },
  {
    path: '/admin/user',
    name: 'user',
    component: User,
    children: [
      {
        path: '',
        name: 'user.index',
        component: UserList
      },
      {
        path: 'create',
        name: 'user.create',
        component: UserForm
      },
      {
        path: 'edit/:id',
        name: 'user.edit',
        component: UserForm
      }
    ],
    meta: {
      layout: 'Admin'
    }
  }
];
