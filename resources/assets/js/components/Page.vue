<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs10>
          <v-card>
            <v-card-title>
              Pages
              <v-btn href="/pages/create" color="primary">New Page</v-btn>
              <v-spacer></v-spacer>
              <v-text-field
                v-model="search"
                append-icon="search"
                label="Search"
                single-line
                hide-details
              ></v-text-field>
            </v-card-title>

            <v-data-table :headers="headers" :items="pages" :search="search" :loading="loading">
              <v-progress-linear v-slot:progress color="blue" indeterminate></v-progress-linear>
              <template slot="items" slot-scope="props">
                <td width="70%">{{ props.item.title }}</td>
                <td width="30%">
                  <status :attributes="props.item" :endpoint="`/pages/${props.item.id}/status`"></status>

                  <v-tooltip top>
                    <template v-slot:activator="{ on }">
                      <v-btn
                        :href="`/pages/${props.item.id}/edit`"
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
      loading: true,
      search: "",
      pages: [],
      headers: [
        { text: "Title", value: "title" },
        {
          text: "Action",
          align: "left",
          sortable: false
        }
      ]
    };
  },

  computed: {
    async getPages() {
      await axios.get(`/vue/pages`).then(({ data }) => {
        this.pages = data;
        this.loading = false;
      });
    }
  },

  created() {
    this.getPages;
  },

  methods: {
    delPage(item) {
      const index = this.pages.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        axios.delete(`/pages/${item.id}`).then(({ data }) => {
          this.pages.splice(index, 1);

          flash(data);
        });
    }
  }
};
</script>

<style>
</style>