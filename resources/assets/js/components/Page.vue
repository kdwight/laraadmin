<template>
  <div data-app>
    <v-card>
      <v-card-title>Pages
        <v-spacer></v-spacer>
        <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details></v-text-field>
      </v-card-title>

      <v-data-table :headers="headers" :items="pages" :search="search">
        <template slot="items" slot-scope="props" class="table">
          <td width="35%">{{ props.item.title }}</td>
          <td width="35%">{{ props.item.slug }}</td>
          <td width="30%">
            <status :attributes="props.item" :endpoint="`/pages/${props.item.id}/status`"></status>

            <a :href="`/pages/${props.item.id}/edit`">
              <button class="btn btn-icons btn-success btn-rounded">
                <i class="fa fa-pencil"></i>
              </button>
            </a>
            
            <button class="btn btn-icons btn-danger btn-rounded" @click="delPage(page.id)">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<script>
import Status from "./Status";

export default {
  components: { Status },

  data() {
    return {
      search: "",
      pages: [],
      filters: "",
      headers: [
        { text: "Title", value: "title" },
        { text: "Slug", value: "slug" },
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
      });
    }
  },

  created() {
    this.getPages;
  },

  methods: {
    filterPages() {
      const foo = this.pages.filter(page => {
        return page.title == this.filters;
      });

      this.pages = foo;
    },

    delPage(index) {
      axios.delete(`/pages/${index}`).then(({ data }) => {
        $(`#index-${index}`).fadeOut(300, () => {});

        flash(data);
      });
    }
  }
};
</script>

<style>
</style>