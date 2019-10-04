<template >
  <div class="row">
    <div class="col">
      <div class="card shadow">
        <preloader />

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

              <tr v-for="user in tableData" :key="user.id" class="m-datatable__row" v-else>
                <td>{{ user.username }}</td>

                <td>{{ user.email }}</td>

                <td>{{ user.role }}</td>

                <td>{{ moment(user.created_at).format('YYYY-MM-DD') }}</td>

                <td>
                  <status
                    :attributes="user"
                    :endpoint="`/admin/users/${user.id}/status`"
                    v-if="user.id != 1"
                  ></status>
                </td>

                <td class="text-right">
                  <div class="dropdown" v-if="user.id != 1">
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
                      <router-link
                        class="dropdown-item"
                        :to="{ name: 'UserEdit', params: { id: user.id }}"
                      >Edit</router-link>

                      <button class="dropdown-item" @click="deleteRow(user)">Delete</button>
                    </div>
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
  </div>
</template>

<script>
import DataTable from "../mixins/DataTables";
import Preloader from "./Preloader";
import Pagination from "./Pagination";
import Status from "./Status";

import Swal from "sweetalert2";

export default {
  mixins: [DataTable],
  components: { Preloader, Pagination, Status },

  data() {
    return {
      //
    };
  },

  methods: {
    deleteRow(user) {
      const index = this.tableData.indexOf(user);

      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          axios
            .delete(`/admin/users/${user.id}`)
            .then(({ data }) => {
              this.tableData.splice(index, 1);

              flash(data.success, "success");
              this.fetchData();
            })
            .catch(error => {
              flash(error.response.data.message, "danger");
              this.fetchData();
            });
        }
      });
    }
  }
};
</script>

<style scoped>
/*  */
</style>