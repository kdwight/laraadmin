<template>
  <div>
    <nav
      class="row justify-content-between"
      aria-label="..."
      v-if="$parent.pagination && $parent.tableData.length > 0"
    >
      <span style="margin-top: 8px;">
        &nbsp;
        <small>Displaying {{ $parent. pagination.data.length }} of {{ $parent.pagination.meta.total }} entries.</small>
      </span>

      <ul class="pagination">
        <!-- first & prev -->
        <li class="page-item" :class="{'disabled' : $parent.currentPage === 1}">
          <a class="page-link" href="#" @click.prevent="$parent.changePage(1)">&#171;</a>
        </li>
        <li class="page-item" :class="{'disabled' : $parent.currentPage === 1}">
          <a
            class="page-link"
            href="#"
            @click.prevent="$parent.changePage($parent.currentPage - 1)"
          >Prev</a>
        </li>

        <!-- pages -->
        <li
          v-for="(page, key) in $parent.pagesNumber"
          class="page-item"
          :class="{'active': page == $parent.pagination.meta.current_page}"
          :key="key"
        >
          <a
            href="javascript:void(0)"
            @click.prevent="$parent.changePage(page)"
            class="page-link"
          >{{ page }}</a>
        </li>

        <!-- next & last -->
        <li
          class="page-item"
          :class="{'disabled': $parent.currentPage === $parent.pagination.meta.last_page }"
        >
          <a
            class="page-link"
            href="#"
            @click.prevent="$parent.changePage($parent.currentPage + 1)"
          >Next</a>
        </li>
        <li
          class="page-item"
          :class="{'disabled': $parent.currentPage === $parent.pagination.meta.last_page }"
        >
          <a
            class="page-link"
            href="#"
            @click.prevent="$parent.changePage($parent.pagination.meta.last_page)"
          >&#187;</a>
        </li>
      </ul>
    </nav>
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