<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <Breadcrumb :breads="['Home', 'Cart', 'Checkout']" />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <h4>Địa chỉ vận chuyển</h4>
        <label class="address-group" for="address-1">
          <input type="radio" name="address" value="address-1" id="address-1" v-model="address">
          <span class="d-inline-block ml-2">Vu Nguyen, 0967979521 - 7/56/2, đường số 6, phường long trường, quận 9, HCMC</span>
        </label>
        <label class="address-group" for="address-2">
          <input type="radio" name="address" value="address-2" id="address-2" v-model="address">
          <span class="d-inline-block ml-2">Vu Nguyen, 0967979521 - 7/56/2, đường số 6, phường long trường, quận 9, HCMC</span>
        </label>
        <label class="address-group" for="address-new">
          <div class="d-flex align-items-center">
            <input type="radio" name="address" value="address-new" id="address-new" v-model="address">
            <div class="d-flex justify-content-between align-items-center ml-2" style="flex:1">Thêm địa chỉ mới
              <i class="fa-solid fa-chevron-left" :class="{'d-none': checkNewAddress}"></i>
              <i class="fa-solid fa-chevron-down" :class="{'d-none': !checkNewAddress}"></i>
            </div>
          </div>
          <form class="mt-2 form-address" :class="{'form-active': checkNewAddress}" method="">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="first-name">FirstName</label>
                <input type="text" class="form-control" id="first-name" placeholder="Nguyen">
              </div>
              <div class="form-group col-md-6">
                <label for="last-name">LastName</label>
                <input type="text" class="form-control" id="last-name" placeholder="Vu">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-8">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="vunguyen@gmail.com">
              </div>
              <div class="form-group col-md-4">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="0912345678">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="TPHCM">
              </div>
              <div class="form-group col-md-4">
                <label for="district">District</label>
                <input type="district" class="form-control" id="district" placeholder="Quan 9">
              </div>
              <div class="form-group col-md-4">
                <label for="ward">Ward</label>
                <input type="ward" class="form-control" id="ward" placeholder="Long truong">
              </div>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" placeholder="5/57, duong so 8">
            </div>

            <button class="btn d-none">Submit</button>
          </form>
        </label>

        <h4>Phương thức thanh toán</h4>
        <ul class="list-group">
          <li class="rounded list-group-item d-inline-block"><input type="radio" name="payment" id="payment-1">
            <label for="payment-1" class="d-inline-block mb-0 ml-2">Thanh toán khi nhận hàng</label>
          </li>
          <li class="mt-2 border rounded list-group-item"><input type="radio" name="payment" id="payment-2">
            <label for="payment-2" class="d-inline-block mb-0 ml-2">Thanh toán qua Paypal</label>
          </li>
        </ul>

        <button type="submit" class="btn btn-secondary my-3">Mua hàng</button>
      </div>
      <div class="col-lg-4">
        <div class="cart-detail px-3">
          <ul class="border-bottom pb-2">
            <li class="d-flex align-items-center mt-3 justify-content-between" v-for="c in cart" :key="c.shoe.id">
              <img src="@/assets/images/air-force-1.jpg" alt="" class="rounded" style="height: 90px; width: 90px; object-fit: cover;">
              <span class="d-inline-block mx-2">{{c.shoe.name}}</span>
              <span>{{formatPrice(c.shoe.price)}} x {{c.quantity}}</span>
            </li>
          </ul>

          <form class="form-inline border-bottom pb-2">
            <div class="form-group mr-sm-3 mr-2 mb-2">
              <label for="voucher" class="sr-only">Password</label>
              <input type="text" class="form-control" id="voucher" placeholder="Enter coupon">
            </div>
            <button type="submit" class="btn btn-secondary mb-2">Áp dụng</button>
          </form>

          <div class="d-flex flex-column border-bottom">
            <div class="d-flex justify-content-between py-2">
              <span>Tạm tính</span>
              <span>{{formatPrice(total)}}</span>
            </div>
            <div class="d-flex justify-content-between py-2">
              <span>Vận chuyển</span>
              <span>{{formatPrice(0)}}</span>
            </div>
            <div class="d-flex justify-content-between py-2">
              <span>Giảm giá</span>
              <span>{{formatPrice(0)}}</span>
            </div>
          </div>

          <div class="d-flex justify-content-between py-2">
            <span>Tổng cộng</span>
            <h5 class="m-0 text-danger">{{formatPrice(total)}}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from '@/components/ui/Breadcrumb.vue';
import { mapGetters, mapState } from 'vuex';
import { formatPrice } from '@/utils';
import axios from 'axios';
export default {
  name: 'Checkout',
  components: { Breadcrumb },
  computed: {
    ...mapState(['cart']),
    ...mapGetters(['total']),
    checkNewAddress() {
      return this.address == 'address-new';
    }
  },
  data() {
    return {
      api: 'https://provinces.open-api.vn/api/',
      address: ''
    };
  },
  methods: {
    formatPrice,
    async getCity() {
      let res = await axios.get(this.api);
      let city = res.data;
      console.log(city);
    }
  }
};
</script>

<style lang="scss" scoped>
.address-group {
  display: block;
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 3px;
  margin-top: 5px;
  label {
    margin: 0;
  }
}

.form-address {
  display: none;
}

.form-active {
  display: block;
}
</style>