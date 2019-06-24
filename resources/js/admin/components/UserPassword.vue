<template>
  <div class="card bg-secondary shadow">
    <div class="card-header bg-white border-0">
      <div class="row align-items-center">
        <div class="col-8">
          <h3 class="mb-0">Password</h3>
        </div>
      </div>
    </div>

    <div class="card-body">
      <form
        @change="form.errors.clear($event.target.name)"
        @keydown="form.errors.clear($event.target.name)"
      >
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="username">New Password</label>
            <input
              type="text"
              class="form-control form-control-alternative"
              placeholder="Password"
              v-model="form.password"
            >

            <p
              class="text-danger"
              v-if="form.errors.has('password')"
              v-text="form.errors.get('password')"
            ></p>
          </div>

          <div class="form-group">
            <label class="form-control-label" for="type">Confirm Password</label>
            <input
              type="text"
              class="form-control form-control-alternative"
              placeholder="Confirm Password"
              v-model="form.password_confirmation"
            >
          </div>
        </div>
      </form>
    </div>

    <div class="card-footer text-right">
      <button
        class="btn btn-success btn-sm"
        @click="updatePassword"
        :disabled="form.errors.any()"
      >Submit</button>
      <button class="btn btn-danger btn-sm">Cancel</button>
    </div>
  </div>
</template>

<script>
import { Form } from "../forms";

export default {
  data() {
    return {
      form: new Form({
        password: "",
        password_confirmation: ""
      })
    };
  },

  methods: {
    updatePassword() {
      this.disabled = true;
      this.form
        .put(`/admin/update-password/${this.$route.params.id}`)
        .then(data => {
          this.$router.push({ name: "users.index" });
        });
    }
  }
};
</script>

<style>
</style>