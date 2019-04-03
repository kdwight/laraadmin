<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs10>
          <v-card>
            <v-card-title>
              Users
              <v-btn href="/users/create" color="primary">Add User</v-btn>

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
                        :href="`/users/${props.item.id}/edit`"
                        color="success"
                        v-on="on"
                        fab
                        small
                        dark
                      >
                        <v-icon>edit</v-icon>
                      </v-btn>
                    </template>
                    <span>Edit</span>
                  </v-tooltip>

                  <v-tooltip right>
                    <template v-slot:activator="{ on }">
                      <v-btn @click="delPage(props.item)" color="error" v-on="on" fab small dark>
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
      search: "",
      roles: [],
      headers: [
        { text: "Roles", value: "description" },
        {
          text: "Action",
          align: "left",
          sortable: false
        }
      ]
    };
  },

  computed: {
    async getRoles() {
      await axios.get(`/vue/users/roles`).then(({ data }) => {
        this.roles = data;
      });
    }
  },

  created() {
    this.getRoles;
  },

  methods: {
    delPage(item) {
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