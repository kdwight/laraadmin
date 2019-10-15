<template>
  <button
    :class="classes"
    data-toggle="tooltip"
    data-placement="left"
    title="Status"
    @click="toggle"
  >
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
        "btn btn-icon btn-sm",
        this.active ? "btn-primary" : "btn-outline-primary"
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
        .put(this.endpoint, {
          status: false
        })
        .then(({ data }) => {
          this.active = false;
          flash(data.success);
        });
    },

    create() {
      axios
        .put(this.endpoint, {
          status: true
        })
        .then(({ data }) => {
          this.active = true;
          flash(data.success);
        });
    }
  }
};
</script>