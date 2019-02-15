<template>
  <div>
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body" @keyup="enable">
          <div class="form-group">
            <label for="title">Title</label>
            <input
              type="text"
              name="title"
              class="form-control"
              placeholder="Title"
              v-model="title"
              @keyup="slugify"
            >
            <p class="text-danger" v-if="errors.title">{{ errors.title[0] }}</p>
          </div>

          <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" placeholder="Slug" class="form-control" v-model="slug">
            <p class="text-danger" v-if="errors.slug">{{ errors.slug[0] }}</p>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <p class="text-danger" v-if="errors.description">{{ errors.description[0] }}</p>
            <editor
              :plugins="pluginz"
              :toolbar="toolbarz"
              :init="{ file_browser_callback }"
              ref="tinymce"
              v-model="description"
              rows="10"
              @onKeyUp="enable"
            ></editor>
          </div>
          <button
            type="submit"
            class="btn btn-success mr-2"
            @click="createPage"
            :disabled="disabled"
          >Submit</button>
          <a href="/pages" class="btn btn-light">Cancel</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Editor from "@tinymce/tinymce-vue";

export default {
  data() {
    return {
      disabled: false,
      title: "",
      slug: "",
      description: "",
      pluginz: [
        "link image hr anchor pagebreak",
        "searchreplace wordcount code fullscreen",
        "insertdatetime nonbreaking contextmenu",
        "paste textcolor colorpicker textpattern lists advlist"
      ],
      toolbarz:
        "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code",
      errors: {}
    };
  },

  components: {
    Editor
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
          flash("Page Created");
          setTimeout(function() {
            window.location.replace("/pages");
          }, 1500);
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },

    file_browser_callback(field_name, url, type, win) {
      let x =
        window.innerWidth ||
        document.documentElement.clientWidth ||
        document.getElementsByTagName("body")[0].clientWidth;
      let y =
        window.innerHeight ||
        document.documentElement.clientHeight ||
        document.getElementsByTagName("body")[0].clientHeight;

      let cmsURL = "/laravel-filemanager?field_name=" + field_name;

      if (type == "image") {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      this.$refs.tinymce.editor.windowManager.open({
        file: cmsURL,
        title: "Filemanager",
        width: x * 0.8,
        height: y * 0.8,
        resizable: "yes",
        close_previous: "no"
      });
    }
  }
};
</script>

<style>
</style>