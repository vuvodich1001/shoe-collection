<template>
  <div class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{modal.title}}</h5>
          <button type="button" class="close" @click="$emit('save')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>{{modal.body}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" @click="this.$emit('delete', modal.id)">Yes</button>
          <button type="button" class="btn btn-secondary" @click="this.$emit('save')">No</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Modal',
  props: {
    modal: Object
  }
};
</script>

<style scoped lang="scss">
.modal {
  display: block;
  background-color: rgba(0, 0, 0, 0.6);
}
</style>