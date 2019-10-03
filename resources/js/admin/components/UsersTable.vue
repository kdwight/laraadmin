<template>
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <h1 class="loading" v-if="loading">
          <img src="/img/preloader.svg" />
        </h1>

        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8 d-flex">
              <h3 class="mb-0">List of Users</h3>

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
              <router-link :to="{ name: 'UserCreate' }">
                <button class="btn btn-primary btn-sm">Add User</button>
              </router-link>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Username</th>

                <th scope="col" @click="sortByColumn('email')">
                  Email
                  <span v-if="'email' === sortedColumn">
                    <i v-if="order === 'asc' " class="fa fa-arrow-up"></i>
                    <i v-else class="fa fa-arrow-down"></i>
                  </span>
                </th>
                <th scope="col">Date created</th>
                <th scope="col"></th>
              </tr>
            </thead>

            <tbody>
              <tr class v-if="tableData.length === 0">
                <td class="lead text-center" :colspan="columns.length + 1">No data found.</td>
              </tr>
              <tr v-for="data in tableData" :key="data.id" class="m-datatable__row" v-else>
                <td>{{ data.username }}</td>
                <td>{{ data.email }}</td>
                <td>{{ moment(data.created_at).format('YYYY-MM-DD') }}</td>

                <td v-if="data.role_id != 1">
                  <router-link :to="`/admin/users/${data.id}/edit`">
                    <button
                      type="button"
                      class="btn btn-icons btn-rounded btn-success"
                      data-toggle="tooltip"
                      data-placement="top"
                      title="Edit"
                    >
                      <i class="fas fa-edit"></i>
                    </button>
                  </router-link>

                  <button
                    type="button"
                    class="btn btn-icons btn-rounded btn-danger"
                    data-toggle="tooltip"
                    data-placement="right"
                    title="Delete"
                    @click="deleteRow(data)"
                  >
                    <i class="fa fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="card-footer py-4">
          <pagination></pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import DataTable from "../mixins/DataTables";
import Pagination from "./Pagination";

export default {
  mixins: [DataTable],
  components: { Pagination },

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