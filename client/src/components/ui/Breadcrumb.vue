<template>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb mt-3">
      <li :class="['breadcrumb-item', index == breads.length - 1 ? 'active' : '']" v-for="(bread, index) in breads" :key="index">
        <router-link class="text-dark" :to="{name: bread.toLowerCase()}" v-if="index < breads.length - 1">{{bread}}</router-link>
        <span v-else>{{bread}}</span>
      </li>
    </ol>
  </nav>
</template>

<script>
export default {
  name: 'Breadcrumb',
  props: ['breads']
};
</script>

<style>
</style>