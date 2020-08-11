<template>
  <v-app-bar clipped-left color="blue darken-3" app dark>
    <v-app-bar-nav-icon @click.stop="toggleDrawer" />

    <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
      <span class="hidden-sm-and-down">Susej Party</span>
    </v-toolbar-title>

    <v-spacer />

    <v-btn icon>
      <v-icon>mdi-bell</v-icon>
    </v-btn>

    <v-menu bottom left>
      <template v-slot:activator="{ on, attrs }">
        <v-btn icon v-bind="attrs" v-on="on">
          <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>
      </template>

      <v-list>
        <v-list-item v-for="n in 5" :key="n" @click="() => {}">
          <v-list-item-title>Option {{ n }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-app-bar>
</template>

<script>
export default {
  data() {
    return {
      //
    };
  },

  methods: {
    toggleDrawer() {
      this.$emit("toggleDrawer");
    },
  },
};
</script>

<style>
</style>