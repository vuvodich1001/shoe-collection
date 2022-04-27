<template>
  <div class="form-group row">
    <label for="" class="col-md-2">Size</label>
    <select name="size-1" id="" class="form-control col-md-1">
      <option value="39">39</option>
      <option value="40">40</option>
      <option value="41">41</option>
      <option value="42">42</option>
    </select>
    <input type="number" min="36" name="quantity" placeholder="quantity" id="quantity" v-model.trim="size" class="ml-1 col-md-2 form-control">
    <button class="ml-1 form-control col-md-1">+</button>
  </div>
</template>

<script>
export default {
  name: 'FormSize',
  data() {
    return {
      size: ''
    };
  },
  methods: {}
};
</script>