<template>
  <div class="row">
    <div class="col-md-4 mb-5 mb-md-0">
      <div class="card bg-secondary shadow sticky-top">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Add Role</h3>
            </div>
          </div>
        </div>

        <div class="card-body">
          <form autocomplete="off">
            <div :class="`form-group`">
              <label class="form-control-label">
                <span class="text-danger">*</span> Role
              </label>

              <input
                type="text"
                name="name"
                :class="`form-control ${ form.errors.name ? ' is-invalid' : '' }`"
                placeholder="Role"
                v-model="form.name"
              />

              <span class="invalid-feedback" role="alert" v-if="form.errors.name">
                <strong>{{ form.errors.name[0] }}</strong>
              </span>
            </div>

            <div :class="`form-group`">
              <label class="form-control-label">
                <span class="text-danger">*</span> Description
              </label>

              <input
                type="text"
                name="description"
                :class="`form-control ${ form.errors.description ? ' is-invalid' : '' }`"
                placeholder="Description"
                v-model="form.description"
              />

              <span class="invalid-feedback" role="alert" v-if="form.errors.name">
                <strong>{{ form.errors.name[0] }}</strong>
              </span>
            </div>

            <div class="form-group">
              <label class="form-control-label">
                <span class="text-danger">*</span> Allowed Access
              </label>

              <p class="text-warning" v-if="form.errors.access">
                <small>{{ form.errors.access[0] }}</small>
              </p>

              <div class="justify-content-around">
                <div class="custom-control custom-checkbox">
                  <input
                    id="articles"
                    class="custom-control-input"
                    type="checkbox"
                    name="access[]"
                    value="articles"
                    v-model="form.access"
                  />

                  <label for="articles" class="custom-control-label">Articles</label>
                </div>

                <div class="custom-control custom-checkbox">
                  <input
                    id="pages"
                    class="custom-control-input"
                    type="checkbox"
                    name="access[]"
                    value="pages"
                    v-model="form.access"
                  />

                  <label for="pages" class="custom-control-label">Pages</label>
                </div>
              </div>
            </div>

            <button
              class="btn btn-sm btn-success mr-2"
              @click.prevent="submit"
              :disabled="form.submitted"
            >Submit</button>

            <button class="btn btn-sm btn-light" @click.prevent="resetForm">Cancel</button>
          </form>
        </div>
      </div>
    </div>

    <roles-table
      ref="roleTableComponent"
      fetch-url="/admin/roles-list"
      :columns="['description']"
      :sortables="['description']"
    ></roles-table>
  </div>
</template>

<script>
import AdminForm from "../AdminForm";
import RolesTable from "../components/RolesTable";

export default {
  components: { RolesTable },

  data() {
    return {
      form: new AdminForm({
        name: "",
        description: "",
        access: []
      }),

      roleId: 0
    };
  },

  methods: {
    editRole(role) {
      for (let prop in role) {
        if (this.form.hasOwnProperty(prop)) {
          this.form[prop] = role[prop];
        }
      }

      this.roleId = role.id;
    },

    submit() {
      !this.roleId ? this.createRole() : this.updateRole();
    },

    createRole() {
      this.form.post("/admin/roles").then(({ data }) => {
        fetchData();

        flash(data.success);
      });
    },

    updateRole() {
      this.form.put(`/admin/roles/${this.roleId}`).then(({ data }) => {
        fetchData();

        flash(data.success);
        this.roleId = 0;
      });
    },

    resetForm() {
      this.form.reset();
      this.roleId = 0;
    },

    deleteRole(role) {
      this.$bvModal
        .msgBoxConfirm("Are you sure that you want to delete this item.", {
          title: "Please Confirm",
          size: "sm",
          buttonSize: "sm",
          okVariant: "danger",
          okTitle: "YES",
          cancelTitle: "NO",
          footerClass: "p-2",
          hideHeaderClose: false,
          centered: true
        })
        .then(value => {
          if (value) {
            axios
              .delete(`/admin/roles/${role.id}`)
              .then(({ data }) => {
                this.$refs.roleTableComponent.search = "";
                fetchData();

                flash(data.success, "success");
              })
              .catch(error => {
                flash(error.response.data.message, "danger");
              });
          }
        });
    }
  }
};
</script>

<style scoped>
/*  */
</style>