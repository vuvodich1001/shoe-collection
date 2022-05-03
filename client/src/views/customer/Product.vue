<template>
  <main>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <Breadcrumb :breads="['Home', 'Product']" />
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <h4><i class="fas fa-list-ul"></i> Danh mục</h4>
          <div class="mt-3 sort-group">
            <p class="mb-2 font-weight-bold">Gender</p>
            <div class="sort-body m-2">
              <div class="m-1">
                <input type="checkbox" name="gender" id="male" value="male" v-model="genders">
                <label for="male" class=" d-inline-block ml-3">Nam</label>
              </div>
              <div class="m-1">
                <input type="checkbox" name="gender" id="female" value="female" v-model="genders">
                <label for="female" class="d-inline-block ml-3">Nữ</label>
              </div>
            </div>
          </div>
          <div class="mt-3 sort-group">
            <p class="mb-2 font-weight-bold">Brand</p>
            <div class="sort-body m-2">
              <div v-for="(brandItem, index) in listBrands" :key="index">
                <input type="radio" name="brand" :id="brandItem.name" :value="brandItem.name" v-model="brand">
                <label :for="brandItem.name" class="d-inline-block ml-3">{{brandItem.name}}</label>
              </div>
            </div>
          </div>
          <div class="mt-3 sort-group">
            <p class="mb-2 font-weight-bold">Color</p>
            <div class="sort-body m-1">
              <div class="color-list d-flex">
                <div class="color-item d-flex flex-column align-items-center" :class="{'color-item--active': checkTick('black')}">
                  <input type="checkbox" name="color" id="black" v-model="colors" hidden value="black">
                  <label for="black" class="bg-dark rounded-circle color-icon" style="width: 23px; height: 23px;"></label>
                  <label for="black" style="font-size: 1rem">Black</label>
                </div>
                <div class="color-item d-flex flex-column align-items-center" :class="{'color-item--active': checkTick('yellow')}">
                  <input type="checkbox" name="color" id="yellow" v-model="colors" hidden value="yellow">
                  <label for="yellow" class="bg-warning rounded-circle color-icon" style="width: 23px; height: 23px;"></label>
                  <label for="yellow" style="font-size: 1rem">Yellow</label>
                </div>
                <div class="color-item d-flex flex-column align-items-center" :class="{'color-item--active': checkTick('blue')}">
                  <input type="checkbox" name="color" id="blue" v-model="colors" hidden value="blue">
                  <label for="blue" class="bg-primary rounded-circle color-icon" style="width: 23px; height: 23px;"></label>
                  <label for="blue" style="font-size: 1rem">Blue</label>
                </div>
                <div class="color-item d-flex flex-column align-items-center" :class="{'color-item--active': checkTick('red')}">
                  <input type="checkbox" name="color" id="red" v-model="colors" hidden value="red">
                  <label for="red" class="bg-danger rounded-circle color-icon" style="width: 23px; height: 23px;"></label>
                  <label for="red" style="font-size: 1rem">Red</label>
                </div>
                <div class="color-item d-flex flex-column align-items-center" :class="{'color-item--active': checkTick('white')}">
                  <input type="checkbox" name="color" id="white" v-model="colors" hidden value="white">
                  <label for="white" class="bg-white rounded-circle color-icon border text-dark" style="width: 23px; height: 23px;"></label>
                  <label for="white" style="font-size: 1rem">White</label>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-3 sort-group">
            <p class="mb-2 font-weight-bold">Size</p>
            <div class="sort-body">
              <input type="checkbox" name="size" id="36" v-model="sizes" value="36" hidden>
              <label for="36" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('36')}" style="font-size: 15px;">36</label>

              <input type="checkbox" name="size" id="37" v-model="sizes" value="37" hidden>
              <label for="37" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('37')}" style="font-size: 15px;">37</label>

              <input type="checkbox" name="size" id="38" v-model="sizes" value="38" hidden>
              <label for="38" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('38')}" style="font-size: 15px;">38</label>

              <input type="checkbox" name="size" id="39" v-model="sizes" value="39" hidden>
              <label for="39" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('39')}" style="font-size: 15px;">39</label>

              <input type="checkbox" name="size" id="40" v-model="sizes" value="40" hidden>
              <label for="40" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('40')}" style="font-size: 15px;">40</label>

              <input type="checkbox" name="size" id="41" v-model="sizes" value="41" hidden>
              <label for="41" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('41')}" style="font-size: 15px;">41</label>

              <input type="checkbox" name="size" id="42" v-model="sizes" value="42" hidden>
              <label for="42" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('42')}" style="font-size: 15px;">42</label>
            </div>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="row">
            <!-- sort -->
            <div class="col-lg-12">
              <div class="detail-title d-flex align-items-center justify-content-between">
                <h4 class="m-0">All Products</h4>
                <div class="d-flex">
                  <p class="my-0 mr-2">Sort by:</p>
                  <select class="border" v-model="sortby">
                    <option value="">Mặc định</option>
                    <option value="created_at desc">Mới nhất</option>
                    <option value="price asc">Tăng dần</option>
                    <option value="price desc">Giảm dần</option>
                    <option value="best seller">Bán chạy nhất</option>
                    <!-- <option value="3">Từ a - z</option>
                    <option value="3">Từ z - a</option> -->
                  </select>
                </div>
              </div>
            </div>
            <!-- product list -->
            <div class="col-lg-4" v-for="shoe in shoes" :key="shoe.id">
              <Shoe :shoeProp="shoe" />
            </div>
          </div>
        </div>
      </div>
      <div v-if="paginate.lastPage > 1" class="row">
        <div class="col-lg-12">
          <div class="mt-5 pagination d-flex justify-content-end">
            <Pagination :currentPage="paginate.currentPage" :lastPage="paginate.lastPage" @click-handler="changePage" />
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import { shoeService } from '@/services';
import { brandService } from '@/services';
import Shoe from '@/components/Shoe.vue';
import Pagination from '@/components/ui/Pagination.vue';
import Breadcrumb from '@/components/ui/Breadcrumb.vue';
import { mapState } from 'vuex';
export default {
  name: 'Product',
  data() {
    return {
      url: '',
      shoes: [],
      genders: [],
      brand: '',
      colors: [],
      sizes: [],
      sortby: '',
      paginate: {
        currentPage: 0,
        lastPage: 0
      },
      listBrands: []
    };
  },
  components: { Shoe, Breadcrumb, Pagination },
  computed: {
    ...mapState(['shoeInfo'])
  },
  created() {
    //get brands
    this.getAllBrands();
    //
    let gender = this.$route.query.gender;
    let brand = this.$route.query.brand;
    let color = this.$route.query.color;
    let size = this.$route.query.size;
    let product = this.$route.query.product;
    if (gender) {
      this.genders = this.genders.concat(gender.split(','));
    }
    if (brand) {
      this.brand = brand;
    }
    if (color) {
      this.colors = this.colors.concat(color.split(','));
    }
    if (size) {
      this.sizes = this.sizes.concat(size.split(','));
    }
    if (product) {
      this.url == ''
        ? (this.url += `product=${product}`)
        : (this.url += `&product=${product}`);
      this.getShoes(this.url);
      return;
    }
    if (!(gender || brand || color || size)) this.getShoes(this.url);
  },
  methods: {
    changeUrl(url = '') {
      window.history.replaceState(history.state, null, url);
    },
    checkTick(color) {
      return this.colors.includes(color);
    },
    checkSizeTick(size) {
      return this.sizes.includes(size);
    },
    async getAllBrands() {
      let res = await brandService.all();
      this.listBrands = res.data.brands;
    },
    async getShoes(queryParams, page = 1) {
      let res = await shoeService.all(queryParams, page);
      this.shoes = res.data.shoes;
      this.paginate.lastPage = res.data.meta.lastPage;
      this.paginate.currentPage = res.data.meta.currentPage;
    },
    changePage(page) {
      if (page != 0 && page != this.paginate.lastPage + 1)
        this.getShoes(this.url, page);
    },
    commonChange() {
      this.url = '';
      if (this.genders.length != 0) {
        let gender = 'gender=' + this.genders.join(',');
        this.url += gender;
      }

      if (this.brand) {
        let br = 'brand=' + this.brand;
        this.url == '' ? (this.url += br) : (this.url += `&${br}`);
      }

      if (this.colors.length != 0) {
        let color = 'color=' + this.colors.join(',');
        this.url == '' ? (this.url += color) : (this.url += `&${color}`);
      }
      if (this.sizes.length != 0) {
        let size = 'size=' + this.sizes.join(',');
        this.url == '' ? (this.url += size) : (this.url += `&${size}`);
      }
      if (this.sortby) {
        let sort = 'sortby=' + this.sortby;
        this.url == '' ? (this.url += sort) : (this.url += `&${sort}`);
      }
      if (this.shoeInfo.product) {
        let p = 'product=' + this.shoeInfo.product;
        this.url == '' ? (this.url += p) : (this.url += `&${p}`);
      }
      this.getShoes(this.url);
      this.changeUrl(`?${this.url}`);
    }
  },
  watch: {
    genders() {
      this.commonChange();
    },
    brand() {
      this.commonChange();
    },
    colors() {
      this.commonChange();
    },
    sizes() {
      this.commonChange();
    },
    sortby() {
      this.commonChange();
    },
    shoeInfo() {
      // this.brands = [];
      // this.brands.push(this.shoeInfo.brand);
      this.brand = this.shoeInfo.brand;
    }
  }
};
</script>

<style lang="scss" scoped>
.color-item {
  cursor: pointer;
  &:hover {
    opacity: 0.7;
  }
  &--active {
    .color-icon {
      position: relative;
      color: var(--white-color);
    }
    .color-icon::before {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-family: 'Font Awesome 5 Free';
      content: '\f00c';
      display: block;
      font-weight: 900;
      color: inherit;
    }
  }
}

.color-item + .color-item {
  margin-left: 20px;
}

label {
  font-size: 18px;
}

.btn-size--active {
  background-color: var(--secondary);
  color: var(--white-color);
}

input[type='checkbox'] {
  transform: scale(1.4);
  appearance: none;
  background-color: #fff;
  color: black;
  width: 14px;
  height: 14px;
  border: 1px solid var(--black-color);
  border-radius: 2px;
  position: relative;
  &::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -1px;
    transform: scale(0);
    font-family: 'Font Awesome 5 Free';
    content: '\f00c';
    display: inline-block;
    font-weight: bold;
    color: black;
  }
  &:checked::before {
    transform: scale(0.8);
  }
}
// custom radio
input[type='radio'] {
  background-color: #fff;
  width: 1.15em;
  height: 1.15em;
}
</style>