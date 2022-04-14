<template>
  <component :is="layout">
    <router-view />
  </component>
</template>

<script>
import DefaultLayout from '@/layouts/Default.vue';
import AdminLayout from '@/layouts/Admin.vue';
export default {
  name: 'App',
  components: { DefaultLayout, AdminLayout },
  computed: {
    layout() {
      return (this.$route.meta.layout || 'Default') + 'Layout';
    }
  }
};
</script>

<style lang="scss">
</style>
