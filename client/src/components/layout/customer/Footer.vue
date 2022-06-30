<template>
  <footer class="py-3 mt-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4">
          <h5 class="color-head">Liên hệ</h5>
          <ul class="footer-list">
            <li class="footer-list-item"><a class="d-inline-block py-1 color-item" href=""><i class="mr-1 fas fa-home"></i>
                ShoeShop</a></li>
            <li class="footer-list-item"><a class="d-inline-block py-1 color-item" href=""><i class="mr-1 fas fa-envelope"></i>
                ShoeShop@gmail.com</a></li>
            <li class="footer-list-item"><a class="d-inline-block py-1 color-item" href=""><i class="mr-1 fas fa-phone-alt"></i>
                0912345678</a></li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4">
          <h5 class="color-head">Liên kết</h5>
          <ul class="footer-list">
            <li class="footer-list-item"><a class="d-inline-block py-1 color-item" href="">Trang chủ</a></li>
            <li class="footer-list-item"><a class="d-inline-block py-1 color-item" href="">Tất cả sản phẩm</a>
            </li>
            <li class="footer-list-item"><a class="d-inline-block py-1 color-item" href="">Tài khoản</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4">
          <h5 class="color-head">Đăng kí nhận tin</h5>
          <form class="my-3">
            <input class="form-control" type="email" placeholder="Nhập email của bạn" aria-label="">
            <button class="btn btn-secondary mt-2" type="submit">Submit</button>
          </form>
        </div>
        <div class="col-lg-3 col-md-4">
          <h5 class="color-head">Hình thức thanh toán</h5>
          <ul class="footer-list d-flex">
            <li class="footer-list-item mr-3"><a class="d-inline-block py-1 color-item" href=""><i class="fa-brands fa-cc-paypal" style="font-size: 40px;"></i></a></li>
            <li class="footer-list-item mr-3"><a class="d-inline-block py-1 color-item" href=""><img src="@/assets/momo.png" style="width: 40px;" alt=""></a>
            </li>
            <li class="footer-list-item mr-3"><a class="d-inline-block py-1 color-item border p-1 mt-2 border rounded text-warning" href="">COD</a>
            </li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-lg-12">
          <div class="mt-1 d-flex flex-column align-items-center justify-content-center">
            <ul class="d-flex justify-content-center">
              <li class="footer-list-item mx-2" style="font-size: 20px;">
                <router-link class="text-secondary" :to="{name: 'home'}">Home</router-link>
              </li>
              <li class="footer-list-item mx-2" style="font-size: 20px;">
                <router-link class="text-secondary" :to="{name: 'product'}">Product</router-link>
              </li>
              <li class="footer-list-item mx-2" style="font-size: 20px;">
                <router-link class="text-secondary" :to="{name: 'profile'}">Account</router-link>
              </li>
            </ul>
            <p class="color-item">Copyright ©2022 | Designed by vuvodich1001</p>
            <ul class="d-flex align-items-center justify-content-center social-share ">
              <li class="footer-list-item social-item social-item--facebook">
                <i class="fab fa-facebook-square"></i>
              </li>
              <li class="footer-list-item social-item social-item--google">
                <i class="fa-brands fa-google-plus"></i>
              </li>
              <li class="footer-list-item social-item social-item--telegram">
                <i class="fab fa-telegram"></i>
              </li>
              <li class="footer-list-item social-item social-item--linkedin">
                <i class="fab fa-linkedin"></i>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer'
};
</script>

<style lang="scss" scoped>
footer {
  background-color: #263238;
}

.footer-list-item:hover a {
  color: var(--warning);
  transition: all linear 0.3s;
  opacity: 0.8;
}
.color-head {
  margin-bottom: 15px;
  color: #d8d8dd;
}

.color-item {
  color: #ccc;
}

hr {
  background-color: #555;
}

.social-share {
  li {
    i {
      color: var(--secondary);
      font-size: 25px;
      margin: 0 20px;
      border: 1px solid #ccc;
      padding: 8px;
      border-radius: 50px;
    }
  }
}
</style>