<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs10>
          <v-card>
            <v-card-title>
              Roles
              <v-btn color="primary" dark @click.stop="dialog = true, isEdit = false">Add</v-btn>
              <v-dialog v-model="dialog" persistent max-width="600px">
                <v-card @keyup="enable">
                  <v-card-title>
                    <span class="headline">Add Roles</span>
                  </v-card-title>
                  <v-card-text>
                    <v-container grid-list-md>
                      <v-layout wrap>
                        <v-flex xs12>
                          <v-text-field label="Role" placeholder="Role" v-model="role" required></v-text-field>
                          <p class="red--text" v-if="errors.name" v-text="errors.name[0]"></p>
                        </v-flex>

                        <v-flex xs12>
                          <v-text-field
                            label="Description"
                            placeholder="Description"
                            v-model="description"
                            required
                          ></v-text-field>
                          <p
                            class="red--text"
                            v-if="errors.description"
                            v-text="errors.description[0]"
                          ></p>
                        </v-flex>
                        <p>Allowed Access</p>
                        <v-flex xs12>
                          <p class="red--text" v-if="errors.access" v-text="errors.access[0]"></p>
                          <v-checkbox
                            @change="enable"
                            v-for="(access, key) in access"
                            :key="key"
                            :label="access"
                            :value="access"
                            v-model="allowedAccess"
                            hide-details
                          ></v-checkbox>
                        </v-flex>
                      </v-layout>
                    </v-container>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="closeDialog">Close</v-btn>
                    <v-btn color="blue darken-1" flat :disabled="disabled" @click="submitRole">Save</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>

              <v-spacer></v-spacer>
              <v-text-field
                v-model="search"
                append-icon="search"
                label="Search"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>

            <v-data-table :headers="headers" :items="roles" :search="search">
              <template slot="items" slot-scope="props">
                <td width="70%">{{ props.item.description }}</td>
                <td width="30%" v-show="props.item.id != 1">
                  <v-tooltip top>
                    <template v-slot:activator="{ on }">
                      <v-btn
                        color="success"
                        v-on="on"
                        fab
                        small
                        dark
                        @click.stop="editRole(props.item)"
                      >
                        <v-icon>edit</v-icon>
                      </v-btn>
                    </template>
                    <span>Edit</span>
                  </v-tooltip>

                  <v-tooltip right>
                    <template v-slot:activator="{ on }">
                      <v-btn @click="delRole(props.item)" color="error" v-on="on" fab small dark>
                        <v-icon>delete</v-icon>
                      </v-btn>
                    </template>
                    <span>Delete</span>
                  </v-tooltip>
                </td>
              </template>
            </v-data-table>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data() {
    return {
      // table
      search: "",
      roles: [],
      headers: [
        { text: "Roles", value: "description" },
        {
          text: "Action",
          align: "left",
          sortable: false
        }
      ],
      //modal
      dialog: false,
      isEdit: false,
      // forms
      access: [],
      disabled: false,
      errors: {},
      editRoleIndex: [],
      role: "",
      description: "",
      allowedAccess: []
    };
  },

  computed: {
    async getRoles() {
      await axios.get(`/vue/users/roles`).then(({ data }) => {
        this.roles = data;
      });
    },

    async getAccessLists() {
      const pageAccess = window.App.sidebar.filter(access => access != "users");
      this.access = pageAccess;
    }
  },

  created() {
    this.getRoles;
    this.getAccessLists;
  },

  methods: {
    enable() {
      return (this.disabled = false);
    },

    closeDialog() {
      this.role = "";
      this.description = "";
      this.allowedAccess = [];
      this.dialog = false;
      this.errors = {};
      this.disabled = false;
    },

    editRole(role) {
      this.dialog = true;
      this.isEdit = true;

      this.editRoleIndex = { index: this.roles.indexOf(role), id: role.id };
      this.role = role.name;
      this.description = role.description;
      this.allowedAccess = JSON.parse(role.access);
    },

    submitRole() {
      this.isEdit ? this.updateRole() : this.addRole();
    },

    addRole() {
      this.disabled = true;
      const data = {
        name: this.role,
        description: this.description,
        access: this.allowedAccess
      };

      axios
        .post(`/users/roles`, data)
        .then(({ data }) => {
          this.closeDialog();
          this.roles.push(data.role);
          flash(data.success);
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
        });
    },

    updateRole() {
      this.disabled = true;
      const data = {
        name: this.role,
        description: this.description,
        access: this.allowedAccess
      };
      axios
        .patch(`/users/${this.editRoleIndex.id}/update-role`, data)
        .then(({ data }) => {
          this.roles[this.editRoleIndex.index].name = this.role;
          this.roles[this.editRoleIndex.index].description = this.description;
          this.roles[this.editRoleIndex.index].access = JSON.stringify(
            this.allowedAccess
          );
          this.closeDialog();
          flash(data.success);
        })
        .catch(({ response }) => {
          this.errors = response.data.errors;
        });
    },

    delRole(item) {
      const index = this.roles.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        axios.delete(`/users/${item.id}/delete-role`).then(({ data }) => {
          this.roles.splice(index, 1);

          flash(data);
        });
    }
  }
};
</script>

<style>
</style>