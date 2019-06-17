<template>
  <div class="row mt-3">
    <div class="col">
      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <span class="mb-0">List of Users</span>
              <button class="btn btn-primary btn-sm" @click="fetchData">
                <i class="fas fa-sync"></i> Reload
              </button>
            </div>

            <div class="col-3">
              <input
                class="form-control form-control-sm"
                placeholder="Search"
                type="text"
                v-model="search"
                @keyup="fetchData"
              >
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <div class="loading" v-if="loading">
            <img src="/images/preloader.svg">
          </div>

          <table class="table align-items-center table-hover">
            <thead class="thead-light">
              <tr>
                <th @click="sortByColumn('username')">
                  Username
                  <span v-if="'username' === sortedColumn">
                    <i v-if="order === 'asc' " class="fa fa-arrow-up"></i>
                    <i v-else class="fa fa-arrow-down"></i>
                  </span>
                </th>

                <th>Last Seen</th>

                <th width="10%">Role</th>

                <th width="10%">Action</th>
              </tr>
            </thead>

            <tbody>
              <tr class v-if="tableData.length === 0">
                <td class="lead text-center" :colspan="columns.length + 1">No data found.</td>
              </tr>

              <tr v-for="data in tableData" :key="data.id" class="m-datatable__row" v-else>
                <td>
                  <span class="mb-0 text-sm">{{ data.username }}</span>
                </td>

                <td>
                  <span class="mb-0 text-sm">{{ data.last_login_at }}</span>
                </td>

                <td>
                  <span class="mb-0 text-sm">{{ data.type }}</span>
                </td>

                <td class="text-center">
                  <status :attributes="data" :endpoint="`/admin/users/${data.id}/status`"></status>

                  <router-link :to="{ name: 'users.edit', params: { id: data.id } }">Edit</router-link>

                  <a :href="`/admin/users/${data.id}/edit`" class="mr-2">
                    <button type="button" class="btn btn-success btn-sm">
                      <i class="fas fa-user-edit"></i>
                    </button>
                  </a>

                  <button type="button" class="btn btn-danger btn-sm" @click="deleteRow(data)">
                    <i class="fas fa-user-times"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="card-footer py-4">
          <table-nav
            :pagination="pagination"
            :tableData="tableData"
            :pagesNumber="pagesNumber"
            :currentPage="currentPage"
            @paginate="changePage"
          ></table-nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Status from "../components/Status";
import TableNav from "../components/TableNav";
import DataTable from "../mixins/DataTables";

export default {
  mixins: [DataTable],
  components: { Status, TableNav },

  data() {
    return {};
  },

  methods: {
    deleteRow(item) {
      const index = this.tableData.indexOf(item);

      confirm("Are you sure you want to delete this user?") &&
        axios.delete(`/admin/users/${item.id}`).then(({ data }) => {
          this.tableData.splice(index, 1);
          flash(data.success);

          this.fetchData();
        });
    }
  }
};
</script>

<style>
</style>