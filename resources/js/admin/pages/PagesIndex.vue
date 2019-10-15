<template>
  <div>
    <pages-table
      fetch-url="/admin/pages-list"
      :columns="['title', 'status']"
      :sortables="['title']"
    ></pages-table>
  </div>
</template>

<script>
import PagesTable from "../components/PagesTable";

export default {
  components: { PagesTable },

  data() {
    return {
      //
    };
  }
};
</script>

<style scoped>
/*  */
</style>