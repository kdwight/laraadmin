<template >
  <div class="col">
    <div class="card shadow">
      <preloader />

      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col-8 d-flex">
            <h3 class="mb-0">List of Roles</h3>

            <div class="col-md-6">
              <input
                id="searchTable"
                class="form-control form-control-sm form-control-alternative"
                placeholder="Search..."
                v-model="search"
                @keyup="fetchData"
              />
            </div>
          </div>

          <div class="col-4 text-right">
            <router-link :to="{ name: 'UsersIndex' }">
              <button class="btn btn-primary btn-sm">Users</button>
            </router-link>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th
                v-for="column in columns"
                :key="column"
                @click="sortByColumn(column)"
                class="table-head"
              >
                {{ column | columnHead }}
                <span v-if="column === sortedColumn">
                  <i v-if="order === 'asc' " class="fas fa-arrow-up"></i>
                  <i v-else class="fas fa-arrow-down"></i>
                </span>
              </th>

              <th scope="col"></th>
            </tr>
          </thead>

          <tbody>
            <tr class v-if="tableData.length === 0">
              <td class="lead text-center" :colspan="columns.length + 1">No data found.</td>
            </tr>

            <tr v-for="role in tableData" :key="role.id" class="m-datatable__row" v-else>
              <td>{{ role.name }}</td>

              <td class="text-right">
                <div v-if="role.id != 1">
                  <button
                    class="btn btn-icons btn-rounded btn-success btn-sm"
                    @click.prevent="$parent.editRole(role)"
                  >
                    <i class="fas fa-edit"></i>
                  </button>

                  <button
                    class="btn btn-icons btn-rounded btn-danger btn-sm"
                    title="delete"
                    @click="$parent.deleteRole(role)"
                  >
                    <i class="fa fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="card-footer py-4">
        <pagination />
      </div>
    </div>
  </div>
</template>

<script>
import DataTable from "../mixins/DataTables";
import Preloader from "./Preloader";
import Pagination from "./Pagination";

export default {
  mixins: [DataTable],
  components: { Preloader, Pagination },

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