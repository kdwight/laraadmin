<template>
  <div>
    <users-table
      fetch-url="/admin/users-list"
      :columns="['username', 'email', 'role', 'created_at', 'status']"
      :sortables="['username', 'created_at']"
    ></users-table>
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