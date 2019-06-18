<template>
  <div>
    <div class="d-flex justify-content-end">
      <div>
        <router-link :to="{ name: 'users.index'}">
          <button class="btn btn-default">
            <i class="fas fa-users"></i> Users
          </button>
        </router-link>

        <router-link :to="{ name: 'user.roles' }">
          <button class="btn btn-info">
            <i class="fas fa-user-tag"></i> Roles
          </button>
        </router-link>
      </div>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>
import UsersTable from "../components/UsersTable";

export default {
  components: { UsersTable },

  data() {
    return {};
  }
};
</script>