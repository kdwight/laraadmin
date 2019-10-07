<template>
  <h1 class="loading" v-if="$parent.loading">
    <img src="/img/preloader.svg" />
  </h1>
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
.loading {
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -50px 0px 0px -50px;
}
</style>