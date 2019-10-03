<template>
  <div>
    <div class="row">
      <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">User Management</h3>
              </div>

              <div class="col-4 text-right">
                <router-link :to="{ name: 'UsersIndex' }">
                  <button class="btn btn-primary btn-sm">Back to list</button>
                </router-link>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form method="post" action="/admin/users" autocomplete="off">
              <h6 class="heading-small text-muted mb-4">User Information</h6>

              <div class="pl-lg-4">
                <div :class="`form-group ${form.errors.username ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-username">Username</label>

                  <input
                    type="text"
                    name="username"
                    id="input-username"
                    :class="`form-control form-control-alternative ${ form.errors.username ? ' is-invalid' : '' }`"
                    placeholder="Username"
                    required
                    autofocus
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.username">
                    <strong>{{ form.errors.username[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group ${form.errors.name ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-name">Name</label>

                  <input
                    type="text"
                    name="name"
                    id="input-name"
                    :class="`form-control form-control-alternative ${ form.errors.name ? ' is-invalid' : '' }`"
                    placeholder="Name"
                    required
                    autofocus
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.name">
                    <strong>{{ form.errors.name[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group ${form.errors.email ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-email">email</label>

                  <input
                    type="email"
                    name="email"
                    id="input-email"
                    :class="`form-control form-control-alternative ${ form.errors.email ? ' is-invalid' : '' }`"
                    placeholder="email"
                    required
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.email">
                    <strong>{{ form.errors.email[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group ${form.errors.password ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-password">Password</label>

                  <input
                    type="password"
                    name="password"
                    id="input-password"
                    :class="`form-control form-control-alternative ${ form.errors.password ? ' is-invalid' : '' }`"
                    placeholder="Password"
                    value
                    required
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.password">
                    <strong>{{ form.errors.password[0] }}</strong>
                  </span>
                </div>

                <div class="form-group">
                  <label
                    class="form-control-label"
                    for="input-password-confirmation"
                  >Confirm Password</label>

                  <input
                    type="password"
                    name="password_confirmation"
                    id="input-password-confirmation"
                    class="form-control form-control-alternative"
                    placeholder="Confirm Password"
                    value
                    required
                  />
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-success mt-4">Save</button>
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
      form: new AdminForm({})
    };
  }
};
</script>

<style scoped>
/*  */
</style>