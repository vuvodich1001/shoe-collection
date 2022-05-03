<template>
  <header>
    <nav class="container">
      <div class=" row">
        <div class="col-lg-3">
          <div class="logo d-flex align-items-center justify-content-center my-3 h-100">
            <router-link to="/" class="display-4 text-dark">Store</router-link>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              <div class="d-flex justify-content-between my-3" style="height: 50px;">
                <ul class="d-flex">
                  <li class="nav-item-head">
                    <router-link class="nav-item-link" to="/home">Trang chủ</router-link>
                  </li>
                  <li class="nav-item-head">
                    <router-link class="nav-item-link ml-5" to="/product">Cửa hàng</router-link>
                  </li>
                  <li class="nav-item-head" v-if="user">
                    <a class="nav-item-link ml-5">
                      Tài Khoản
                      <i class="fa-solid fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu">
                      <router-link class="dropdown-item" :to="{name: 'profile'}">Tài Khoản</router-link>
                      <router-link class="dropdown-item" :to="{name: 'order'}">Đơn đặt hàng</router-link>
                      <a class="dropdown-item" href="review.html">Đánh giá sản phẩm</a>
                      <a class="dropdown-item" href="" @click.prevent="logout()">Đăng xuất</a>
                    </div>
                  </li>
                </ul>
                <router-link class="nav-link p-lg-0" to="/cart">
                  <button class="btn btn-outline-secondary"><i class="fas fa-shopping-cart"></i>
                    Cart <span class="p-1 rounded bg-dark text-light">{{cartCount}}</span></button>
                </router-link>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="search border d-flex align-items-center">
                <div class="border-right px-2">
                  <select name="" id="" class="border-0 h-100 font-weight-bold" v-model="brand">
                    <option value="">Chọn</option>
                    <option value="nike">Nike</option>
                    <option value="adidas">Adidas</option>
                    <option value="vans">Vans</option>
                  </select>
                </div>
                <div class="input-group">
                  <input type="text" class="form-control border-0" placeholder="Bạn đang cần mua sản phẩm nào ?" v-model="product" @keyup.enter="findProduct()">
                  <div class="input-group-append">
                    <button class="btn btn-secondary" type="button" @click="findProduct()">Tìm kiếm</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="d-flex justify-content-end align-items-center">
                <router-link v-if="!user" class="btn" to="/register" style="border-radius: 25px;">Register</router-link>
                <router-link v-if="!user" class=" ml-1 btn btn-dark px-3 py-1" to="/login" style="border-radius: 25px;">Login</router-link>
                <h5 v-if="user" class="m-0">Hi, {{user.name}}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-md mt-3 w-100 bg-secondary">
            <div class="navbar-brand text-light">
              <router-link :to="{name: 'product', query: {brand: 'nike'}}" class="text-light">Nike</router-link>
              <div class="navbar-more">
                <ul class="navbar-list">
                  <li class="navbar-item"><a href="">LifeStyle</a></li>
                  <li class="navbar-item"><a href="">Jordan</a></li>
                  <li class="navbar-item"><a href="">Running</a></li>
                </ul>
              </div>
            </div>
            <div class="navbar-brand text-light">
              <router-link :to="{name: 'product', query: {brand: 'adidas'}}" class="text-light">Adiddas</router-link>
              <div class="navbar-more">
                <ul class="navbar-list">
                  <li class="navbar-item"><a href="">LifeStyle</a></li>
                  <li class="navbar-item"><a href="">Jordan</a></li>
                  <li class="navbar-item"><a href="">Running</a></li>
                </ul>
              </div>
            </div>
            <div class="navbar-brand text-light">
              <router-link :to="{name: 'product', query: {brand: 'vans'}}" class="text-light">Vans</router-link>
              <div class="navbar-more">
                <ul class="navbar-list">
                  <li class="navbar-item"><a href="">LifeStyle</a></li>
                  <li class="navbar-item"><a href="">Jordan</a></li>
                  <li class="navbar-item"><a href="">Running</a></li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import { authService } from '@/services';
import { mapGetters, mapState } from 'vuex';
export default {
  name: 'Header',
  computed: {
    ...mapGetters(['cartCount']),
    ...mapState(['user'])
  },
  data() {
    return {
      product: '',
      brand: ''
    };
  },
  methods: {
    findProduct() {
      if (this.$route.name != 'product') {
        this.$router.push({
          name: 'product',
          query: { product: this.product, brand: this.brand }
        });
      } else {
        this.$store.dispatch('setShoeInfo', {
          product: this.product,
          brand: this.brand
        });
      }
    },
    logout() {
      authService.logout();
      this.$store.dispatch('logout');
    }
  }
};
</script>

<style lang="scss" scoped>
.nav-item-link {
  line-height: 50px;
  font-weight: 500;
  color: var(--black-color);
}
.nav-item-link:hover {
  color: var(--main-color);
  transition: color linear 0.1s;
}

.search {
  border-radius: 3px;
}

.navbar {
  // background: #ff0054;
}
.navbar-brand {
  position: relative;
  &:hover {
    .navbar-more {
      display: block;
    }
  }
  .navbar-more {
    display: none;
    position: absolute;
    z-index: 10;
    .navbar-list {
      background: #fafafa;
      box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
      border-radius: 2px;
      padding: 5px 20px;
      .navbar-item {
        position: relative;
        color: var(--black-color);
      }
      a {
        font-size: 17px;
        display: inline-block;
        color: var(--black-color);
        font-weight: 400;
        &:hover {
          color: var(--main-color);
        }
      }
    }
  }
  @keyframes scaleUp {
    to {
      opacity: 0;
      transform: scale(1);
    }
    from {
      opacity: 1;
      transform: scale(1);
    }
  }
}

.nav-item-head {
  position: relative;
  &:hover {
    .dropdown-menu {
      display: block;
    }
  }
}

.dropdown-menu {
  position: absolute;
  left: 25%;
  &::before {
    position: absolute;
    display: block;
    content: '';
    width: 100%;
    height: 10px;
    background: transparent;
    top: -10px;
  }
}
</style>