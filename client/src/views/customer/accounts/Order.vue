<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <Breadcrumb :breads="['Home', 'Order']" />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <table class="table">
          <thead>
            <tr>
              <th>Mã đơn hàng</th>
              <th>Trạng thái</th>
              <th>Phương thức thanh toán</th>
              <th>Tổng tiền</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(order, index) in orders" :key="index">
              <td><a href="order-detail.html">#{{order.id}}</a></td>
              <td class="text-success font-weight-bold">{{order.status}}</td>
              <td>
                {{order.payment_method}}
              </td>
              <td>{{formatPrice(order.total)}}</td>
              <td>
                <router-link :to="{name: 'orderDetail', params: {id: order.id}}"><button class="btn btn-sm btn-info mr-2">Chi
                    tiết</button></router-link>
                <button class="btn btn-sm btn-danger" disabled>Hủy đơn hàng</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from '@/components/ui/Breadcrumb.vue';
import { orderService } from '@/services';
import { mapState } from 'vuex';
import { formatPrice } from '@/utils';
export default {
  name: 'Order',
  components: { Breadcrumb },
  computed: {
    ...mapState(['user'])
  },
  data() {
    return {
      orders: []
    };
  },
  created() {
    this.getAllOrders();
  },
  methods: {
    formatPrice,
    async getAllOrders() {
      let res = await orderService.getAllOrderByCustomerId(this.user.id);
      this.orders = res.data.orders;
      console.log(this.orders);
    }
  }
};
</script>
<style>
</style>