<template>
  <v-snackbar :color="color" v-model="status" :timeout="timeout" top right>
    {{ message }}
    <template v-slot:action="{ attrs }">
      <v-btn text v-bind="attrs" @click="status = false">Close</v-btn>
    </template>
  </v-snackbar>
</template>

<script>
export default {
  data() {
    return {
      status: false,
      color: "success",
      message: "",
      timeout: 3000
    };
  },

  created() {
    window.events.$on("flash", data => {
      this.flash(data.message, data.color);
    });
  },

  methods: {
    flash(message, color) {
      this.message = message;
      this.color = color;
      this.status = true;
    }
  }
};
</script>