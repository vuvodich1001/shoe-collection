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
        <!-- <label class="address-group" for="address-1">
          <input type="radio" name="address" value="address-1" id="address-1" v-model="address">
          <span class="d-inline-block ml-2">Vu Nguyen, 0967979521 - 7/56/2, đường số 6, phường long trường, quận 9, HCMC</span>
        </label> -->
        <label v-for="(address, index) in customerAddresses" :key="index" class="address-group" :for="address.id">
          <input type="radio" name="address" :value="address.id" :id="address.id" v-model="addressId">
          <span class="d-inline-block ml-2">{{`${address.name}, ${address.phone} - ${address.line1}, ${address.line2}, ${address.city}`}}</span>
        </label>
        <label class="address-group" for="address-new">
          <div class="d-flex align-items-center">
            <input type="radio" name="address" value="address-new" id="address-new" v-model="addressId">
            <div class="d-flex justify-content-between align-items-center ml-2" style="flex:1">Thêm địa chỉ mới
              <i class="fa-solid fa-chevron-left" :class="{'d-none': checkNewAddress}"></i>
              <i class="fa-solid fa-chevron-down" :class="{'d-none': !checkNewAddress}"></i>
            </div>
          </div>
          <form class="mt-2 form-address" :class="{'form-active': checkNewAddress}" method="">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Vu Nguyen" v-model="newAddress.name">
              </div>
              <div class="form-group col-md-5">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="vunguyen@gmail.com" v-model="newAddress.email">
              </div>
              <div class="form-group col-md-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="0912345678" v-model="newAddress.phone">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="TPHCM" v-model="newAddress.city">
              </div>
              <div class="form-group col-md-4">
                <label for="district">District</label>
                <input type="district" class="form-control" id="district" placeholder="Quan 9" v-model="newAddress.district">
              </div>
              <div class="form-group col-md-4">
                <label for="ward">Ward</label>
                <input type="ward" class="form-control" id="ward" placeholder="Long truong" v-model="newAddress.ward">
              </div>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" placeholder="5/57, duong so 8" v-model="newAddress.address">
            </div>

            <button class="btn d-none">Submit</button>
          </form>
        </label>

        <h4>Phương thức thanh toán</h4>
        <ul class="list-group">
          <li class="rounded list-group-item d-inline-block">
            <label for="payment-1" class="d-block mb-0">
              <input type="radio" name="payment" value="COD" id="payment-1" v-model="paymentMethod">
              <span class="d-inline-block mb-0 ml-2">Thanh toán khi nhận hàng</span>
            </label>
          </li>
          <li class="mt-2 border rounded list-group-item">
            <label for="payment-2" class="d-block mb-0">
              <input type="radio" name="payment" value="Paypal" id="payment-2" v-model="paymentMethod">
              <span class="d-inline-block mb-0 ml-2">Thanh toán qua Paypal</span>
            </label>
          </li>
        </ul>

        <button type="submit" class="btn btn-secondary my-3" @click="purchaseShoes()">Mua hàng</button>
      </div>
      <div class="col-lg-4">
        <div class="cart-detail px-3">
          <ul class="border-bottom pb-2">
            <li class="d-flex align-items-center mt-3 justify-content-between" v-for="c in cart" :key="c.shoe.id">
              <img :src="c.shoe.defaultImage.image" alt="" class="rounded" style="height: 90px; width: 90px; object-fit: cover;">
              <span class="d-inline-block mx-2" style="max-width: 110px;">{{c.shoe.name}}</span>
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
              <span>{{formatPrice(total * 0.05)}}</span>
            </div>
            <div class="d-flex justify-content-between py-2">
              <span>Giảm giá</span>
              <span>{{formatPrice(0)}}</span>
            </div>
          </div>

          <div class="d-flex justify-content-between py-2">
            <span>Tổng cộng</span>
            <h5 class="m-0 text-danger">{{formatPrice(total *1.05)}}</h5>
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
import { orderService } from '@/services';
export default {
  name: 'Checkout',
  components: { Breadcrumb },
  computed: {
    ...mapState(['cart', 'user']),
    ...mapGetters(['total']),
    checkNewAddress() {
      return this.addressId == 'address-new';
    }
  },
  created() {
    this.getAddressByCustomerId();
  },
  data() {
    return {
      api: 'https://provinces.open-api.vn/api/',
      addressId: '',
      newAddress: {
        name: '',
        email: '',
        phone: '',
        city: '',
        district: '',
        ward: '',
        address: ''
      },
      customerAddresses: [],
      paymentMethod: ''
    };
  },
  methods: {
    formatPrice,
    async getCity() {
      let res = await axios.get(this.api);
      let city = res.data;
      console.log(city);
    },
    async getAddressByCustomerId() {
      let res = await orderService.getAllAddressByCustomerId(this.user.id);
      this.customerAddresses = res.data.addresses;
    },
    async purchaseShoes() {
      let formData = new FormData();
      formData.append('orderDetails', JSON.stringify(this.cart));
      formData.append('total', this.total * 1.05);
      formData.append('subtotal', this.total);
      formData.append('shippingFee', this.total * 0.05);
      formData.append('discount', 0);
      formData.append('paymentMethod', this.paymentMethod);
      if (this.addressId != 'address-new') {
        formData.append('addressId', this.addressId);
      } else {
        formData.append('newAddress', JSON.stringify(this.newAddress));
      }
      await orderService.create(formData);
      alert('Bạn đã đặt hàng thành công!');
      this.$store.dispatch('removeCart');
      this.$router.push({ name: 'home', params: {} });
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