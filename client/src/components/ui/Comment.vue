<template>
  <div class="row review mt-3 border rounded mx-0 py-3">
    <div class="col-lg-4">
      <div class="name-group d-flex align-items-center">
        <div class="photo bg-dark mr-3 p-2 text-light rounded-circle">
          {{shortName}}
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
          <i v-for="i in detailComment.rating" :key="i" class="mr-2 fas fa-star"></i>
          <i v-for="j in (5-detailComment.rating)" :key="j" class="mr-2 far fa-star"></i>
        </div>
        <img :src="detailComment.image" alt="" class="my-2 rounded" style="width: 110px; object-fit: cover;">
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
  name: 'Comment',
  computed: {
    shortName() {
      let index = this.detailComment.customer.name.trim().indexOf(' ');
      console.log(index);
      let fname = this.detailComment.customer.name.substring(
        index + 1,
        index + 2
      );
      let lname = this.detailComment.customer.name.substring(0, 1);
      return (lname + fname).toUpperCase();
    }
  }
};
</script>

<style lang="scss" scoped>
.review {
  background-color: #f5f5f5;
}
</style>