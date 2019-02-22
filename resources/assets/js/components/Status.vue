<template>
  <button :class="classes" @click="toggle">
    <i :class="icon"></i>
  </button>
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
      return [
        "btn btn-icons btn-rounded",
        this.active ? "btn-primary" : " btn-outline-primary"
      ];
    },

    icon() {
      return ["fa", this.active ? "fa-check" : "fa-times"];
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