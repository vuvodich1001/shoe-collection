<template>
  <Header />
  <main>
    <slot :key="$route.path" />
  </main>
  <Footer />
</template>

<script>
import Header from '@/components/layout/customer/Header.vue';
import Footer from '@/components/layout/customer/Footer.vue';
export default {
  name: 'DefaultLayout',
  components: { Header, Footer }
};
</script>

<style>
</style>