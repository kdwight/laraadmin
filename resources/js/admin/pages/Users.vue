<template>
  <div>
    <v-row justify="center">
      <v-col cols="12" xl="8">
        <v-card>
          <v-card-title class="text-h1">
            <v-spacer></v-spacer>

            <v-menu left>
              <template v-slot:activator="{ on, attrs }">
                <v-btn small icon v-bind="attrs" v-on="on">
                  <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
              </template>

              <v-list>
                <v-list-item :to="{ name: 'Roles', hash: '#roles'}">
                  <v-list-item-content>
                    <v-list-item-title>Manage Roles</v-list-item-title>
                  </v-list-item-content>

                  <v-list-item-icon>
                    <v-icon>mdi-menu-down</v-icon>
                  </v-list-item-icon>
                </v-list-item>
              </v-list>
            </v-menu>
          </v-card-title>

          <v-data-table
            :headers="headers"
            :items="items"
            :options.sync="options"
            :server-items-length="totalItems"
            :items-per-page="itemsPerPage"
            :loading="loading"
          >
            <template v-slot:top>
              <v-toolbar flat color="white">
                <v-toolbar-title>
                  Users List
                  <new-user @resetTable="userCreated"></new-user>
                </v-toolbar-title>

                <v-spacer></v-spacer>
                <v-text-field
                  v-model="search"
                  append-icon="mdi-magnify"
                  label="Search"
                  single-line
                  hide-details
                ></v-text-field>
              </v-toolbar>
            </template>

            <template v-slot:item.status="{ item }">
              <status
                :attributes="item"
                :endpoint="`/admin/users/${item.id}/status`"
                v-if="item.id !== 1"
              ></status>
            </template>

            <template v-slot:item.actions="{ item }">
              <div v-show="item.id !== 1">
                <v-btn
                  x-small
                  fab
                  color="info"
                  :to="{ name: 'UserEdit', params: { id: item.id, attributes: item }, hash: '#info' }"
                >
                  <v-icon>mdi-account-cog</v-icon>
                </v-btn>

                <v-btn x-small fab color="error" @click.prevent="deleteUser(item)">
                  <v-icon>mdi-account-remove</v-icon>
                </v-btn>
              </div>
            </template>

            <template v-slot:no-data>
              <v-btn tile outlined color="primary" @click="fetchItems">
                <v-icon left>mdi-cached</v-icon>Reload
              </v-btn>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
    </v-row>

    <router-view></router-view>
  </div>
</template>

<script>
import DataTable from "../mixins/DataTables";
import Status from "../components/Status";
import CreateUserDialog from "../components/users/CreateUserDialog.vue";
import { mapActions } from "vuex";

export default {
  mixins: [DataTable],
  components: {
    Status,
    newUser: CreateUserDialog,
  },

  data() {
    return {
      path: "/admin/users",
      headers: [
        { text: "Name", value: "name" },
        { text: "Email", value: "email" },
        { text: "Role", value: "role.description", sortable: false },
        { text: "Status", value: "status" },
        { text: "", value: "actions", sortable: false },
      ],
    };
  },

  created() {
    if (this.$store.getters.authenticated.role_id === 1) {
      this.fetchRoles();
    } else {
      alert("Access Forbidden | 403");

      this.$router.push({
        name: "Dashboard",
      });
    }
  },

  methods: {
    ...mapActions(["fetchRoles"]),

    userCreated(message) {
      this.fetchItems();
      flash(message);
    },

    deleteUser(user) {
      const index = this.items.indexOf(user);

      confirm("Are you sure you want to delete this user?") &&
        axios
          .delete(`${this.path}/${user.id}`)
          .then(({ data }) => {
            this.items.splice(index, 1);
            this.fetchItems();

            flash(data.success, "warning");

            if (this.$route.name === "UserEdit") {
              this.$router.push({ name: "Users" });
            }
          })
          .catch((error) => {
            // flash(error.response.data.message, "danger");
            location.reload();
          });
    },
  },
};
</script>