<template>
  <div class="container">
    <SizeModal v-show="isShowModal" @close-modal="closeModal()" />
    <div class="row">
      <div class="col-lg-12">
        <Breadcrumb :breads="['Home', 'Detail', id]" />
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
                  <div v-for="(image, index) in getExtraImageByColor" :key="index" class="col-lg-3 p-1">
                    <img :src="image.image" @click="changeImageSrc" alt="image" class="sub-image w-100 px-2 py-0 rounded sub-image-active">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="mt-2">
              <div>
                <span class="mr-1 badge badge-success">{{mainShoe.brand}}</span>
                <span class="mx-1 badge badge-info">{{ucfirst(mainShoe.gender)}}</span>
                <span class="mx-1 badge badge-primary">{{ucfirst(mainShoe.category)}}</span>
              </div>
              <p class="m-0" style="font-size: 1.5rem">{{mainShoe.name}}</p>
              <div class="d-flex align-items-center">
                <span class="text-danger" style="font-size: 1.3rem">{{formatPrice(mainShoe.price)}}</span>
                <span class="d-inline-block mx-2 h-100 text-secondary">|</span>
                <a class="text-secondary" href="#comment" @click="showComment()">Đã nhận {{paginate.total}} đánh giá</a>
                <span class="d-inline-block mx-2 h-100 text-secondary">|</span>
                <span class="text-secondary"> Đã bán {{mainShoe.saledQuantity}}</span>
              </div>
              <div class="row my-3">
                <div v-for="(value, index) in getDefaultImage" :key="index" class="col-md-2 px-2">
                  <input type="radio" name="color" :value="value.color" v-model="color" :id="index" hidden>
                  <label :for="index"><img :src="value.image" @click="changeImageSrc" alt="image" class="rounded main-image" style="object-fit: contain;"></label>
                </div>
              </div>
              <div class="d-flex my-2 align-items-center">
                <p class="text-secondary mb-0">Size giay</p>
                <div class="ml-2">
                  <span v-for="(value, index) in getSizeByColor" :key="index">
                    <input type="radio" name="size" :id="value.size" v-model="size" :value="value.size" hidden>
                    <label :for="value.size" class="m-1 btn btn-outline-secondary btn-sm" :class="{'btn-size--active': checkSizeTick(value.size)}" style="font-size: 15px;">{{value.size}}</label>
                  </span>
                </div>
              </div>
              <p class="text-primary mb-3 size-direction" @click="showDirection()">Bảng quy đổi kích cỡ ></p>
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
                <label for="comment" class="nav-link" :class="{active: checkTab('comment')}">Đánh giá ({{paginate.total}})</label>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane container mt-1 p-0" :class="{active: checkTab('description')}" id="description">
                <div class="text-justify" style="line-height: 30px;">
                  {{mainShoe.description}}
                </div>
              </div>
              <div class="tab-pane container mt-1 p-0" :class="{active: checkTab('policy')}" id="policy">
                <div class="text-justify" style="line-height: 30px;">
                  <i>Quy định chung:</i> <br>

                  Chấp nhận được đổi size, không đổi kiểu. Chỉ được đổi kiểu trong trường hợp sản phẩm đó không còn size trên toàn hệ thống.
                  Trường hợp đổi sản phẩm khác có chênh lệch giá, khách hàng sẽ thanh toán thêm phần chênh lệch thiếu và Hạ Vàng sẽ không hoàn trả phần chênh lệch dư;
                  Giá của sản phẩm đã mua là giá trên hóa đơn; giá của sản phẩm đổi là giá niêm yết tại thời điểm đổi hàng.
                  CHÍNH SÁCH ĐỔI TRẢ

                  <br><i>Đối tượng áp dụng</i><br>

                  Sản phẩm Furla & Geox: hàng giảm giá từ dưới 40%;
                  Các sản phẩm giày dép trong nhóm sản phẩm ShooZ (Native, Flossy, Free-Water, Clae, Vionic, Flossy,XOX,): hàng giảm giá từ dưới 30%;
                  Thời gian đổi

                  Trong vòng 7 ngày tính từ ngày khách nhận được hàng, đến ngày Hạ Vàng nhận được sản phẩm đổi trả từ khách hàng (không tính trên dấu bưu điện hoặc thời gian đăng ký hoàn trả)

                  <br><i>Đối tượng không được áp dụng</i><br>

                  Phụ kiện thời trang, bóp, ví, bình nước, chăm sóc vệ sinh giày
                  Các sản phẩm đồng giá, phụ kiện thời trang, bình nước, shucare, quà tặng trong chương trình khuyến mãi.
                  <br><i>Điều kiện đổi:</i><br>

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
                          <h4 class="text-secondary m-0">Overview: </h4>
                          <span class="ml-3" style="font-size: 2.0rem">{{mainShoe.totalRating}}.0</span>
                          <div class="comment-rating mx-2 d-flex flex-column">
                            <div class="star text-warning ">
                              <i v-for="i in mainShoe.totalRating" :key="i" class="mx-1 fas fa-star"></i>
                              <i v-for="j in (5-mainShoe.totalRating)" :key="j" class="mx-1 far fa-star"></i>
                            </div>
                            <p class="ml-1 mb-0 text-secondary" style="font-size: 1.1rem;">{{paginate.total}} đánh giá</p>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <Comment v-for="(comment, index) in comments" :key="index" :detailComment="comment" />
                <div v-if="paginate.lastPage > 1" class="row">
                  <div class="col-lg-12">
                    <div class="mt-5 pagination d-flex justify-content-end">
                      <Pagination :currentPage="paginate.currentPage" :lastPage="paginate.lastPage" @click-handler="changePage" />
                    </div>
                  </div>
                </div>
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
import Pagination from '@/components/ui/Pagination.vue';
import { shoeService } from '@/services';
import { reviewService } from '@/services';
import { formatPrice } from '@/utils';
import { ucfirst } from '@/utils';

