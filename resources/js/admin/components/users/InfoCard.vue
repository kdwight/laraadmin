<template>
  <v-card>
    <v-toolbar flat>
      <span class="headline">Info</span>
      <v-spacer></v-spacer>

      <v-menu left>
        <template v-slot:activator="{ on, attrs }">
          <v-btn small icon v-bind="attrs" v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item @click="editting = true">
            <v-list-item-content>
              <v-list-item-title>Edit</v-list-item-title>
            </v-list-item-content>

            <v-list-item-icon>
              <v-icon>mdi-pencil</v-icon>
            </v-list-item-icon>
          </v-list-item>

          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Upload Avatar</v-list-item-title>
            </v-list-item-content>

            <v-list-item-icon>
              <v-icon>mdi-image-edit</v-icon>
            </v-list-item-icon>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-toolbar>

    <v-card-text>
      <v-form ref="form">
        <v-row justify="center" class="mb-2">
          <v-avatar rounded color="grey lighten-3" size="140">
            <v-img
              src="https://instagram.fmnl21-1.fna.fbcdn.net/v/t51.2885-15/e35/p1080x1080/109997645_2371150626521340_2117635963959569779_n.jpg?_nc_ht=instagram.fmnl21-1.fna.fbcdn.net&_nc_cat=1&_nc_ohc=_wDsWLQ3WOAAX9tlPaX&oh=ac72dde6f2d01a46fa6bf9178065cbba&oe=5F445B7D"
              lazy-src="https://instagram.fmnl21-1.fna.fbcdn.net/v/t51.2885-15/e35/p1080x1080/109997645_2371150626521340_2117635963959569779_n.jpg?_nc_ht=instagram.fmnl21-1.fna.fbcdn.net&_nc_cat=1&_nc_ohc=_wDsWLQ3WOAAX9tlPaX&oh=ac72dde6f2d01a46fa6bf9178065cbba&oe=5F445B7D"
              alt="Bonak"
            />
          </v-avatar>
        </v-row>

        <v-text-field
          v-model="form.name"
          label="Name"
          :readonly="!editting"
          :error="errors.hasOwnProperty('name')"
          :error-messages="errors.name"
        ></v-text-field>

        <v-text-field
          v-model="form.email"
          label="Email"
          :readonly="!editting"
          :error="errors.hasOwnProperty('email')"
          :error-messages="errors.email"
        ></v-text-field>

        <v-select
          label="Role"
          v-model="form.role_id"
          :items="storedRoles"
          item-text="description"
          item-value="id"
          :readonly="!editting"
          :error="errors.hasOwnProperty('role_id')"
          :error-messages="errors.role_id"
        ></v-select>

        <div v-show="editting">
          <v-text-field
            v-model="form.password"
            label="Password"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            :error="errors.hasOwnProperty('password')"
            :error-messages="errors.password"
            :type="showPassword ? 'text' : 'password'"
            @click:append="showPassword = !showPassword"
          ></v-text-field>

          <v-text-field
            v-model="form.password_confirmation"
            type="password"
            label="Password Confirmation"
          ></v-text-field>
        </div>
      </v-form>

      <span
        class="red--text"
        v-if="errors.hasOwnProperty('unauthorized')"
        v-text="errors.unauthorized[0]"
      ></span>
    </v-card-text>

    <v-card-actions>
      <v-spacer></v-spacer>
      <div v-show="editting">
        <v-btn @click="reset">Cancel</v-btn>
        <v-btn color="primary" @click="update" :disabled="disabled" :loading="loading">Update</v-btn>
      </div>
    </v-card-actions>
  </v-card>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  props: {
    info: {
      type: [Array, Object],
      required: true,
    },
  },

  data() {
    return {
      form: {
        name: "",
        email: "",
        role_id: "",
        password: "",
        password_confirmation: "",
      },
      errors: {},
      editting: false,
      disabled: false,
      loading: false,
      showPassword: false,
    };
  },

  watch: {
    info: {
      handler(data, oldData) {
        this.form.name = data.name;
        this.form.email = data.email;
        this.form.role_id = data.role_id;
      },
      immediate: true,
    },
  },

  computed: {
    ...mapGetters(["storedRoles"]),
  },

  methods: {
    reset(event, data = "form", val = "info") {
      for (let prop in this[val]) {
        if (this[data].hasOwnProperty(prop)) {
          this[data][prop] = this[val][prop];
        }
      }

      this.errors = {};
      this.form.password = this.form.password_confirmation = null;
      this.editting = this.disabled = this.loading = false;
    },

    update() {
      this.disabled = true;
      this.loading = true;

      axios
        .put(`/admin/users/${this.$route.params.id}`, this.form)
        .then(({ data }) => {
          this.reset(null, "info", "form");

          flash(data.success);
        })
        .catch(({ response }) => {
          this.loading = false;
          this.disabled = false;

          this.errors = response.data.errors;
        });
    },
  },
};
</script>

<style>
</style>