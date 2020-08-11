<template>
  <v-dialog v-model="dialog" persistent max-width="600px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="info" v-bind="attrs" v-on="on" small outlined>
        <v-icon>mdi-account-plus</v-icon>
      </v-btn>
    </template>

    <v-card>
      <v-card-title class="headline">New User</v-card-title>
      <v-card-subtitle>*indicates required field</v-card-subtitle>

      <v-card-text>
        <v-container>
          <v-form ref="form">
            <v-col>
              <v-text-field
                label="Name"
                v-model="form.name"
                :error="errors.hasOwnProperty('name')"
                :error-messages="errors.name"
              ></v-text-field>
            </v-col>

            <v-col>
              <v-text-field
                label="Email*"
                type="email"
                v-model="form.email"
                required
                :error="errors.hasOwnProperty('email')"
                :error-messages="errors.email"
              ></v-text-field>
            </v-col>

            <v-col>
              <v-text-field
                label="Password*"
                v-model="form.password"
                required
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                :error="errors.hasOwnProperty('password')"
                :error-messages="errors.password"
                :type="showPassword ? 'text' : 'password'"
                @click:append="showPassword = !showPassword"
              ></v-text-field>
            </v-col>

            <v-col>
              <v-select
                label="Role*"
                v-model="form.role_id"
                :items="storedRoles"
                item-text="description"
                item-value="id"
                :error="errors.hasOwnProperty('role_id')"
                :error-messages="errors.role_id"
              ></v-select>
            </v-col>
          </v-form>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="close">Close</v-btn>
        <v-btn color="blue darken-1" text @click="create" :loading="loading">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      dialog: false,
      form: {
        name: "",
        email: "",
        password: "",
        role_id: "",
      },
      errors: {},
      loading: false,
      showPassword: false,
    };
  },

  computed: {
    ...mapGetters(["storedRoles"]),
  },

  methods: {
    create() {
      this.loading = true;

      axios
        .post("/admin/users", this.form)
        .then(({ data }) => {
          this.close();
          this.$emit("resetTable", data.success);
        })
        .catch(({ response }) => {
          this.loading = false;
          this.errors = response.data.errors;
        });
    },

    close() {
      this.errors = {};
      this.$refs.form.reset();
      this.dialog = false;
      this.loading = false;
    },
  },
};
</script>

<style>
</style>