<template>
  <nav
    class="d-flex justify-content-between align-items-center"
    aria-label="..."
    v-if="pagination && tableData.length > 0"
  >
    <small>Displaying {{ pagination.data.length }} of {{ pagination.meta.total }} entries.</small>

    <ul class="pagination">
      <li class="page-item" :class="{'disabled' : currentPage === 1}">
        <a class="page-link" @click.prevent="changePage(1)">
          <i class="fas fa-angle-double-left"></i>
        </a>
      </li>
      <li class="page-item" :class="{'disabled' : currentPage === 1}">
        <a class="page-link" @click.prevent="changePage(currentPage - 1)">
          <i class="fas fa-angle-left"></i>
          <span class="sr-only">Previous</span>
        </a>
      </li>

      <li
        v-for="(page, key) in pagesNumber"
        class="page-item"
        :class="{'active': page == pagination.meta.current_page}"
        :key="key"
      >
        <a @click.prevent="changePage(page)" class="page-link">{{ page }}</a>
      </li>

      <li class="page-item" :class="{'disabled': currentPage === pagination.meta.last_page }">
        <a class="page-link" @click.prevent="changePage(currentPage + 1)">
          <i class="fas fa-angle-right"></i>
          <span class="sr-only">Next</span>
        </a>
      </li>
      <li class="page-item" :class="{'disabled': currentPage === pagination.meta.last_page }">
        <a class="page-link" @click.prevent="changePage(pagination.meta.last_page)">
          <i class="fas fa-angle-double-right"></i>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: ["pagination", "tableData", "pagesNumber", "currentPage"],

  data() {
    return {};
  },

  methods: {
    changePage(page) {
      this.$emit("paginate", page);
    }
  }
};
</script>

<style>
</style>