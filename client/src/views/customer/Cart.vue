<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <Breadcrumb :breads="['Home', 'Cart']" />
      </div>
    </div>
    <div class="row">
      <div :class="[cart.length > 0 ? 'col-lg-9' : 'col-lg-12']">
        <table class="table" v-if="cart.length > 0">
          <thead>
            <tr>
              <th>#</th>
              <th>Tên sản phẩm</th>
              <th>Hình ảnh</th>
              <th>Số lượng</th>
              <th>Giá tiền</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(c, index) in cart" :key="index">
              <th>{{c.shoe.id}}</th>
              <td class="text-truncate" style="width: 200px;">{{c.shoe.name}}
                <div>
                  <span class="badge badge-info">{{c.color}}</span>
                  <span class="d-inline-block ml-2 badge badge-warning">{{c.size}}</span>
                </div>
              </td>
              <td><img src="@/assets/images/air-force-1.jpg" alt="" class="rounded d-inline" style="height: 110px; width: 110px; object-fit: cover;"></td>
              <td>
                <button class="btn btn-sm btn-outline-secondary" @click="changeQuantity({id: c.shoe.id, type: 'decrease'})"><i class=" fas fa-minus"></i></button>
                <span class="h5 d-inline-block p-2">{{c.quantity}}</span>
                <button class="btn btn-sm btn-outline-secondary" @click="changeQuantity({id: c.shoe.id, type: 'increase'})"><i class="fas fa-plus"></i></button>
              </td>
              <td>{{formatPrice(c.shoe.price)}}</td>
              <td><i class="far fa-trash-alt" @click="removeCartItem(c.shoe.id)" style="cursor: pointer"></i></td>
            </tr>
          </tbody>
        </table>
        <div class="text-center w-100" v-else>
          <router-link to="/product"><i class="display-1 cart-blank fa-solid fa-cart-shopping"></i></router-link>
        </div>
        <router-link to="/checkout" v-if="cart.length > 0">
          <button class="btn btn-outline-secondary float-right">Thanh toán</button>
        </router-link>
      </div>

      <div class="col-lg-3" v-if="cart.length > 0">
        <p class="mb-1">Mã Giảm Giá</p>
        <form class="form-inline border-bottom pb-2">
          <div class="form-group mr-sm-3 mr-2 mb-2">
            <label for="voucher" class="sr-only">Password</label>
            <input type="text" class="form-control" id="voucher" placeholder="Enter coupon">
          </div>
          <button type="submit" class="btn btn-secondary btn-sm mb-2">Áp dụng</button>
        </form>

        <div class="d-flex flex-column border-bottom">
          <div class="d-flex justify-content-between py-2">
            <span>Tạm tính</span>
            <span>{{formatPrice(total)}}</span>
          </div>
          <div class="d-flex justify-content-between py-2">
            <span>Giảm giá</span>
            <span>0 đ</span>
          </div>
        </div>

        <div class="d-flex justify-content-between py-2">
          <span>Tổng cộng</span>
          <h5 class="m-0 text-danger">{{formatPrice(total)}}</h5>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from '@/components/ui/Breadcrumb.vue';
import { mapGetters, mapState } from 'vuex';
import { formatPrice } from '@/utils';
export default {
  name: 'Cart',
  components: { Breadcrumb },
  computed: {
    ...mapState(['cart']),
    ...mapGetters(['total'])
  },
  methods: {
    formatPrice,
    removeCartItem(id) {
      this.$store.dispatch('removeCartItem', id);
    },
    changeQuantity(payload) {
      console.log(payload);
      this.$store.dispatch('changeQuantity', payload);
    }
  }
};
</script>

<style lang="scss" scoped>
table,
th,
td {
  vertical-align: middle;
  text-align: center;
}

.cart-blank {
  color: rgba($color: #000000, $alpha: 0.1);
  &::before {
    font-size: 150px;
  }
}
</style>