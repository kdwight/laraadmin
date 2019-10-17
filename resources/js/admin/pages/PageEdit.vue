<template>
  <div>
    <div class="row">
      <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
          <preloader />

          <div class="card-header bg-white border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Edit Page</h3>
              </div>

              <div class="col-4 text-right">
                <router-link
                  class="btn btn-primary btn-sm"
                  :to="{ name: 'PagesIndex' }"
                >Back to list</router-link>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form autocomplete="off">
              <div class="pl-lg-4">
                <div class="form-group">
                  <label class="form-control-label">
                    Banner
                    <span
                      class="fas fa-question-circle"
                      v-b-tooltip.hover
                      title="Max File Size: 2mb, Supported File Types: .jpg,.png"
                    ></span>
                  </label>

                  <preview-image-input v-model="form.banner" />

                  <h5 class="text-warning" v-if="form.errors.banner">
                    <strong>{{ form.errors.banner[0] }}</strong>
                  </h5>
                </div>

                <div :class="`form-group`">
                  <label class="form-control-label" for="input-title">
                    <span class="text-danger">*</span> Title
                    <span
                      class="fas fa-question-circle"
                      v-b-tooltip.hover
                      title="Max Length 65 characters"
                    ></span>
                  </label>

                  <input
                    type="text"
                    name="title"
                    id="input-title"
                    :class="`form-control ${ form.errors.title ? 'is-invalid' : '' }`"
                    placeholder="Title"
                    maxlength="65"
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

                <h6 class="heading-small text-muted mb-4">SEO Tags</h6>

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
                    ref="metaKeywords"
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
                    @click.prevent="editPage"
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
import PreviewImageInput from "../components/PreviewImageInput";
import Preloader from "../components/Preloader";

export default {
  components: {
    "tinymce-editor": Editor,
    PreviewImageInput,
    Preloader
  },

  mixins: [Wysiwyg],

  data() {
    return {
      form: new AdminForm({
        banner: "",
        title: "",
        details: "Content of the editor",
        meta_description: "",
        meta_keywords: ""
      }),

      loading: false
    };
  },

  created() {
    this.pageAttributes();
  },

  methods: {
    pageAttributes() {
      this.loading = true;

      axios
        .get(`/admin/pages/${this.$route.params.slug}/edit`)
        .then(({ data }) => {
          this.loading = false;

          for (let prop in data) {
            if (this.form.hasOwnProperty(prop)) {
              this.form[prop] = data[prop];
            }
          }

          this.form.banner = data.banner_path;
          this.form.meta_description = data.seo.meta_description;
          this.form.meta_keywords = data.seo.meta_keywords;
        });
    },

    editPage() {
      this.form.meta_keywords = this.$refs.metaKeywords.value;

      this.form
        .submitFormData(`/admin/pages/${this.$route.params.slug}`, "put")
        .then(({ data }) => {
          this.$router.push({ name: "PagesIndex" }, () => {
            flash(data.success);
          });
        });
    }
  }
};
</script>

<style scoped>
/*  */
</style>