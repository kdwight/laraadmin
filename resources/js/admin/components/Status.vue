<template>
  <div>
    <v-switch v-model="active" :color="color" @click.prevent="toggle"></v-switch>
  </div>
</template>

<script>
export default {
  props: ["attributes", "endpoint"],
  data() {
    return {
      active: this.attributes.status,
    };
  },

  computed: {
    color() {
      return this.active ? "green" : "red";
    },
  },

  methods: {
    toggle() {
      this.active ? this.destroy() : this.create();
    },

    destroy() {
      axios
        .put(this.endpoint, {
          status: false,
        })
        .then(({ data }) => {
          this.active = false;
          flash(data.success, "warning");
        });
    },

    create() {
      axios
        .put(this.endpoint, {
          status: true,
        })
        .then(({ data }) => {
          this.active = true;
          flash(data.success, "warning");
        });
    },
  },
};
</script>