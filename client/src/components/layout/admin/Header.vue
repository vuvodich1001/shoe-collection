<template>
  <nav class="container mb-2">
    <!-- <h3 class="pl-2 text-left" v-if="user" @click.prevent="">{{user.user.name}}</h3> -->
  </nav>
  <nav class="container d-flex justify-content-between h3">
    <div class="navbar-left">
      <router-link class="mx-2" to="/admin/user">User</router-link>
      <router-link class="mx-2" to="/admin/shoe">Shoe</router-link>
    </div>
    <div class="navbar-right">
      <router-link class="mx-2" :to="{name: 'login'}">Login</router-link>
      <router-link class="mx-2" :to="{name: 'register'}">Signup</router-link>
      <a v-if="user" class="mx-2" href="/logout" @click.prevent="logout()">Logout</a>
    </div>
  </nav>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: 'Navbar',
  computed: {
    ...mapState(['user'])
  },
  methods: {
    logout() {
      localStorage.removeItem('token');
      this.$store.state.user = null;
      this.$router.push({ name: 'Login' });
    }
  }
};
</script>

<style scoped>
</style>