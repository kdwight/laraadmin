<template>
  <v-tooltip left>
    <template v-slot:activator="{ on }">
      <v-btn color="primary" :outline="classes" fab small dark @click="toggle" v-on="on">
        <v-icon>{{ icon }}</v-icon>
      </v-btn>
    </template>
    <span>Status</span>
  </v-tooltip>
</template>

<script>
export default {
  props: ["attributes", "endpoint"],
  data() {
    return {
      active: this.attributes.status
    };
  },

  computed: {
    classes() {
      return this.active ? false : true;
    },

    icon() {
      return this.active ? "check" : "close";
    }
  },

  methods: {
    toggle() {
      this.active ? this.destroy() : this.create();
    },

    destroy() {
      axios
        .patch(this.endpoint, {
          status: false
        })
        .then(({ data }) => {
          this.active = false;

          flash(data);
        });
    },

    create() {
      axios
        .patch(this.endpoint, {
          status: true
        })
        .then(({ data }) => {
          this.active = true;

          flash(data);
        });
    }
  }
};
</script>

<style>
</style>