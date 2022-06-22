<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <Breadcrumb :breads="['Home', 'Review', 'Write-Review']" />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <h3 class="text-center">Đánh giá sản phẩm</h3>
      </div>
      <div class="col-lg-6">
        <div class="item p-2 mt-4 d-flex justify-content-around align-items-center bg-light" style="font-size: 1.1rem;">
          <div class="d-flex align-items-center">
            <img :src="shoe.defaultImage.image" alt="" class="rounded" style="width: 110px; object-fit: cover;">
            <div class="ml-3">
              <span class="d-inline-block" style="max-width: 200px;">{{shoe.name}}</span>
              <div class="mt-2 comment-rating text-warning">
                <i class="mr-2 fas fa-star"></i>
                <i class="mr-2 fas fa-star"></i>
                <i class="mr-2 fas fa-star"></i>
                <i class="mr-2 fas fa-star"></i>
                <i class="mr-2 far fa-star"></i>
              </div>
            </div>
          </div>
          <div class="alert alert-primary p-1">Đã nhận 5 đánh giá</div>
        </div>
      </div>
      <div class="col-lg-12">
        <form action="" method="post" @submit.prevent="createReview()">
          <div class="d-flex justify-content-center">
            <div class="rating-star">
              <input id="star10" name="rating" type="radio" v-model="review.rating" value="5">
              <label for="star10"></label>
              <input id="star8" name="rating" type="radio" v-model="review.rating" value="4">
              <label for="star8"></label>
              <input id="star6" name="rating" type="radio" v-model="review.rating" value="3">
              <label for="star6"></label>
              <input id="star4" name="rating" type="radio" v-model="review.rating" value="2">
              <label for="star4"></label>
              <input id="star2" name="rating" type="radio" v-model="review.rating" value="1">
              <label for="star2"></label>
            </div>
          </div>
          <textarea v-model="review.comment" name="comment" id="comment" cols="30" rows="12" class="w-100 p-2 border" placeholder="Viết đánh giá ở đây" onfocus="this.style.outline = 'none'"></textarea>
          <input type="file" name="review-image" id="review-image" class="mt-2" @change="onImageChange">
          <button class="d-block btn btn-info mt-3 mx-auto">Gửi đánh giá</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from '@/components/ui/Breadcrumb.vue';
import { shoeService } from '@/services';
import { reviewService } from '@/services';
export default {
  name: 'Review',
  components: { Breadcrumb },
  computed: {
    id() {
      return this.$route.params.id;
    }
  },
  data() {
    return {
      shoe: {
        defaultImage: {
          image: ''
        },
        name: ''
      },
      review: {
        rating: 0,
        comment: '',
        image: ''
      }
    };
  },
  created() {
    this.getShoeById(this.id);
  },
  methods: {
    onImageChange(e) {
      this.review.image = e.target.files[0];
    },
    async getShoeById(id) {
      let res = await shoeService.find(id);
      this.shoe = res.data.shoe;
    },
    async createReview() {
      let formData = new FormData();
      for (const [key, value] of Object.entries(this.review)) {
        formData.append(key, value);
        console.log(key, value);
      }
      formData.append('shoeId', this.id);
      await reviewService.create(formData);
      alert('Cảm ơn bạn đã đánh giá <3');
      this.$router.push({ name: 'home' });
    }
  }
};
</script>

<style lang="scss" scoped>
.rating-star {
  display: inline-flex;
  flex-direction: row-reverse;
  input {
    display: none;
  }
  label {
    color: #ccc;
    &:before {
      font-family: 'Font Awesome 5 Free';
      display: block;
      font-size: 2.3rem;
      padding: 0.3rem 0.2rem;
      margin: 0;
      cursor: pointer;
      font-weight: 900;
      content: '\f005';
      color: inherit;
    }
  }
  input:checked ~ label:before {
    color: var(--warning);
  }
}
</style>