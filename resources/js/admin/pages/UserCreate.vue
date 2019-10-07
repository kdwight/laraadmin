<template>
  <div>
    <div class="row">
      <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">User Create</h3>
              </div>

              <div class="col-4 text-right">
                <router-link :to="{ name: 'UsersIndex' }">
                  <button class="btn btn-primary btn-sm">Back to list</button>
                </router-link>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form autocomplete="off">
              <h6 class="heading-small text-muted mb-4">User Information</h6>

              <div class="pl-lg-4">
                <div :class="`form-group ${form.errors.username ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-username">
                    <span class="text-danger">*</span> Username
                  </label>

                  <input
                    type="text"
                    name="username"
                    id="input-username"
                    :class="`form-control form-control-alternative ${ form.errors.username ? ' is-invalid' : '' }`"
                    placeholder="Username"
                    autofocus
                    v-model="form.username"
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.username">
                    <strong>{{ form.errors.username[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group ${form.errors.name ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-name">
                    <span class="text-danger">*</span> Name
                  </label>

                  <input
                    type="text"
                    name="name"
                    id="input-name"
                    :class="`form-control form-control-alternative ${ form.errors.name ? ' is-invalid' : '' }`"
                    placeholder="Name"
                    v-model="form.name"
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.name">
                    <strong>{{ form.errors.name[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group ${form.errors.email ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-email">
                    <span class="text-danger">*</span> Email
                  </label>

                  <input
                    type="email"
                    name="email"
                    id="input-email"
                    :class="`form-control form-control-alternative ${ form.errors.email ? ' is-invalid' : '' }`"
                    placeholder="Email"
                    v-model="form.email"
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.email">
                    <strong>{{ form.errors.email[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group ${form.errors.role ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-role">
                    <span class="text-danger">*</span> Role
                  </label>

                  <select
                    name="role"
                    id="input-role"
                    :class="`form-control form-control-alternative ${ form.errors.role_id ? ' is-invalid' : '' }`"
                    v-model="form.role_id"
                  >
                    <option :value="null">Please select</option>

                    <option
                      v-for="role in $parent.roles"
                      :key="role.id"
                      :value="role.id"
                    >{{ role.description }}</option>
                  </select>

                  <span class="invalid-feedback" role="alert" v-if="form.errors.role_id">
                    <strong>{{ form.errors.role_id[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group ${form.errors.password ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-password">
                    <span class="text-danger">*</span> Password
                  </label>

                  <input
                    type="password"
                    name="password"
                    id="input-password"
                    :class="`form-control form-control-alternative ${ form.errors.password ? ' is-invalid' : '' }`"
                    placeholder="Password"
                    v-model="form.password"
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.password">
                    <strong>{{ form.errors.password[0] }}</strong>
                  </span>
                </div>

                <div class="form-group">
                  <label class="form-control-label" for="input-password-confirmation">
                    <span class="text-danger">*</span> Confirm Password
                  </label>

                  <input
                    type="password"
                    name="password_confirmation"
                    id="input-password-confirmation"
                    class="form-control form-control-alternative"
                    placeholder="Confirm Password"
                    v-model="form.password_confirmation"
                  />
                </div>

                <div class="text-center">
                  <button
                    type="submit"
                    class="btn btn-success mt-4"
                    @click="createUser"
                    :disabled="form.submitted"
                  >Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AdminForm from "../AdminForm";

export default {
  data() {
    return {
      form: new AdminForm({
        username: "",
        name: "",
        email: "",
        role_id: null,
        password: "",
        password_confirmation: ""
      })
    };
  },

  methods: {
    createUser() {
      this.form.post("/admin/users").then(({ data }) => {
        this.$router.push({ name: "UsersIndex" }, () => {
          flash(data.success);
        });
      });
    }
  }
};
</script>

<style scoped>
/*  */
</style>