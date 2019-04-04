<template>
  <v-toolbar color="teal accent-4" dark clipped-left app fixed>
    <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <span class="hidden-sm-and-down">LaraCMS</span>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <span class="hidden-sm-and-down">Welcome!</span>
    <v-menu offset-y>
      <v-btn icon slot="activator">
        <v-avatar size="32px">
          <img
            src="https://66.media.tumblr.com/cb6fd2f299102a14f2fbdafa74e49cb0/tumblr_oretueprP81vv3txeo2_r1_250.png"
            alt="Vuetify"
          >
        </v-avatar>
      </v-btn>
      <v-list>
        <v-list-tile :href="`/users/${user.id}/change-password`">
          <v-list-tile-action>
            <v-icon>lock</v-icon>
          </v-list-tile-action>
          <v-list-tile-title>Change Password</v-list-tile-title>
        </v-list-tile>

        <v-list-tile href="/admin_logout">
          <v-list-tile-action>
            <v-icon>exit_to_app</v-icon>
          </v-list-tile-action>
          <v-list-tile-title>Sign out</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
  </v-toolbar>
</template>

<script>
export default {
  data() {
    return {
      user: window.App.user,
      drawer: null
    };
  }
};
</script>

<style>
</style>