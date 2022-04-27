<template>
  <router-link :to="{name: 'detail', params: {id: shoeProp.id}}" class="item d-block mt-4">
    <div class="card border-0">
      <img class="card-img-top p-1" :src="shoeProp.defaultImage.image ? shoeProp.defaultImage.image : require('@/assets/images/air-force-1.jpg')" alt="Card image cap">
      <div class="card-body text-center p-2">
        <div class="comment-rating text-warning">
          <i class="d-inline-block mx-1 fas fa-star"></i>
          <i class="d-inline-block mx-1 fas fa-star"></i>
          <i class="d-inline-block mx-1 fas fa-star"></i>
          <i class="d-inline-block mx-1 fas fa-star"></i>
          <i class="d-inline-block mx-1 far fa-star"></i>
        </div>
        <h5 class="card-title text-truncate text-dark my-1 font-weight-normal" style="font-size: 1.1rem;">
          {{shoeProp.name}}</h5>
        <p class="card-text d-flex align-items-center justify-content-center">
          <span class="shoe-price text-danger">{{formatPrice(shoeProp.price)}}</span>
          <span class="d-inline-block mx-2 h-100 text-secondary">|</span>
          <span class="text-secondary"> Đã bán 0</span>
          <!-- <span class="text-secondary"> {{shoeProp.gender}}</span> -->
          <!-- <span class="d-inline-block mx-2 h-100 text-secondary">|</span> -->
          <!-- <span class="text-secondary"> {{shoeProp.color}}</span> -->
        </p>
      </div>
    </div>
  </router-link>
</template>

<script>
import { formatPrice } from '@/utils';
export default {
  name: 'Shoe',
  props: ['shoeProp'],
  methods: {
    formatPrice,
    changeFormatColor(listDetails) {
      return listDetails.reduce((acc, val) => {
        return acc + ' ' + val.color;
      }, '');
    },
    changeFormatSize(listDetails) {
      return listDetails.reduce((acc, val) => {
        return acc + ' ' + val.size;
      }, '');
    }
  }
};
</script>

<style>
.shoe-price {
  font-size: 1.2rem;
  color: var(--main-color);
}
</style>