<script>
export default {
  props: ["attributes"],
  data() {
    return {
      disabled: false,
      username: "",
      type: "",
      password: "",
      confirmPassword: "",
      errors: {},

      items: []
    };
  },

  computed: {
    isEdit() {
      if (this.attributes) {
        this.username = this.attributes.username;
        this.type = this.attributes.type;
      }
    },

    userRoles() {
      this.items = window.Roles.roles;
    }
  },

  created() {
    this.isEdit;
    this.userRoles;
  },

  methods: {
    enable() {
      return (this.disabled = false);
    },

    createUser() {
      this.disabled = true;
      const data = {
        username: this.username,
        type: this.type,
        password: this.password,
        password_confirmation: this.confirmPassword
      };

      axios
        .post("/users", data)
        .then(response => {
          this.username = "";
          this.type = "";
          this.password = "";
          this.confirmPassword = "";
          flash(response.data);
          setTimeout(function() {
            window.location.replace("/users");
          }, 1500);
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },

    updateUser() {
      this.disabled = true;
      const data = {
        username: this.username,
        type: this.type,
        password: this.password,
        password_confirmation: this.confirmPassword
      };

      axios
        .patch(`/users/${this.attributes.id}`, data)
        .then(response => {
          flash(response.data);
          setTimeout(() => {
            window.location.replace("/users");
          }, 1500);
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    }
  }
};
</script>