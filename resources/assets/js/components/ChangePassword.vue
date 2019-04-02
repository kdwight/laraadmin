<script>
export default {
  data() {
    return {
      disabled: false,
      oldPassword: "",
      password: "",
      confirmPassword: "",
      errors: {}
    };
  },

  methods: {
    enable() {
      return (this.disabled = false);
    },

    changePassword() {
      this.disabled = true;
      const data = {
        old_password: this.oldPassword,
        password: this.password,
        password_confirmation: this.confirmPassword
      };

      axios
        .patch(`/users/${window.App.user.id}/change-password`, data)
        .then(response => {
          flash(response.data);
          setTimeout(function() {
            window.location.replace(window.App.previousURL);
          }, 1500);
        })
        .catch(error => {
          if (error.response.data.errors) {
            this.errors = error.response.data.errors;
          } else {
            this.errors = error.response.data;
          }
        });
    }
  }
};
</script>

<style>
</style>