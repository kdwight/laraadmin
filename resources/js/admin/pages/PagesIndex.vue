<template>
  <div>
    test
    <router-link :to="{name: 'PageCreate'}">
      <button class="btn btn-warning">Create</button>
    </router-link>

    <router-link :to="{name: 'PageEdit'}">
      <button class="btn btn-danger">Edit</button>
    </router-link>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //
    };
  }
};
</script>

<style scoped>
/*  */
</style>