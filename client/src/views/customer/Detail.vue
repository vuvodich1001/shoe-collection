<template>
  <div class="container">
    <SizeModal v-show="isShowModal" @close-modal="closeModal()" />
    <div class="row">
      <div class="col-lg-12">
        <Breadcrumb :breads="['Home', 'Detail']" />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-6">
            <div class="row">
              <div class="col-lg-12 d-flex justify-content-center">
                <img v-bind:src="imageSrc" alt="image" class="main-image w-75" style="height: 400px; object-fit: contain;">
              </div>
              <div class="col-lg-12">
                <div class="row sm-gutter mt-3">
                  <div class="col-lg-3 p-1"><img src="@/assets/images/air-force-1.jpg" @click="changeImageSrc" alt="image" class="sub-image w-100 px-2 py-0 rounded sub-image-active">
                  </div>
                  <div class="col-lg-3 p-1"><img src="@/assets/images/air-force-1-07.png" @click="changeImageSrc" alt="image" class="sub-image w-100 px-2 py-0 rounded">
                  </div>
                  <div class="col-lg-3 p-1"><img src="@/assets/images/air-force-1-08.png" @click="changeImageSrc" alt="image" class="sub-image w-100 px-2 py-0 rounded">
                  </div>
                  <div class="col-lg-3 p-1"><img src="@/assets/images/air-force-1-09.png" @click="changeImageSrc" alt="image" class="sub-image w-100 px-2 py-0 rounded">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mt-2">
              <p class="m-0" style="font-size: 1.5rem">Nike Air Force {{id}}</p>
              <div class="d-flex align-items-center">
                <span class="text-danger" style="font-size: 1.3rem">200.000 đ</span>
                <span class="d-inline-block mx-2 h-100 text-secondary">|</span>
                <a class="text-secondary" href="#comment" @click="showComment()">Đã nhận 2 đánh giá</a>
                <span class="d-inline-block mx-2 h-100 text-secondary">|</span>
                <span class="text-secondary"> Đã bán 5</span>
              </div>
              <div class="d-flex my-2">
                <span class="text-secondary">Size giay</span>
                <div class="ml-2">
                  <input type="radio" name="size" id="36" v-model="size" value="36" hidden>
                  <label for="36" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('36')}" style="font-size: 15px;">36</label>

                  <input type="radio" name="size" id="37" v-model="size" value="37" hidden>
                  <label for="37" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('37')}" style="font-size: 15px;">37</label>

                  <input type="radio" name="size" id="38" v-model="size" value="38" hidden>
                  <label for="38" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('38')}" style="font-size: 15px;">38</label>

                  <input type="radio" name="size" id="39" v-model="size" value="39" hidden>
                  <label for="39" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('39')}" style="font-size: 15px;">39</label>

                  <input type="radio" name="size" id="40" v-model="size" value="40" hidden>
                  <label for="40" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('40')}" style="font-size: 15px;">40</label>

                  <input type="radio" name="size" id="41" v-model="size" value="41" hidden>
                  <label for="41" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('41')}" style="font-size: 15px;">41</label>

                  <input type="radio" name="size" id="42" v-model="size" value="42" hidden>
                  <label for="42" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick('42')}" style="font-size: 15px;">42</label>
                </div>
              </div>
              <div class="row my-3">
                <div class="col-md-2 px-2">
                  <input type="radio" name="color" value="white" v-model="color" id="color-1" hidden>
                  <label for="color-1"><img src="@/assets/images/air-force-1.jpg" alt="image" class="rounded main-image" style="object-fit: contain;"></label>
                </div>
                <div class="col-md-2 px-2">
                  <input type="radio" name="color" value="black" v-model="color" id="color-2" hidden>
                  <label for="color-2"><img src="@/assets/images/air-force-1-black.jpg" alt="image" class="rounded main-image" style="object-fit: contain;"></label>
                </div>
              </div>
              <p class="text-primary my-2 size-direction" @click="showDirection()">Bảng quy đổi kích cỡ ></p>
              <div class="quantity mt-1">
                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-minus"></i></button>
                <span class="d-inline-block mx-2 font-weight-bold">1</span>
                <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus"></i></button>
              </div>
              <div class="my-3">
                <button class="btn btn-info" @click="addToCart()"><i class="fas fa-shopping-cart"></i> Add to
                  Cart</button>
                <button class="mx-3 btn btn-info"><i class="far fa-heart"></i> Farvourite </button>
              </div>
              <div v-show="isAddToCart" class="mt-1 alert alert-success cart--success text-center">
                Add to Cart Successfully!!!
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-12">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <input type="radio" name="describe" value="description" id="description" hidden v-model="tab">
                <label for="description" class="nav-link" :class="{active: checkTab('description')}">Mô tả sản phẩm</label>
              </li>
              <li class="nav-item">
                <input type="radio" name="describe" value="policy" id="policy" hidden v-model="tab">
                <label for="policy" class="nav-link" :class="{active: checkTab('policy')}">Chính sách đổi trả</label>
              </li>
              <li class="nav-item">
                <input type="radio" name="describe" value="comment" id="comment" hidden v-model="tab">
                <label for="comment" class="nav-link" :class="{active: checkTab('comment')}">Đánh giá</label>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane container mt-1 p-0" :class="{active: checkTab('description')}" id="description">
                <div class="text-justify" style="line-height: 30px;">
                  The radiance lives on in the Nike Air Force 1 '07, the b-ball OG that puts a fresh spin on what you know best: durably stitched overlays, clean finishes and the perfect amount of flash to make you shine.
                  <br><strong>Benefits</strong><br>
                  The stitched overlays on the upper add heritage style, durability and support.
                  Originally designed for performance hoops, the Nike Air cushioning adds lightweight, all-day comfort.
                  The low-cut silhouette adds a clean, streamlined look.
                  The padded collar feels soft and comfortable.
                  Product Details
                  <br><strong>Foam midsole</strong><br>
                  Perforations on the toe
                  Rubber sole
                  Colour Shown: White/White
                  Style: CW2288-111
                  Country/Region of Origin: Vietnam,India
                  Air Force 1 Origins
                  Debuting in 1982, the AF-1 was the first basketball shoe to house Nike Air, revolutionising the game while rapidly gaining traction around the world. Today, the Air Force 1 stays true to its roots with the same soft and springy cushioning that changed sneaker history.
                </div>
              </div>
              <div class="tab-pane container mt-1 p-0" :class="{active: checkTab('policy')}" id="policy">
                <div class="text-justify" style="line-height: 30px;">
                  QUY ĐỊNH CHUNG <br>

                  Chấp nhận được đổi size, không đổi kiểu. Chỉ được đổi kiểu trong trường hợp sản phẩm đó không còn size trên toàn hệ thống.
                  Trường hợp đổi sản phẩm khác có chênh lệch giá, khách hàng sẽ thanh toán thêm phần chênh lệch thiếu và Hạ Vàng sẽ không hoàn trả phần chênh lệch dư;
                  Giá của sản phẩm đã mua là giá trên hóa đơn; giá của sản phẩm đổi là giá niêm yết tại thời điểm đổi hàng.
                  CHÍNH SÁCH ĐỔI TRẢ

                  <br>Đối tượng áp dụng<br>

                  Sản phẩm Furla & Geox: hàng giảm giá từ dưới 40%;
                  Các sản phẩm giày dép trong nhóm sản phẩm ShooZ (Native, Flossy, Free-Water, Clae, Vionic, Flossy,XOX,): hàng giảm giá từ dưới 30%;
                  Thời gian đổi

                  Trong vòng 7 ngày tính từ ngày khách nhận được hàng, đến ngày Hạ Vàng nhận được sản phẩm đổi trả từ khách hàng (không tính trên dấu bưu điện hoặc thời gian đăng ký hoàn trả)

                  <br>Đối tượng không được áp dụng<br>

                  Phụ kiện thời trang, bóp, ví, bình nước, chăm sóc vệ sinh giày
                  Các sản phẩm đồng giá, phụ kiện thời trang, bình nước, shucare, quà tặng trong chương trình khuyến mãi.
                  <br>Điều kiện đổi:<br>

                  Sản phẩm còn nguyên tem, nhãn, túi vải và hộp giấy và bao bì có dán mã sản phẩm của Hạ Vàng.
                  Sản phẩm không có dấu hiệu đã qua sử dụng hay giặt, không bị dơ bẩn. (khi thử sản phẩm giày dép, khách hàng nên mang vớ và thử giày trên bề mặt sạch),
                  Có hóa đơn mua hàng và còn trong thời hạn quy định đổi.
                  Sản phẩm chỉ được đổi 01 lần duy nhất và đổi tại cửa hàng đã mua.
                  Đối với sản phẩm Furla: 01 sản phẩm chỉ được đổi tối đa 02 sản phẩm khác
                  Đối với sản phẩm Geox/ Shooz: 01 sản phẩm chỉ được đổi 01 sản phẩm.
                </div>
              </div>
              <div class="tab-pane container mt-1 p-0" :class="{active: checkTab('comment')}" id="comment">
                <div class="row mt-3 rounded" style="background-color: #fff;">
                  <div class="col-lg-12">
                    <div class="row mt-3">
                      <div class="col-lg-12">
                        <div class="d-flex align-items-center" id="review">
                          <span style="font-size: 2.0rem">4.3</span>
                          <div class="comment-rating mx-2 d-flex flex-column">
                            <div class="star text-warning ">
                              <i class="fas fa-star"></i>
                              <i class="mx-1 fas fa-star"></i>
                              <i class="mx-1 fas fa-star"></i>
                              <i class="mx-1 fas fa-star"></i>
                              <i class="mx-1 far fa-star"></i>
                            </div>
                            <p class="m-0" style="font-size: 1.1rem;">2 đánh giá</p>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <Comment v-for="i in 3" :key="i" />
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-12">
            <h4 class="m-0">Sản phẩm liên quan</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-4" v-for="shoe in shoes" :key="shoe.id">
            <Shoe :shoeProp="shoe" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Shoe from '@/components/Shoe.vue';
