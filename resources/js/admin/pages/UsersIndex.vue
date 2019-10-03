<template>
  <div>
    <users-table fetch-url="/admin/users-list" :columns="['email', 'role']"></users-table>
  </div>
</template>

<script>
import UsersTable from "../components/UsersTable";

export default {
  components: { UsersTable },

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