import Cart from '@/views/customer/Cart.vue';
import Product from '@/views/customer/Product.vue';
import Detail from '@/views/customer/Detail.vue';
import Checkout from '@/views/customer/Checkout.vue';
import Profile from '@/views/customer/accounts/Profile.vue';
import Order from '@/views/customer/accounts/Order.vue';
import OrderDetail from '@/views/customer/accounts/OrderDetail.vue';
import Review from '@/views/customer/accounts/Review.vue';

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
    component: Checkout,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/account/profile',
    name: 'profile',
    component: Profile,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/account/order',
    name: 'order',
    component: Order,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/account/order-detail/:id',
    name: 'orderDetail',
    component: OrderDetail,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/account/review/:id',
    name: 'review',
    component: Review,
    meta: {
      requiresAuth: true
    }
  }
  // {
  //   path: '/discount',
  //   name: 'discount',
  //   component: Discount
  // }
];
