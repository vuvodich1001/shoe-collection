<template>
  <div class="container">
    <div class="d-flex justify-content-center">
      <div class="login-form border rounded mt-4">
        <h2 class="text-center my-1">Login</h2>
        <form @submit.prevent="login()">
          <div class=" alert alert-danger" v-show="isLoginFail">Login failed
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" id="email" class="form-control" v-model="user.email">
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" id="password" class="form-control" v-model="user.password" autocomplete="off" @keyup.enter="login()">
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
            <p>Not a member yet? <router-link to="/register">Sign up</router-link>
            </p>
          </div>
        </form>
      </div>
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
        email: '',
        password: ''
      },
      isLoginFail: false
    };
  },
  methods: {
    async login() {
      let res = await authService.login(this.user);
      if (res.data.user) {
        localStorage.setItem('token', res.data.access_token);
        this.$store.dispatch('login', res.data.user);
        this.$router.push({ name: 'home' });
      } else {
        this.isLoginFail = true;
      }
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