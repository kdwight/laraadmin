<template>
  <div>
    <div class="row mt-3">
      <div class="col">
        <user-details-form></user-details-form>
      </div>

      <div class="col">
        <user-password></user-password>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <span class="mb-0">User Activity</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UserDetailsForm from "../components/UserDetailsForm";
import UserPassword from "../components/UserPassword";

export default {
  props: ["user"],
  components: { UserDetailsForm, UserPassword },

  data() {
    return {};
  },

  created() {
    if (this.$route.params.id == 1) {
      this.$router.push({ name: "users.index" });
    }
  }
};
</script>

<style>
</style>