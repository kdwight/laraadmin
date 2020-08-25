<template>
  <v-navigation-drawer :mini-variant="! $parent.$parent.drawer" permanent clipped app>
    <v-list dense nav class="py-0">
      <!-- Authenticated Details -->
      <v-list-item class="px-0">
        <v-list-item-avatar>
          <img
            src="https://instagram.fmnl21-1.fna.fbcdn.net/v/t51.2885-15/e35/p1080x1080/118145612_452604728973551_2156581371687349976_n.jpg?_nc_ht=instagram.fmnl21-1.fna.fbcdn.net&_nc_cat=1&_nc_ohc=Ni2aa5CK6NYAX801Lki&oh=b81a542b00734e7fdb77e7b3d72341a1&oe=5F6C68E2"
          />
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title v-text="authenticated.email"></v-list-item-title>
          <v-list-item-subtitle v-text="authenticated.role.description"></v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list-item-group color="primary">
        <v-list-item :to="{ name: 'Dashboard' }">
          <v-list-item-action>
            <v-icon>mdi-view-dashboard</v-icon>
          </v-list-item-action>

          <v-list-item-content>
            <v-list-item-title>Dashboard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <!-- Authenticated modules list -->
        <v-list-item
          v-for="(item, index) in authenticated.role.modules"
          :key="index"
          :to="{ path: item.path }"
        >
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>

          <v-list-item-content>
            <v-list-item-title>{{ item.name | capitalize }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item :to="{ name: 'Users' }" v-if="authenticated.role_id == 1">
          <v-list-item-action>
            <v-icon>mdi-account-group</v-icon>
          </v-list-item-action>

          <v-list-item-content>
            <v-list-item-title>Users</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>

    <template v-slot:append>
      <v-list-item href="/admin/logout">
        <v-list-item-icon>
          <v-icon>mdi-logout</v-icon>
        </v-list-item-icon>

        <v-list-item-content>
          <v-list-item-title>Logout</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </template>
  </v-navigation-drawer>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      //
    };
  },

  computed: {
    ...mapGetters(["authenticated"]),
  },

  filters: {
    capitalize(value) {
      if (!value) return "";
      value = value.toString().split(" ");

      for (let i = 0, x = value.length; i < x; i++) {
        value[i] = value[i][0].toUpperCase() + value[i].substr(1);
      }

      return value.join(" ");
    },
  },
};
</script>

<style>
</style>