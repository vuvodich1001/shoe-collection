<template>
  <div class="form-product">
    <router-link to="/admin/shoe" class="btn btn-sm btn-warning my-2">Back to form</router-link>
    <div v-if="errors" class="notification">
      <div v-for="(error, index) in errors" :key="index" class="alert alert-danger">{{error}}</div>
    </div>
    <form @submit.prevent="validateForm()" enctype="multipart/form-data">
      <div class=" form-group row">
        <label for="" class="col-md-2">Name</label>
        <input type="text" name="name" id="name" v-model.trim="shoe.name" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Brand</label>
        <input type="text" name="brand" id="brand" v-model.trim="shoe.brand" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Gender</label>
        <input type="text" name="gender" id="gender" v-model.trim="shoe.gender" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Size</label>
        <input type="number" min="36" name="size" id="size" v-model.trim="shoe.size" class="col-md-1 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Color</label>
        <input type="text" name="color" id="color" v-model.trim="shoe.color" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Price</label>
        <input type="number" min="10000" name="price" id="price" v-model.trim="shoe.price" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Image</label>
        <input type="file" name="image" id="image" @change="onImageChange" class="col-md-4 form-control" hidden>
        <label for="image" class="p-1 border rounded">Chon file</label>
      </div>
      <div class="form-group row">
        <button class="offset-md-2 btn btn-info btn-sm">
          Submit
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { shoeService } from '@/services';
export default {
  name: 'ProductForm',
  data() {
    return {
      errors: [],
      shoe: {
        name: '',
        brand: '',
        gender: '',
        size: 0,
        color: '',
        price: 0,
        image: ''
      }
    };
  },
  created() {
    let id = this.$route.params.id;
    if (id) {
      this.getShoeById(id);
    }
  },
  methods: {
    onImageChange(e) {
      this.shoe.image = e.target.files[0];
    },
    validateForm() {
      this.errors = [];
      // if (!this.shoe.name) {
      //   this.errors.push('Name is required!');
      // }
      // if (!this.shoe.company) {
      //   this.errors.push('Country is required!');
      // }
      let formData = new FormData();

      for (const [key, value] of Object.entries(this.shoe)) {
        formData.append(key, value);
      }

      if (!this.errors.length) {
        let id = this.$route.params.id;
        if (id) {
          this.updateShoe(id);
        } else {
          this.storeShoe(formData);
        }
      }
    },
    async storeShoe(formData) {
      await shoeService.create(formData);
      this.$router.push({ name: 'shoe.index' });
    },
    async updateShoe(id) {
      await shoeService.update(id, this.shoe);
      this.$router.push({ name: 'shoe.index' });
    },
    async getShoeById(id) {
      let res = await shoeService.find(id);
      this.shoe = res.data.shoe;
    }
  }
};
</script>

<style>
</style>