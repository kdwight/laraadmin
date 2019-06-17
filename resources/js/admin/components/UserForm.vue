<template>
  <div>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#userForm">
      <i class="fas fa-user-plus"></i> Create User
    </button>

    <div
      class="modal fade"
      id="userForm"
      tabindex="-1"
      role="dialog"
      aria-labelledby="userFormLabel"
      aria-hidden="true"
      data-backdrop="static"
      data-keyboard="false"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="userFormLabel">User Form</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <form
              role="form"
              @change="form.errors.clear($event.target.name)"
              @keydown="form.errors.clear($event.target.name)"
            >
              <div class="form-group">
                <label for="username">Username</label>
                <input
                  type="text"
                  name="username"
                  class="form-control"
                  placeholder="username"
                  v-model="form.username"
                >

                <p
                  class="text-danger"
                  v-if="form.errors.has('username')"
                  v-text="form.errors.get('username')"
                ></p>
              </div>

              <div class="form-group">
                <label for="role">Role</label>
                <select name="type" class="form-control" v-model="form.type">
                  <option value>Please select</option>
                  <option
                    :value="role.name"
                    v-for="(role, index) in roles"
                    :key="index"
                    v-text="role.description"
                  ></option>
                </select>

                <p
                  class="text-danger"
                  v-if="form.errors.has('type')"
                  v-text="form.errors.get('type')"
                ></p>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="*********"
                  v-model="form.password"
                >

                <p
                  class="text-danger"
                  v-if="form.errors.has('password')"
                  v-text="form.errors.get('password')"
                ></p>
              </div>

              <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input
                  type="password"
                  name="password_confirmation"
                  class="form-control"
                  placeholder="*********"
                  v-model="form.password_confirmation"
                >
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button
              type="button"
              class="btn btn-primary"
              @click="createUser"
              :disabled="form.errors.any()"
            >Save</button>
          </div>
        </div>
      </div>
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
        type: "",
        password: "",
        password_confirmation: ""
      }),

      roles: window.App.roles
    };
  },

  methods: {
    createUser() {
      this.disabled = true;
      this.form.post("/admin/users").then(data => {
        $("#userForm").modal("hide");
        flash(data);
        fetchData();
      });
    }
  }
};
</script>

<style>
</style>