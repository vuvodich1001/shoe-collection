import Cart from '@/views/customer/Cart.vue';
import Product from '@/views/customer/Product.vue';
import Detail from '@/views/customer/Detail.vue';
import Checkout from '@/views/customer/Checkout.vue';
import Profile from '@/views/customer/Profile.vue';
import Order from '@/views/customer/Order.vue';

export default [
  {
    path: '/cart',
    name: 'cart',
    component: Cart
  },
  {
    path: '/product',
    name: 'product',
    component: Product
  },
  {
    path: '/shoe/detail/:id',
    name: 'detail',
    component: Detail
  },
  {
    path: '/checkout',
    name: 'checkout',
    component: Checkout
  },
  {
    path: '/account/profile',
    name: 'profile',
    component: Profile
  },
  {
    path: '/account/order',
    name: 'order',
    component: Order
  }
  // {
  //   path: '/discount',
  //   name: 'discount',
  //   component: Discount
  // }
];
