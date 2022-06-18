<template>
  <nav>
    <ul class="pagination">
      <li class="page-item mx-1">
        <a class="page-link rounded-circle border-0" href="#" tabindex="-1" @click.prevent="changePage(currentPage - 1)"><i class=" fas fa-angle-left"></i></a>
      </li>
      <li class="page-item mx-1" v-for="n in lastPage" :key="n" :class="[n==currentPage ? 'active' : '']">
        <a class="page-link rounded-circle border-0" href="#" @click.prevent="changePage(n)">{{n}}</a>
      </li>
      <li class="page-item mx-1">
        <a class="page-link rounded-circle border-0" href="#" @click.prevent="changePage(currentPage + 1)"><i class="fas fa-angle-right"></i></a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: 'Pagination',
  props: ['currentPage', 'lastPage'],
  methods: {
    changePage(n) {
      this.$emit('click-handler', n);
    }
  }
};
</script>

<style lang="scss" scoped>
.page-link {
  background: var(--white-color);
  color: var(--black-color);
}
.page-item.active {
  .page-link {
    background: var(--black-color);
    color: var(--white-color);
  }
}
</style>