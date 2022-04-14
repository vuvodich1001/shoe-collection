<template>
  <div class="container">
    <!-- slider -->
    <!-- <div class="row slider mt-2">
      <div class="col-lg-12">
        <divs class="row slider-login rounded p-3 text-light">
          <div class="col-lg-6">
            <h3 class="font-weight-bold">Đăng nhập ngay</h3>
            <p style="font-size: 19px;">Hàng ngàn voucher và phần thưởng hấp dẫn đang đợi bạn
              phía trước</p>
            <button class="btn btn-outline-warning" data-toggle="modal" data-target="#signInModal">Đăng nhập</button>
          </div>
          <div class="col-lg-6">
            <div class="text-center display-1" style="opacity: 0.6;">
              <i class="far fa-address-book"></i>
            </div>
          </div>
        </divs>
      </div>
      <div class="col-lg-12">
        <divs class="row slider-voucher rounded p-3 text-light">
          <div class="col-lg-6">
            <h3 class="font-weight-bold">Nhận voucher</h3>
            <p style=" font-size: 19px;">Hàng ngàn voucher và phần thưởng hấp dẫn đang đợi bạn
              phía trước</p>
            <a href="voucher.html"><button class="btn btn-outline-warning">Nhận
                ngay</button></a>
          </div>
          <div class="col-lg-6">
            <div class="text-center display-1" style="opacity: 0.6;">
              <i class="fas fa-tags"></i>
            </div>
          </div>
        </divs>
      </div>
      <div class="col-lg-12">
        <divs class="row slider-share rounded p-3 text-light">
          <div class="col-lg-6">
            <h3 class="font-weight-bold">Chia sẻ ngay</h3>
            <p style="font-size: 19px;">Chia sẻ để giới thiệu với bạn bè và cùng nhau nhận nhiều
              phần thưởng hấp dẫn của shop nhé ♥ </p>
            <a href=""><button class="btn btn-outline-warning">Chia sẻ ngay</button></a>
          </div>
          <div class="col-lg-6">
            <div class="text-center display-1" style="opacity: 0.6;">
              <i class="far fa-share-square"></i>
            </div>
          </div>
        </divs>
      </div>
    </div> -->
    <!-- Sản phẩm nổi bật -->
    <div class="row">
      <div class="col-md-12">
        <h2 class="main-title text-center font-weight-bold mt-2 p-3">
          Sản phẩm nổi bật
        </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-4" v-for="shoe in shoes" :key="shoe.id">
        <Shoe :shoeProp="shoe" />
      </div>
    </div>
    <!-- button xêm thêm sản phẩm nổi bật-->
    <div class="row">
      <div class="col-md-12">
        <div class="text-center h3 p-3">
          <a href="/product"><button class="btn btn-sm btn-outline-secondary">Xem thêm</button></a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Shoe from '@/components/Shoe.vue';
import { shoeService } from '@/services';
export default {
  name: 'Home',
  components: { Shoe },
  data() {
    return {
      shoes: []
    };
  },
  created() {
    this.getTopShoes();
  },
  methods: {
    async getTopShoes() {
      let res = await shoeService.all('limit=8');
      this.shoes = res.data.shoes;
    }
  }
};
</script>

<style lang="scss" scoped>
.main-title {
  position: relative;
  &::after {
    content: '';
    display: block;
    width: 120px;
    height: 5px;
    background-color: var(--black-color);
    position: absolute;
    left: 50%;
    top: 85%;
    transform: translateX(-50%);
  }
}
</style>