<template>
  <div class="row review mt-3 border rounded mx-0 py-3">
    <div class="col-lg-4">
      <div class="name-group d-flex align-items-center">
        <div class="photo bg-dark mr-3 p-2 text-light rounded-circle">
          {{detailComment.customer.name.substring(0, 2).toUpperCase()}}
        </div>
        <div>
          <p class="m-0 font-weight-bold">{{detailComment.customer.name}}</p>
          <div class="text-success">
            <i class="fa-solid fa-circle-check"></i>
            <span class="d-inline-block ml-2">Đã mua hàng</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="comment-group">
        <div class="comment-rating text-warning">
          <i v-for="i in detailComment.rating" :key="i" class="mx-1 fas fa-star"></i>
          <i v-for="j in (5-detailComment.rating)" :key="j" class="mx-1 far fa-star"></i>
        </div>
        <img :src="detailComment.image" alt="" class="rounded" style="width: 110px; object-fit: cover;">
        <div class="comment-body my-1">
          {{detailComment.comment}}
        </div>
        <div class="comment-date text-secondary">
          {{detailComment.created_at}}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['detailComment'],
  name: 'Comment'
};
</script>

<style lang="scss" scoped>
.review {
  background-color: #f5f5f5;
}
</style>