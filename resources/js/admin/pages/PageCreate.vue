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
                <div :class="`form-group ${form.errors.title ? 'has-danger' : ''}`">
                  <label class="form-control-label" for="input-title">
                    <span class="text-danger">*</span> Title
                  </label>

                  <input
                    type="text"
                    name="title"
                    id="input-title"
                    :class="`form-control form-control-alternative ${ form.errors.title ? ' is-invalid' : '' }`"
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

                  <editor
                    api-key="jjnaxoo9ntewjb2s6ya0mz8csdvsgrf3x74a49slrbvdl8ma"
                    :plugins="plugins"
                    :toolbar="toolbars"
                    :init="{ file_picker_callback }"
                    ref="tinymce"
                    v-model="form.details"
                    rows="20"
                  ></editor>

                  <span class="invalid-feedback" role="alert" v-if="form.errors.details">
                    <strong>{{ form.errors.details[0] }}</strong>
                  </span>
                </div>

                <div class="text-center">
                  <button
                    type="submit"
                    class="btn btn-success mt-4"
                    @click="createPage"
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
    Editor
  },

  mixins: [Wysiwyg],

  data() {
    return {
      form: new AdminForm({
        title: "",
        details: "<p>Content of the editor.</p>"
      })
    };
  },

  methods: {
    createPage() {
      return console.log("create");
    }
  }
};
</script>

<style scoped>
/*  */
</style>