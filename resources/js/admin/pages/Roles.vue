<template>
  <div id="roles">
    <v-row justify="center">
      <v-col cols="12" md="4">
        <v-card>
          <v-card-title>
            <span class="headline" v-if="roleId">Edit role</span>
            <span class="headline" v-else>New Role</span>
          </v-card-title>

          <v-card-text>
            <v-form ref="form">
              <v-text-field
                v-model="form.name"
                label="Name"
                outlined
                :error="form.errors.hasOwnProperty('name')"
                :error-messages="form.errors.name"
              ></v-text-field>

              <v-text-field
                v-model="form.description"
                label="Description"
                outlined
                :error="form.errors.hasOwnProperty('description')"
                :error-messages="form.errors.description"
              ></v-text-field>

              <v-select
                v-model="form.modules"
                chips
                label="Modules"
                multiple
                outlined
                :items="modules"
                item-text="name"
                item-value="name"
                :error="form.errors.hasOwnProperty('modules')"
                :error-messages="form.errors.modules"
                return-object
              ></v-select>
            </v-form>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click.prevent="resetForm">Cancel</v-btn>
            <v-btn color="primary" @click.prevent="submit" :disabled="form.submitted">Submit</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>

      <v-col cols="12" md="8">
        <v-data-table
          :headers="headers"
          :items="storedRoles"
          :items-per-page="5"
          class="elevation-1"
        >
          <template v-slot:item.actions="{ item }">
            <div v-show="item.id !== 1">
              <v-btn x-small fab color="info" @click.prevent="editRole(item)">
                <v-icon>mdi-pencil</v-icon>
              </v-btn>

              <v-btn x-small fab color="error" @click.prevent="destroy(item)">
                <v-icon>mdi-delete</v-icon>
              </v-btn>
            </div>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import AdminForm from "../AdminForm";
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      form: new AdminForm({
        name: "",
        description: "",
        modules: [],
      }),
      headers: [
        { text: "Role", value: "description" },
        { text: "Actions", value: "actions", align: "center", sortable: false },
      ],
      modules: [
        {
          name: "articles",
          path: "/admin/articles",
          icon: "mdi-format-float-left",
        },
        {
          name: "pages",
          path: "/admin/pages",
          icon: "mdi-newspaper-variant-multiple",
        },
        {
          name: "foo nak",
          path: "/admin/foo",
          icon: "mdi-puzzle-edit-outline",
        },
        {
          name: "bar",
          path: "/admin/bar",
          icon: "mdi-puzzle-edit-outline",
        },
        {
          name: "baz",
          path: "/admin/baz",
          icon: "mdi-puzzle-edit-outline",
        },
      ],

      roleId: 0,
    };
  },

  created() {
    if (this.$store.getters.authenticated.role_id === 1) {
      this.$store.commit("storeBreadcrumbs", [
        {
          text: "Users",
          to: { name: "Users" },
        },
        {
          text: "Roles",
          to: { name: "Roles" },
        },
      ]);
    } else {
      alert("Access Forbidden | 403");

      this.$router.push({
        name: "Dashboard",
      });
    }
  },

  computed: {
    ...mapGetters(["storedRoles"]),
  },

  methods: {
    resetForm() {
      this.form.reset();
      this.form.errors = {};
      this.roleId = 0;
    },

    editRole(role) {
      for (let prop in role) {
        if (this.form.hasOwnProperty(prop)) {
          this.form[prop] = role[prop];
        }
      }

      this.roleId = role.id;
    },

    submit() {
      !this.roleId ? this.create() : this.update();
    },

    create() {
      this.form.post("/admin/roles").then(({ data }) => {
        this.$store.dispatch("fetchRoles");

        flash(data.success);
      });
    },

    update() {
      this.form.put(`/admin/roles/${this.roleId}`).then(({ data }) => {
        this.$store.dispatch("fetchRoles");

        flash(data.success);
        this.roleId = 0;
      });
    },

    destroy(role) {
      confirm("Are you sure you want to delete this role?") &&
        axios
          .delete(`/admin/roles/${role.id}`)
          .then(({ data }) => {
            this.$store.dispatch("fetchRoles");

            flash(data.success, "warning");
          })
          .catch((error) => {
            flash(error.response.data.message, "danger");
          });
    },
  },

  beforeRouteLeave(to, from, next) {
    this.$store.commit("storeBreadcrumbs", [
      {
        text: "Users",
        disabled: true,
      },
    ]);

    next();
  },
};
</script>

<style scoped>
/*  */
</style>