import Breadcrumb from '@/components/ui/Breadcrumb.vue';
import Comment from '@/components/ui/Comment.vue';
import SizeModal from '@/components/ui/SizeModal.vue';

export default {
  name: 'Detail',
  computed: {
    id() {
      return this.$route.params.id;
    }
  },
  components: { Shoe, Breadcrumb, Comment, SizeModal },
  data() {
    return {
      shoes: [
        {
          id: 1,
          name: 'Katrine Braun',
          brand: 'vans',
          gender: 'female',
          size: '41',
          color: 'black',
          price: 2551410
        },
        {
          id: 2,
          name: 'Prof. Demond Leannon',
          brand: 'addidas',
          gender: 'female',
          size: '42',
          color: 'black',
          price: 2447250
        },
        {
          id: 3,
          name: 'Everardo Turcotte PhD',
          brand: 'addidas',
          gender: 'male',
          size: '37',
          color: 'black',
          price: 1227641
        },
        {
          id: 4,
          name: 'Everardo Turcotte PhD',
          brand: 'addidas',
          gender: 'male',
          size: '37',
          color: 'black',
          price: 1227641
        }
      ],
      tab: 'description',
      isAddToCart: false,
      isShowModal: false,
      size: 0,
      color: '',
      imageSrc: require('@/assets/images/air-force-1.jpg')
    };
  },
  methods: {
    addToCart() {
      if (!this.size || !this.color) {
        alert('Bạn chưa chọn size hoặc color !!!');
        return;
      }
      this.isAddToCart = true;
      this.$store.dispatch('addToCart', {
        id: this.id,
        size: this.size,
        color: this.color
      });
      setTimeout(() => {
        this.isAddToCart = false;
      }, 3000);
    },
    changeImageSrc(e) {
      this.imageSrc = e.target.src;
    },
    checkTab(tabName) {
      return this.tab == tabName;
    },
    showDirection() {
      this.isShowModal = true;
    },
    closeModal() {
      this.isShowModal = false;
    },
    checkSizeTick(size) {
      return this.size == size;
    },
    showComment() {
      this.tab = 'comment';
    }
  }
};
</script>

<style lang="scss" scoped>
.main-image {
  cursor: pointer;
}

.sub-image {
  cursor: pointer;
}

.cart--success {
  animation: showUp ease-in-out 0.5s, fadeOut linear 1.5s 3s forwards;
}

@keyframes showUp {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes fadeOut {
  to {
    opacity: 0;
  }
}

.nav-link {
  color: var(--black-color);
  font-weight: bold;
  font-size: 20px;
  padding-left: 0;
  padding-right: 0;
  margin-right: 20px;
  position: relative;
}

.nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
  color: var(--main-color);
  background: var(--white-color);
  &::before {
    position: absolute;
    display: block;
    content: '';
    width: 100%;
    height: 4px;
    top: calc(100% - 6px);
    background: var(--main-color);
  }
}

.size-direction {
  cursor: pointer;
}

.btn-size--active {
  background-color: var(--secondary);
  color: var(--white-color);
}

input[name='color']:checked ~ label {
  border: 1px solid var(--primary);
  border-radius: 3px;
}
</style>