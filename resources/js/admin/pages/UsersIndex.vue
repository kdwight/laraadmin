<template>
  <div>
    <div class="row">
      <div class="col">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">List of Users</h3>
              </div>

              <div class="col-4 text-right">
                <router-link :to="`/admin/users/create`">
                  <button class="btn btn-primary btn-sm">Add User</button>
                </router-link>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Date created</th>
                  <th scope="col"></th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="user in $parent.users" :key="user.id">
                  <td>{{ user.name }}</td>

                  <td>
                    <a :href="`mailto:${user.email}`">{{ user.email }}</a>
                  </td>

                  <td>{{ moment(user.created_at).format('YYYY-MM-DD') }}</td>

                  <td class="text-right">
                    <div class="dropdown">
                      <a
                        class="btn btn-sm btn-icon-only text-light"
                        href="#"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="fas fa-ellipsis-v"></i>
                      </a>

                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <form action="/admin/users" method="post" v-if="user.id != $auth.id">
                          <a class="dropdown-item" :href="`/admin/users/${user.id}/edit`">Edit</a>

                          <button
                            type="button"
                            class="dropdown-item"
                            onclick="confirm('Are you sure you want to delete this user?') ? this.parentElement.submit() : ''"
                          >Delete</button>
                        </form>

                        <a class="dropdown-item" href="/admin/profile" v-else>Edit</a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
              <!-- {{ $users->links() }} -->
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
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