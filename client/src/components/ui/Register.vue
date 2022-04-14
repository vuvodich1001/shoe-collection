<template>
  <div class="d-flex justify-content-center">
    <div class="login-form border rounded mt-4">
      <h2 class="text-center my-1">Register</h2>
      <form @submit.prevent="validateForm()">
        <div class="alert alert-danger" v-for="(error, index) in errors" :key="index">{{error}}</div>
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" name="name" id="name" class="form-control" v-model="user.name">
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" name="email" id="email" class="form-control" v-model="user.email">
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" name="password" id="password" class="form-control" v-model="user.password" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="">Confirm Password</label>
          <input type="password" name="confirm-password" id="confirm-password" class="form-control" v-model="user.confirmPassword" autocomplete="off">
        </div>
        <button class="btn btn-dark w-100">Submit</button>
        <div class="form-icon text-center border-bottom p-2">
          <p>Or use a social network</p>
          <div class="h3">
            <a class="mx-1 text-dark" href=""><i class="fa-brands fa-google-plus"></i></a>
            <a class="mx-1 text-dark" href=""><i class="fab fa-facebook"></i></a>
            <a class="mx-1 text-dark" href=""><i class="fa-brands fa-github"></i></a>
          </div>
        </div>
        <div class="form-signup mt-2 text-center">
          <p>Have an account? <router-link to="/login">Sign In</router-link>
          </p>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { authService } from '@/services';
export default {
  name: 'Login',
  data() {
    return {
      user: {
        name: '',
        email: '',
        password: '',
        confirmPassword: ''
      },
      errors: []
    };
  },
  methods: {
    validateForm() {
      if (!this.user.name) {
        this.errors.push('Name is required');
      }
      if (!this.user.email) {
        this.errors.push('Email is required');
      }
      if (!this.user.password) {
        this.errors.push('Password is required');
      }
      if (this.user.confirmPassword !== this.user.password) {
        this.errors.push('Confirm password is not the same the password');
      }
      if (!this.errors.length) {
        this.register();
      }
    },
    async register() {
      await authService.register(this.user);
      this.$router.push({ name: 'login' });
    }
  }
};
</script>

<style lang="scss" scoped>
form {
  width: 400px;
  padding: 10px 30px;
}

label {
  display: block;
  float: left;
}
label::after {
  content: '*';
  color: red;
  display: inline-block;
  margin-left: 5px;
}
button {
  border-radius: 20px;
}
</style>