export default {
  name: 'Detail',
  computed: {
    id() {
      return this.$route.params.id;
    },
    getDefaultImage() {
      return this.mainShoe.subImage.filter((value) => value.default == 1);
    },
    getExtraImageByColor() {
      return this.mainShoe.subImage.filter(
        (value) => value.color == this.color
      );
    },
    getSizeByColor() {
      return this.mainShoe.details.filter((value) => value.color == this.color);
    }
  },
  components: { Shoe, Breadcrumb, Comment, SizeModal, Pagination },
  created() {
    this.getShoeById(this.id);
    this.getRelatedShoes(this.id);
    this.getReviewsByShoeId(this.id);
  },
  data() {
    return {
      mainShoe: {
        name: '',
        price: 0,
        subImage: [],
        details: [],
        category: '',
        gender: '',
        totalRating: 0
      },
      comments: [],
      shoes: [],
      tab: 'description',
      isAddToCart: false,
      isShowModal: false,
      size: 0,
      color: '',
      imageSrc: '',
      paginate: {
        lastPage: 0,
        currentPage: 0,
        total: 0
      }
    };
  },
  methods: {
    formatPrice,
    ucfirst,
    addToCart() {
      if (!this.size) {
        alert('Bạn chưa chọn size !!!');
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
    },
    async getShoeById(id) {
      let res = await shoeService.find(id);
      this.mainShoe = res.data.shoe;
      this.imageSrc = this.mainShoe.defaultImage.image;
      this.color = this.mainShoe.details[0].color;
      console.log(this.mainShoe);
    },
    async getRelatedShoes(id) {
      let res = await shoeService.shoeRelated(id);
      this.shoes = res.data.shoes;
    },
    async getReviewsByShoeId(id, page = 0) {
      let res = await reviewService.getReviewsByShoeId(id, page);
      this.comments = res.data.reviews;
      this.paginate.currentPage = res.data.meta.currentPage;
      this.paginate.lastPage = res.data.meta.lastPage;
      this.paginate.total = res.data.meta.total;
    },
    changePage(page) {
      if (page != 0 && page != this.paginate.lastPage + 1)
        this.getReviewsByShoeId(this.id, page);
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