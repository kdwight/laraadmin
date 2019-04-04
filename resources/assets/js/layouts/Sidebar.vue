<template>
  <v-navigation-drawer v-model="drawer" clipped fixed app>
    <v-toolbar flat class="transparent">
      <v-list class="pa-0">
        <v-list-tile avatar>
          <v-list-tile-avatar tile>
            <img
              src="https://66.media.tumblr.com/cb6fd2f299102a14f2fbdafa74e49cb0/tumblr_oretueprP81vv3txeo2_r1_250.png"
            >
          </v-list-tile-avatar>

          <v-list-tile-content>
            <v-list-tile-title v-text="user.username"></v-list-tile-title>
            <span class="caption" v-text="user.type"></span>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-toolbar>

    <v-list class="pt-0" dense>
      <v-divider></v-divider>
      <v-list-tile :href="`/${nav}`" v-for="(nav, index) in sidebar" :key="index">
        <v-list-tile-action>
          <v-icon>list</v-icon>
        </v-list-tile-action>

        <v-list-tile-content>
          <v-list-tile-title>{{ nav | capitalize }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  data: () => ({
    user: window.App.user,
    sidebar: window.App.sidebar,
    drawer: null
  }),

  filters: {
    capitalize(value) {
      if (!value) return "";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    }
  }
};
</script>

<style>
</style>