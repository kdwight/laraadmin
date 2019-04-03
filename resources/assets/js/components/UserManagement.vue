<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs10>
          <v-card>
            <v-card-title>
              Users
              <v-btn href="/users/create" color="primary">Add User</v-btn>
              <v-btn href="/users/roles" color="error">Roles</v-btn>
              <v-btn href="/users/export" color="success">CSV</v-btn>

              <v-spacer></v-spacer>
              <v-text-field
                v-model="search"
                append-icon="search"
                label="Search"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>

            <v-data-table :headers="headers" :items="users" :search="search">
              <template slot="items" slot-scope="props">
                <td width="70%">{{ props.item.username }}</td>
                <td width="30%" v-show="props.item.id != 1">
                  <status :attributes="props.item" :endpoint="`/users/${props.item.id}/status`"></status>

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
import Status from "./Status";

export default {
  components: { Status },

  data() {
    return {
      search: "",
      users: [],
      headers: [
        { text: "Username", value: "username" },
        {
          text: "Action",
          align: "left",
          sortable: false
        }
      ]
    };
  },

  computed: {
    async getUsers() {
      await axios.get(`/vue/users`).then(({ data }) => {
        this.users = data;
      });
    }
  },

  created() {
    this.getUsers;
  },

  methods: {
    delPage(item) {
      const index = this.users.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        axios.delete(`/users/${item.id}`).then(({ data }) => {
          this.users.splice(index, 1);

          flash(data);
        });
    }
  }
};
</script>

<style>
</style>