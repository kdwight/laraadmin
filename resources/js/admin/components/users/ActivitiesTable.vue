<template>
  <v-card>
    <v-card-title class="text-h1">
      <span class="headline">Activities</span>
      <v-spacer></v-spacer>
    </v-card-title>

    <v-simple-table dense fixed-header :height="400">
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">Description</th>
            <th class="text-left">Subject ID</th>
            <th class="text-left">Changes</th>
            <th class="text-left">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in activities" :key="item.description">
            <td>{{ item.description }}</td>
            <td>{{ item.subject_id }}</td>
            <td>{{ item.changes }}</td>
            <td>{{ new Date(item.created_at, "ddd") }}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
  </v-card>
</template>

<script>
export default {
  props: ["activities"],

  data() {
    return {
      //
    };
  },
};
</script>

<style>
</style>