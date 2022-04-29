<template>
  <div class="form-user">
    <div v-if="errors" class="notification">
      <div v-for="(error, index) in errors" :key="index" class="alert alert-danger">{{error}}</div>
    </div>
    <form @submit.prevent="validateForm()">
      <div class="form-group row">
        <label for="" class="col-md-2">UserName</label>
        <input type="text" name="name" id="name" v-model.trim="user.name" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Email</label>
        <input type="text" name="email" id="email" v-model.trim="user.email" class="col-md-4 form-control">
      </div>
      <div class="form-group row">
        <label for="" class="col-md-2">Password</label>
        <input type="password" name="password" id="password" v-model.trim="user.password" class="col-md-4 form-control" autocomplete="off">
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
import { userService } from '@/services';
export default {
  name: 'UserForm',
  data() {
    return {
      errors: [],
      user: {
        name: '',
        email: '',
        password: ''
      }
    };
  },
  created() {
    let userId = this.$route.params.id;
    if (userId) {
      this.getUserById(userId);
    }
  },
  methods: {
    validateForm() {
      this.errors = [];
      if (!this.user.name) {
        this.errors.push('UserName is required!');
      }
      if (!this.user.email) {
        this.errors.push('You must type email!');
      }
      if (!this.user.password) {
        this.errors.push('Password is required!');
      }

      if (!this.errors.length) {
        let userId = this.$route.params.id;
        if (userId) {
          this.updateUser(userId);
        } else {
          this.storeUser();
        }
      }
    },
    async storeUser() {
      await userService.create(this.user);
      this.$router.push({ name: 'user.index' });
    },
    async updateUser(id) {
      await userService.update(id, this.user);
      this.$router.push({ name: 'user.index' });
    },
    async getUserById(id) {
      let res = await userService.find(id);
      this.user.name = res.data.name;
      this.user.email = res.data.email;
      this.user.password = res.data.password;
    }
  }
};
</script>

<style>
</style>