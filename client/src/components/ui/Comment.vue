<template>
  <div class="row review mt-3 border rounded mx-0 py-3">
    <div class="col-lg-4">
      <div class="name-group d-flex align-items-center">
        <div class="photo bg-dark mr-3 p-2 text-light rounded-circle">
          NA
        </div>
        <div>
          <p class="m-0 font-weight-bold">Nguyen Van A</p>
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
          <i class="fas fa-star"></i>
          <i class="mx-1 fas fa-star"></i>
          <i class="mx-1 fas fa-star"></i>
          <i class="mx-1 fas fa-star"></i>
          <i class="mx-1 far fa-star"></i>
        </div>
        <div class="comment-body my-1">
          Sản phẩm này rất tốt
        </div>
        <div class="comment-date text-secondary">
          01/01/2002
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Comment'
};
</script>

<style>
</style>