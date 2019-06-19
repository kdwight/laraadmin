<template>
  <div>
    <div class="row mt-3">
      <div class="col">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <span class="mb-0">User Details</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card shadow">
          <div class="card-header border-0">
            <div class="row align-items-center">
              <div class="col">
                <span class="mb-0">Password</span>
              </div>
            </div>
          </div>
        </div>
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
import { Form } from "../forms";

export default {
  props: ['user'],


  data() {
    return {
      form: new Form({
        username: "",
        type: ""
      })
    };
  },

  created() {
    if (this.$route.params.id == 1) {
      this.$router.push({ name: "users.index" });
    }
    axios.get(`/admin/API/${this.$route.params.id}/user-edit`).then(({ data }) => {
      this.form.username = data.username;
      this.form.type = data.type;
    });

    if(this.user) {
      this.form.username = this.user.username;
      this.form.type = this.user.type;
    }
  }
};
</script>

<style>
</style>