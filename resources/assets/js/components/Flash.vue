<template>
  <transition name="slide-fade">
    <v-alert :value="true" :type="`${level}`" class="alert-flash" v-show="show">
      <strong>Success!</strong>
      {{ body }}
    </v-alert>
  </transition>
</template>

<script>
export default {
  props: ["message"],
  data() {
    return {
      body: "",
      level: "success",
      show: false
    };
  },

  created() {
    if (this.message) {
      this.flash(this.message);
    }

    window.events.$on("flash", data => {
      this.flash(data);
    });
  },

  methods: {
    flash(data) {
      this.body = data.message;
      this.level = data.level;
      this.show = true;
      this.hide();
    },
    hide() {
      setTimeout(() => {
        this.show = false;
      }, 3000);
    }
  }
};
</script>

<style>
.alert-flash {
  position: fixed;
  right: 25px;
  bottom: 50px;
  z-index: 1;
}

.slide-fade-enter-active {
  transition: all 0.3s ease;
}
.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter,
.slide-fade-leave-to {
  transform: translateX(10px);
  opacity: 0;
}
</style>