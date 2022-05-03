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
          <option v-for="(brand, index) in brands" :key="index" :value="brand.id">{{brand.name}}</option>
        </select>
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Gender</label>
        <div class="col-md-4">
          <input type="radio" name="gender" value="male" id="male" v-model.trim="shoe.gender">
          <label for="male" class="mx-2">Male</label>
          <input type="radio" name="gender" value="female" id="female" v-model.trim="shoe.gender" class="ml-2">
          <label for="female" class="mx-2">Female</label>
        </div>
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Description</label>
        <input type="text" name="description" id="description" v-model.trim="shoe.description" class="col-md-4 form-control">
      </div>
      <div v-for="(detail, index) in shoe.details" :key="index" class="form-group row">
        <label for="" class="col-md-2">Group {{index+1}}</label>
        <select name="color" id="color" v-model="detail.color" class="form-control col-md-1">
          <option value="1">black</option>
          <option value="2">white</option>
          <option value="3">blue</option>
          <option value="4">yellow</option>
          <option value="5">red</option>
        </select>
        <select name="size" id="size" class="ml-1 form-control col-md-1" v-model="detail.size" @change="checkDuplicateGroup(index)">
          <option value="1">36</option>
          <option value="2">37</option>
          <option value="3">38</option>
          <option value="4">39</option>
          <option value="5">40</option>
          <option value="6">41</option>
          <option value="7">42</option>
          <option value="8">43</option>
        </select>
        <input type="number" min="10" name="quantity" placeholder="quantity" id="quantity" v-model.trim="detail.quantity" class="ml-1 col-md-1 form-control">
        <button @click.prevent="increaseSize()" class="ml-2 btn btn-sm btn-primary">+</button>
        <button @click.prevent="decreaseSize(index)" class="ml-2 btn btn-sm btn-danger">-</button>
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Price</label>
        <input type="number" min="100000" name="price" id="price" v-model.trim="shoe.price" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <img v-for="(imageSrc, index) in imageSrcs" :key="index" :src="imageSrc" alt="image" class="col-md-2" style="height: 100px; width: 130px; object-fit:contain;">
      </div>
      <div v-for="(imageShoe, index) in shoe.images" :key="index" class="form-group row">
        <label for="" class="col-md-2">Image {{index + 1}}
          <span v-if="index==0" class="label-default">default</span>
        </label>
        <input type="file" multiple name="image" :id="index" @change="onImageChange($event, index)" class="col-md-4 form-control" hidden>
        <select name="color" id="color" v-model="imageShoe.color" class="form-control col-md-1">
          <option value="1">black</option>
          <option value="2">white</option>
          <option value="3">blue</option>
        </select>
        <label :for="index" class="mx-2 p-1 border rounded bg-dark text-light"> <i class="fa-solid fa-image"></i> Select file</label>
        <button @click.prevent="increaseImage()" class="ml-2 btn btn-sm btn-primary">+</button>
        <button @click.prevent="decreaseImage(index)" class="ml-2 btn btn-sm btn-danger">-</button>
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
import { brandService } from '@/services';
export default {
  name: 'ProductForm',
  data() {
    return {
      errors: [],
      brands: [],
      shoe: {
        name: '',
        brand: 0,
        category: 0,
        gender: '',
        description: '',
        color: 0,
        details: [
          {
            color: 0,
            size: 0,
            quantity: 0
          }
        ],
        price: 0,
        images: [
          {
            image: '',
            color: 0
          }
        ]
      },
      imageSrcs: []
    };
  },
  created() {
    let id = this.$route.params.id;
    if (id) {
      this.getShoeById(id);
    }
    this.getAllBrands();
    // this.initValue();
  },
  methods: {
    onImageChange(e, index) {
      console.log(index, e.target.files);
      this.shoe.images[index].image = e.target.files;
      // this.imageSrc = URL.createObjectURL(this.shoe.image);
      Array.from(e.target.files).forEach((imageUrl) => {
        this.imageSrcs.push(URL.createObjectURL(imageUrl));
      });
    },
    validateForm() {
      this.errors = [];
      if (!this.shoe.name) {
        this.errors.push('Name is required!');
      }
      if (!this.shoe.brand) {
        this.errors.push('Brand is required!');
      }

      this.filterEmptySize();
      let formData = new FormData();
      for (const [key, value] of Object.entries(this.shoe)) {
        if (key == 'details') {
          formData.append(key, JSON.stringify(value));
        } else if (key == 'images') {
          this.shoe.images.forEach((imageItem) => {
            if (imageItem.image.length > 1) {
              Array.from(imageItem.image).forEach((value) => {
                formData.append('images[]', value);
                formData.append('colors[]', imageItem.color);
              });
            } else {
              formData.append('images[]', imageItem.image);
              formData.append('colors[]', imageItem.color);
            }
          });
        } else formData.append(key, value);
      }
      console.log(this.shoe);
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
      this.$router.push({ name: 'shoe.index' });
    },
    async updateShoe(id) {
      await shoeService.update(id, this.shoe);
      this.$router.push({ name: 'shoe.index' });
    },
    async getShoeById(id) {
      let res = await shoeService.findShoe(id);
      this.shoe = res.data.shoe;
      this.shoe.images = [
        {
          image: '',
          color: 0
        }
      ];
      console.log(this.shoe);
    },
    async getAllBrands() {
      let res = await brandService.all();
      this.brands = res.data.brands;
    },
    increaseSize() {
      this.shoe.details.push({
        color: '',
        size: 0,
        quantity: 0
      });
    },
    decreaseSize(index) {
      if (this.shoe.details.length > 1)
        this.shoe.details = this.shoe.details.filter((v, i) => {
          return i != index;
        });
    },
    filterEmptySize() {
      this.shoe.details = this.shoe.details.filter((value) => {
        return value.size && value.quantity;
      });
    },
    decreaseImage(index) {
      if (this.shoe.images.length > 1)
        this.shoe.images = this.shoe.images.filter((v, i) => {
          return i != index;
        });
    },
    increaseImage() {
      this.shoe.images.push({
        image: '',
        color: 0
      });
    },
    checkDuplicateGroup(index) {
      let size = this.shoe.details[index].size;
      let color = this.shoe.details[index].color;
      console.log(size, color);
      let check = this.shoe.details.reduce((acc, value) => {
        return value.size == size && value.color == color ? acc + 1 : acc;
      }, 0);
      if (check > 1) {
        alert('Color and size are ready existed !!!');
        this.shoe.details[index].size = 0;
      }
    },
    initValue() {
      this.shoe = {
        name: 'suppertstars',
        brand: 2,
        category: 1,
        gender: 'male',
        description: 'giay nay rat dep',
        color: 2,
        details: [
          {
            color: 1,
            size: 1,
            quantity: 15
          },
          {
            color: 1,
            size: 2,
            quantity: 75
          },
          {
            color: 1,
            size: 3,
            quantity: 36
          },
          {
            color: 1,
            size: 3,
            quantity: 36
          }
        ],
        price: 200000,
        images: [
          {
            image: '',
            color: 0
          }
        ]
      };
    }
  }
};
</script>

<style lang="scss" scoped>
.label-default {
  padding: 2px;
  background-color: var(--success);
  color: var(--white-color);
  border-radius: 4px;
  font-size: 11px;
  position: relative;
  top: -10px;
}
</style>