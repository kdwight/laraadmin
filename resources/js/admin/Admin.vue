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
      roles: []
    };
  },

  created() {
    axios.get("/admin/roles").then(({ data }) => {
      this.roles = data;
    });
  }
};
</script>

<style scoped>
/*  */
</style>