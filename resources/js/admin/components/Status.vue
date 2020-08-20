<template>
  <div>
    <v-switch v-model="active" :color="color" :loading="loading"></v-switch>
  </div>
</template>

<script>
export default {
  props: ["attributes", "endpoint"],
  data() {
    return {
      active: this.attributes.status,
      loading: false,
    };
  },

  computed: {
    color() {
      return this.active ? "green" : "";
    },
  },

  watch: {
    active(value) {
      this.loading = true;
      value ? this.destroy(value) : this.create(value);
    },
  },

  methods: {
    destroy(status) {
      axios
        .put(this.endpoint, {
          status,
        })
        .then(({ data }) => {
          this.loading = false;
          flash(data.success, "warning");
        })
        .catch(({ response }) =>
          flash("Something went wrong. Please try again.", "error")
        );
    },

    create(status) {
      axios
        .put(this.endpoint, {
          status,
        })
        .then(({ data }) => {
          this.loading = false;
          flash(data.success, "warning");
        })
        .catch(({ response }) =>
          flash("Something went wrong. Please try again.", "error")
        );
    },
  },
};
</script>