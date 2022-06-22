<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <Breadcrumb :breads="['Home', 'Order', 'OrderDetail']" />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h4 class="my-3">Chi tiết đơn hàng - #{{id}}</h4>
        <div class="row">
          <div class="col-lg-4">
            <div class="p-2 border border-info rounded bg-light">
              <h5>Người nhận</h5>
              <p class="my-2">{{`${address.name}`}}</p>
              <p class="my-2">Địa chỉ: {{`${address.line1}, ${address.line2}, ${address.city}`}}</p>
              <p class="my-2">Số Điện thoại: {{address.phone}}</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="p-2 border border-info rounded bg-light h-100">
              <h5>Phức thức thanh toán</h5>
              <p>Thanh toán tiền mặt khi nhận hàng</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="p-2 border border-info rounded bg-light h-100">
              <h5>Trạng thái giao hàng</h5>
              <p class="text-success font-weight-bold">{{orderDetails.status}}</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <h4 class="my-3">Sản phẩm đã mua</h4>
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Tên sản phẩm</th>
                  <th>Hình ảnh</th>
                  <th>Số lượng</th>
                  <th>Tổng</th>
                </tr>
              </thead>
              <tbody>
                <!-- product -->
                <tr v-for="(shoe, index) in orderDetails.shoes" :key="index">
                  <td>{{index+1}}</td>
                  <td>
                    <router-link class="d-block" :to="{name: 'detail', params: {id: shoe.id}}">{{shoe.name}}</router-link>
                    <router-link :to="{name: 'review', params: {id: shoe.id}}"><button class="btn btn-sm btn-outline-success">Viết đánh giá</button></router-link>
                  </td>
                  <td><img :src="shoe.image.image" alt="" class="rounded" style="width: 110px; object-fit: cover;"></td>
                  <td>{{shoe.quantity}}</td>
                  <td>{{formatPrice(shoe.subtotal)}}</td>
                </tr>

                <!-- fee-->
                <tr>
                  <td colspan="3"></td>
                  <td>Phí giao hàng</td>
                  <td>{{formatPrice(orderDetails.shipping_fee)}}</td>
                </tr>
                <tr>
                  <td colspan="3"></td>
                  <td>Giảm giá</td>
                  <td>{{formatPrice(orderDetails.discount)}}</td>
                </tr>
                <tr>
                  <td colspan="3"></td>
                  <td>Tổng cộng</td>
                  <td>
                    <h5 class="text-danger">{{formatPrice(orderDetails.total)}}</h5>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { orderService } from '@/services';
import { formatPrice } from '@/utils';
import Breadcrumb from '@/components/ui/Breadcrumb.vue';

export default {
  name: 'OrderDetail',
  components: { Breadcrumb },
  data() {
    return {
      orderDetails: {
        total: 0,
        subtotal: 0,
        discount: 0,
        shipping_fee: 0
      },
      address: {}
    };
  },
  computed: {
    id() {
      return this.$route.params.id;
    }
  },
  created() {
    this.getOrderDetailByOrderId(this.id);
  },
  methods: {
    formatPrice,
    async getOrderDetailByOrderId(id) {
      let res = await orderService.getOrderDetailByOrderId(id);
      this.orderDetails = res.data.orderDetails;
      this.address = res.data.orderDetails.address;
    }
  }
};
</script>

<style>
.table th,
.table td {
  vertical-align: middle;
}
</style>