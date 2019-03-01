<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs10>
          <v-card>
            <v-card-title>Pages</v-card-title>

            <v-form>
              <v-container>
                <v-flex>
                  <v-text-field label="First name" required></v-text-field>
                </v-flex>

                <v-flex>
                  <v-text-field label="Last name" required></v-text-field>
                </v-flex>

                <v-flex>
                  <label>Description</label>
                  <editor
                    :plugins="plugins"
                    :toolbar="toolbars"
                    :init="{ file_browser_callback }"
                    ref="tinymce"
                    v-model="description"
                    rows="10"
                    @onKeyUp="enable"
                  ></editor>
                </v-flex>
              </v-container>
              <v-btn color="primary">Submit</v-btn>
              <v-btn color="error">Cancel</v-btn>
            </v-form>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-content>
</template>


<script>
import Editor from "@tinymce/tinymce-vue";
import Wysiwyg from "../mixins/Wysiwyg.js";

export default {
  props: ["attributes"],
  mixins: [Wysiwyg],
  data() {
    return {
      disabled: false,
      title: "",
      slug: "",
      description: "",
      errors: {}
    };
  },

  components: {
    Editor
  },

  computed: {
    isEdit() {
      if (this.attributes) {
        this.title = this.attributes.title;
        this.slug = this.attributes.slug;
        this.description = this.attributes.description;
      }
    }
  },

  created() {
    this.isEdit;
  },

  methods: {
    slugify() {
      this.slug = this.title.replace(/\s+/g, "-").toLowerCase();
    },

    enable() {
      return (this.disabled = false);
    },

    createPage() {
      this.disabled = true;
      const data = {
        title: this.title,
        slug: this.slug,
        description: this.description
      };

      axios
        .post("/pages", data)
        .then(response => {
          this.title = "";
          this.slug = "";
          this.description = "";
          flash(response.data);
          setTimeout(function() {
            window.location.replace("/pages");
          }, 1500);
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },

    updatePage() {
      this.disabled = true;
      const data = {
        title: this.title,
        slug: this.slug,
        description: this.description
      };

      axios
        .patch(`/pages/${this.attributes.id}`, data)
        .then(response => {
          flash(response.data);
          setTimeout(function() {
            window.location.replace("/pages");
          }, 1500);
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    }
  }
};
</script>