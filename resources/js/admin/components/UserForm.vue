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
            <form role="form">
              <div class="form-group">
                <label for="username">Username</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  placeholder="username"
                  v-model="username"
                >
              </div>

              <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" v-model="role">
                  <option value>Please select</option>
                  <option value="asd">Please select</option>
                  <option value="zxc">Please select</option>
                </select>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input
                  type="text"
                  class="form-control"
                  id="password"
                  placeholder="*********"
                  v-model="password"
                >
              </div>

              <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input
                  type="text"
                  id="confirmpassword"
                  class="form-control"
                  placeholder="*********"
                  v-model="confirm_password"
                >
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Save</button>
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
      username: "",
      role: "",
      password: "",
      confirm_password: ""
    };
  }
};
</script>

<style>
</style>