<template>
  <v-card>
    <v-card-title class="text-h1">
      <span class="headline">Activities</span>
      <v-spacer></v-spacer>

      <v-btn small icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-card-title>

    <v-skeleton-loader boilerplate type="table"></v-skeleton-loader>
  </v-card>
</template>

<script>
export default {
  data() {
    return {};
  },
};
</script>

<style>
</style>