<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  props: ["attributes"],

  data() {
    return {
      users: this.attributes
    };
  }
};
</script>

<style scoped>
/*  */
</style>