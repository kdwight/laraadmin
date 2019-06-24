<template>
  <div class="card bg-secondary shadow">
    <div class="card-header bg-white border-0">
      <div class="row align-items-center">
        <div class="col-8">
          <h3 class="mb-0">My account</h3>
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
            <label class="form-control-label" for="username">Username</label>
            <input
              type="text"
              class="form-control form-control-alternative"
              v-model="form.username"
            >

            <p
              class="text-danger"
              v-if="form.errors.has('username')"
              v-text="form.errors.get('username')"
            ></p>
          </div>

          <div class="form-group">
            <label class="form-control-label" for="type">Role</label>
            <select
              name="type"
              class="form-control form-control-alternative"
              v-model="form.type"
              @change="form.errors.clear($event.target.name)"
            >
              <option value>Please select</option>
              <option
                :value="role.name"
                v-for="(role, index) in roles"
                :key="index"
                v-text="role.description"
              ></option>
            </select>

            <p class="text-danger" v-if="form.errors.has('type')" v-text="form.errors.get('type')"></p>
          </div>
        </div>
      </form>
    </div>

    <div class="card-footer text-right">
      <button
        class="btn btn-success btn-sm"
        @click="updateUser"
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
        username: "",
        type: ""
      }),
      roles: window.App.roles
    };
  },

  created() {
    axios
      .get(`/admin/API/${this.$route.params.id}/user-edit`)
      .then(({ data }) => {
        this.form.username = data.username;
        this.form.type = data.type;
      });
  },

  methods: {
    updateUser() {
      this.disabled = true;
      this.form.put(`/admin/users/${this.$route.params.id}`).then(data => {
        this.$router.push({ name: "users.index" });
      });
    }
  }
};
</script>

<style>
</style>