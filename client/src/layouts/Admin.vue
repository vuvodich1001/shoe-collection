<template>
  <Header />
  <main class="container">
    <slot />
  </main>
</template>

<script>
import Header from '@/components/layout/admin/Header.vue';
export default {
  name: 'AdminLayout',
  components: { Header }
};
</script>

<style>
</style>