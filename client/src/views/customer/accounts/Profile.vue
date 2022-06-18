<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <Breadcrumb :breads="['Home', 'Account']" />
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3">
        <div class="d-flex justify-content-center">
          <div class="bg-dark text-light p-5 text-center w-50 rounded-circle">
            VN
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <form>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="first-name">FirstName</label>
              <input type="text" class="form-control" id="first-name" value="Nguyen">
            </div>
            <div class="form-group col-md-6">
              <label for="last-name">LastName</label>
              <input type="text" class="form-control" id="last-name" value="Vu">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" value="vunguyen@gmail.com">
            </div>
            <div class="form-group col-md-4">
              <label for="phone">Phone</label>
              <input type="text" class="form-control" id="phone" value="0912345678">
            </div>
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" value="5/57, duong so 8">
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="ward">Ward</label>
              <input type="ward" class="form-control" id="ward" value="Long truong">
            </div>
            <div class="form-group col-md-4">
              <label for="district">District</label>
              <input type="district" class="form-control" id="district" value="Quan 9">
            </div>
            <div class="form-group col-md-4">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" value="TPHCM">
            </div>
          </div>
          <button class="btn btn-outline-primary">Cập nhật</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from '@/components/ui/Breadcrumb.vue';
export default {
  name: 'Profile',
  components: { Breadcrumb }
};
</script>
<style>
</style>