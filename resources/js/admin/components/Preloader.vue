<template>
  <div class="loading" v-if="$parent.loading">
    <div>
      <img src="/img/logo.png" alt />
    </div>
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
.loading {
  z-index: 9999;
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(000, 000, 000, 0.6);
}

.loading > div {
  position: sticky;
  top: 30vh;
  text-align: center;
}

.loading img {
  animation: blink 1.5s infinite;
}

@keyframes blink {
  0%,
  100% {
    transform: scale(1, 0.5);
  }
  10%,
  80% {
    transform: scale(1, 1);
  }
}
</style>