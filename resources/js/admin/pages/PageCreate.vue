<template>
  <div>
    <div class="row">
      <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Page Create</h3>
              </div>

              <div class="col-4 text-right">
                <router-link :to="{ name: 'PagesIndex' }">
                  <button class="btn btn-primary btn-sm">Back to list</button>
                </router-link>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form autocomplete="off">
              <div class="pl-lg-4">
                <div :class="`form-group `">
                  <label class="form-control-label">
                    Banner
                    <span
                      class="fas fa-question-circle"
                      v-b-tooltip.hover
                      title="Max File Size: 2mb, Supported File Types: .jpg,.png, Dimension: 1350x500"
                    ></span>
                  </label>

                  <div class="mb-2" v-if="imageData.length > 0">
                    <img class="preview" :src="imageData" />
                  </div>

                  <b-form-file
                    name="banner"
                    id="file-default"
                    ref="file-input"
                    v-model="form.banner"
                    accept="image/*"
                    @change="previewImage"
                  ></b-form-file>

                  <span class="text-warning" v-if="form.errors.banner">
                    <strong>{{ form.errors.banner[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group`">
                  <label class="form-control-label" for="input-title">
                    <span class="text-danger">*</span> Title
                  </label>

                  <input
                    type="text"
                    name="title"
                    id="input-title"
                    :class="`form-control ${ form.errors.title ? 'is-invalid' : '' }`"
                    placeholder="Title"
                    autofocus
                    v-model="form.title"
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.title">
                    <strong>{{ form.errors.title[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group ${form.errors.title ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-title">
                    <span class="text-danger">*</span> Details
                  </label>

                  <tinymce-editor
                    api-key="jjnaxoo9ntewjb2s6ya0mz8csdvsgrf3x74a49slrbvdl8ma"
                    :init="tinymceInit()"
                    v-model="form.details"
                    rows="15"
                  ></tinymce-editor>

                  <span class="invalid-feedback" role="alert" v-if="form.errors.details">
                    <strong>{{ form.errors.details[0] }}</strong>
                  </span>
                </div>

                <hr class="my-4" />

                <h6 class="heading-small text-muted mb-4">SEO</h6>

                <div :class="`form-group ${form.errors.meta_description ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-meta_description">
                    Meta Description
                    <span
                      class="fas fa-question-circle"
                      v-b-tooltip.hover
                      title="Max Length 160 characters"
                    ></span>
                  </label>

                  <textarea
                    type="text"
                    name="meta_description"
                    id="input-meta_description"
                    :class="`form-control ${ form.errors.meta_description ? ' is-invalid' : '' }`"
                    placeholder="Meta Description"
                    maxlength="160"
                    v-model="form.meta_description"
                  ></textarea>

                  <span class="invalid-feedback" role="alert" v-if="form.errors.meta_description">
                    <strong>{{ form.errors.meta_description[0] }}</strong>
                  </span>
                </div>

                <div :class="`form-group ${form.errors.meta_keywords ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-tags">Meta Keywords</label>

                  <input
                    type="text"
                    name="meta_keywords"
                    id="input-tags"
                    :class="`form-control ${ form.errors.meta_keywords ? ' is-invalid' : '' }`"
                    placeholder="Meta Keywords"
                    v-model="form.meta_keywords"
                  />

                  <span class="invalid-feedback" role="alert" v-if="form.errors.meta_keywords">
                    <strong>{{ form.errors.meta_keywords[0] }}</strong>
                  </span>
                </div>

                <div class="text-center">
                  <button
                    type="submit"
                    class="btn btn-success mt-4"
                    @click.prevent="createPage"
                    :disabled="form.submitted"
                  >Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AdminForm from "../AdminForm";
import Editor from "@tinymce/tinymce-vue";
import Wysiwyg from "../mixins/Wysiwyg";

export default {
  components: {
    "tinymce-editor": Editor
  },

  mixins: [Wysiwyg],

  data() {
    return {
      form: new AdminForm({
        title: "",
        details: "Content of the editor"
      }),

      imageData: ""
    };
  },

  methods: {
    previewImage(event) {
      // Reference to the DOM input element
      var input = event.target;
      // Ensure that you have a file before attempting to read it
      if (input.files && input.files[0]) {
        // create a new FileReader to read this image and convert to base64 format
        var reader = new FileReader();
        // Define a callback function to run, when FileReader finishes its job
        reader.onload = e => {
          // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
          // Read image as base64 and set to imageData
          this.imageData = e.target.result;
        };
        // Start the reader job - read file as a data url (base64 format)
        reader.readAsDataURL(input.files[0]);
      }
    },

    createPage() {
      return console.log("create");
    }
  }
};
</script>

<style scoped>
img.preview {
  width: 200px;
  background-color: white;
  border: 1px solid #ddd;
  padding: 5px;
}
</style>