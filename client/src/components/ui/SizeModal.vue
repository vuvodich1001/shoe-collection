<template>
  <div class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Bảng quy chuẩn size quốc tế</h5>
          <button type="button" class="close" @click="closeSizeModal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="h5">
            <li class="mt-2">1m60 -> size M</li>
            <li class="mt-2">1m70 -> size L</li>
            <li class="mt-2">1m80 -> size XL hoặc XXL</li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="closeSizeModal()">Close</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  name: 'SizeModal',
  methods: {
    closeSizeModal() {
      this.$emit('close-modal');
    }
  }
};
</script>

<style lang="scss" scoped>
.modal {
  display: block;
  background-color: rgba(0, 0, 0, 0.6);
}
</style>