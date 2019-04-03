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
          setTimeout(() => {
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