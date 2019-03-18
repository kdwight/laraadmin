<template>
  <v-alert :value="true" type="success" class="alert-flash" v-show="show">
    <strong>Success!</strong>
    {{ body }}
  </v-alert>
</template>

<script>
export default {
  props: ["message"],
  data() {
    return {
      body: "",
      show: false
    };
  },

  created() {
    if (this.message) {
      this.flash(this.message);
    }

    window.events.$on("flash", message => {
      this.flash(message);
    });
  },

  methods: {
    flash(message) {
      this.body = message;
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
</style>