import Cart from '@/views/customer/Cart.vue';
import Product from '@/views/customer/Product.vue';
import Detail from '@/views/customer/Detail.vue';
import Checkout from '@/views/customer/Checkout.vue';

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
  }
  // {
  //   path: '/discount',
  //   name: 'discount',
  //   component: Discount
  // }
];
