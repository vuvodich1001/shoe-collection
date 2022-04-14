<template>
  <div class="list-user">
    <Modal v-show="isModal" :modal="modalMessage" @delete="deleteUser" @save="isModal=!isModal" />
    <Loading v-show="isLoading" />
    <router-link class="btn btn-primary btn-sm float-left mb-2" :to="{name: 'user.create'}">Create</router-link>
    <table class="table text-left">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">UserName</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in users" :key="index">
          <th scope="row">{{user.id}}</th>
          <td>{{user.name}}</td>
          <td>{{user.email}}</td>
          <td><button class="btn btn-sm btn-danger" @click="confirmDeleteUser(user.id)">Delete</button>
            <button class="ml-2 btn btn-sm btn-info" @click="updateUser(user.id)">
              Update</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { userService } from '@/services';
import Modal from '@/components/ui/Modal.vue';
import Loading from '@/components/ui/Loading.vue';

export default {
  name: 'UserList',
  data() {
    return {
      users: [],
      isModal: false,
      isLoading: false,
      modalMessage: {
        title: 'Delete Confirm',
        body: 'Do you want to delete this user?'
      }
    };
  },
  components: { Modal, Loading },
  created() {
    this.getAllUsers();
  },
  methods: {
    async getAllUsers() {
      let res = await userService.all();
      this.users = res.data;
    },
    confirmDeleteUser(id) {
      this.modalMessage.id = id;
      this.isModal = true;
    },
    timeout(ms) {
      return new Promise((resolve) => setTimeout(resolve, ms));
    },
    async deleteUser(id) {
      this.isModal = false;
      this.isLoading = true;
      await userService.delete(id);
      await this.getAllUsers();
      this.isLoading = false;
    },
    updateUser(id) {
      this.$router.push({ name: 'user.edit', params: { id } });
    }
  }
};
</script>

<style lang="scss" scoped>
table {
  vertical-align: center;
}
</style>