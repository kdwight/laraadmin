<template>
  <div>
    <div class="d-flex justify-content-end">
      <user-form></user-form>
    </div>

    <users-table fetch-url="/admin/users" :columns="['username', 'type']"></users-table>
  </div>
</template>

<script>
import UsersTable from "../components/UsersTable";
import UserForm from "../components/UserForm";

export default {
  components: { UsersTable, UserForm },

  data() {
    return {};
  }
};
</script>