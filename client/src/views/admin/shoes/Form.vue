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
        <label for="" class="col-md-2">Color</label>
        <select name="color" id="color" v-model="shoe.color" class="form-control col-md-1">
          <option value="1">black</option>
          <option value="2">white</option>
          <option value="3">blue</option>
        </select>
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Category</label>
        <select name="brand" id="brand" v-model="shoe.category" class="form-control col-md-1">
          <option value="1">sport</option>
          <option value="2">football</option>
          <option value="3">fashionable</option>
        </select>
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Brand</label>
        <select name="brand" id="brand" v-model="shoe.brand" class="form-control col-md-1">
          <option value="1">nike</option>
          <option value="2">adidas</option>
          <option value="3">vans</option>
        </select>
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Gender</label>
        <input type="text" name="gender" id="gender" v-model.trim="shoe.gender" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Description</label>
        <input type="text" name="description" id="description" v-model.trim="shoe.description" class="col-md-4 form-control">
      </div>
      <div v-for="(detail, index) in shoe.detail" :key="index" class="form-group">
        <div class="row" v-if="index <= sizeNum">
          <label for="" class="col-md-2">Size {{index+1}}</label>
          <select name="size" id="size" class="form-control col-md-1" v-model="detail.size">
            <option value="1">36</option>
            <option value="2">37</option>
            <option value="3">38</option>
            <option value="4">39</option>
            <option value="5">40</option>
            <option value="6">41</option>
            <option value="7">42</option>
            <option value="8">43</option>
          </select>
          <input type="number" min="10" name="quantity" placeholder="quantity" id="quantity" v-model.trim="detail.quantity" class="ml-1 col-md-2 form-control">
          <button @click.prevent="sizeNum++" class="ml-2 btn btn-sm btn-primary">+</button>
          <button @click.prevent="decreaseSize(index)" class="ml-2 btn btn-sm btn-danger">-</button>
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Price</label>
        <input type="number" min="100000" name="price" id="price" v-model.trim="shoe.price" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Image</label>
        <input type="file" multiple name="image" id="image" @change="onImageChange" class="col-md-4 form-control" hidden>
        <label for="image" class="p-1 border rounded bg-dark text-light"> <i class="fa-solid fa-image"></i> Select file</label>
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
// import FormSize from '@/components/ui/FormSize.vue';
export default {
  name: 'ProductForm',
  data() {
    return {
      errors: [],
      shoe: {
        name: '',
        brand: '',
        category: '',
        gender: '',
        description: '',
        color: '',
        detail: [
          {
            color: '',
            size: 0,
            quantity: 0
          },
          {
            color: '',
            size: 0,
            quantity: 0
          },
          {
            color: '',
            size: 0,
            quantity: 0
          },
          {
            color: '',
            size: 0,
            quantity: 0
          }
        ],
        price: 0,
        image: ''
      },
      sizeNum: 0
    };
  },
  created() {
    let id = this.$route.params.id;
    if (id) {
      this.getShoeById(id);
    }
    this.initValue();
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

      this.filterEmptySize();
      let formData = new FormData();
      for (const [key, value] of Object.entries(this.shoe)) {
        if (key == 'detail') {
          // value.forEach((v) => {
          //   console.log(v);
          //   formData.append(`${key}[]`, v);
          // });
          formData.append(key, JSON.stringify(value));
        } else formData.append(key, value);
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
      let res = await shoeService.create(formData);
      console.log(res.data);
      // this.$router.push({ name: 'shoe.index' });
    },
    async updateShoe(id) {
      await shoeService.update(id, this.shoe);
      this.$router.push({ name: 'shoe.index' });
    },
    async getShoeById(id) {
      let res = await shoeService.find(id);
      this.shoe = res.data.shoe;
      console.log(this.shoe);
    },
    decreaseSize(index) {
      this.shoe.detail = this.shoe.detail.map((value, i) => {
        if (i == index) {
          value.size = 0;
          value.quantity = 0;
        }
        return value;
      });
      this.sizeNum--;
    },
    filterEmptySize() {
      this.shoe.detail = this.shoe.detail.filter((value) => {
        return value.size && value.quantity;
      });
    },
    initValue() {
      this.shoe = {
        name: 'suppertstars',
        brand: '2',
        category: '1',
        gender: 'male',
        description: 'giay nay rat dep',
        color: '2',
        detail: [
          {
            color: 'white',
            size: '1',
            quantity: '15'
          },
          {
            color: 'white',
            size: '2',
            quantity: '75'
          },
          {
            color: 'white',
            size: '3',
            quantity: '36'
          },
          {
            color: 'white',
            size: 0,
            quantity: '36'
          }
        ],
        price: '200000',
        image: {}
      };
    }
  },
  watch: {
    'shoe.color'() {
      this.shoe.detail = this.shoe.detail.map((value) => {
        value.color = this.shoe.color;
        return value;
      });
    }
  }
};
</script>

<style>
</style>