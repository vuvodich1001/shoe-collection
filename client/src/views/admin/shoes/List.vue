<template>
  <div class="list-product">
    <Modal v-show="isModal" :modal="modalMessage" @delete="deleteCar" @save="isModal=!isModal" />
    <Loading v-show="isLoading" />
    <router-link class="btn btn-primary btn-sm float-left mb-2" :to="{name: 'shoe.create'}">Create</router-link>
    <table class="table text-left">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Brand</th>
          <th scope="col">Gender</th>
          <th scope="col">Size</th>
          <th scope="col">Color</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(shoe, index) in shoes" :key="index">
          <th scope="row">{{shoe.id}}</th>
          <td>{{shoe.name}}</td>
          <td>{{shoe.brand}}</td>
          <td>{{shoe.gender}}</td>
          <td>{{shoe.size}}</td>
          <td>{{shoe.color}}</td>
          <td><button class="btn btn-sm btn-danger" @click="confirmDeleteCar(shoe.id)">Delete</button>
            <button class="ml-2 btn btn-sm btn-info" @click="updateCar(shoe.id)">
              Update</button>
          </td>
        </tr>
      </tbody>
    </table>
    <Pagination :currentPage="paginate.currentPage" :lastPage="paginate.lastPage" @click-handler="changePage" />
  </div>
</template>

<script>
import { shoeService } from '@/services';
import Modal from '@/components/ui/Modal.vue';
import Loading from '@/components/ui/Loading.vue';
import Pagination from '@/components/ui/Pagination.vue';

export default {
  name: 'ProductList',
  data() {
    return {
      shoes: [],
      isModal: false,
      isLoading: false,
      modalMessage: {
        title: 'Delete Confirm',
        body: 'Do you want to delete this shoe?'
      },
      paginate: {
        currentPage: 0,
        lastPage: 0
      }
    };
  },
  components: { Modal, Loading, Pagination },
  created() {
    this.getAllCars();
  },
  methods: {
    async getAllCars(page = 1) {
      let res = await shoeService.all('', page);
      this.shoes = res.data.shoes;
      this.paginate.lastPage = res.data.meta.lastPage;
      this.paginate.currentPage = res.data.meta.currentPage;
    },
    confirmDeleteCar(id) {
      this.modalMessage.id = id;
      this.isModal = true;
    },
    timeout(ms) {
      return new Promise((resolve) => setTimeout(resolve, ms));
    },
    async deleteCar(id) {
      this.isModal = false;
      this.isLoading = true;
      await shoeService.delete(id);
      await this.getAllCars();
      this.isLoading = false;
    },
    updateCar(id) {
      this.$router.push({ name: 'shoe.edit', params: { id } });
    },
    changePage(page) {
      if (page != 0 && page != this.lastPage + 1) this.getAllCars(page);
    }
  }
};
</script>

<style lang="scss" scoped>
table {
  vertical-align: center;
}
</style>