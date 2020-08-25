<template>
  <div>
    <v-row justify="center">
      <v-col id="info" cols="12" md="4">
        <info-card v-if="Object.keys(details).length > 0" :info="details"></info-card>
      </v-col>

      <v-col cols="12" md="8">
        <activities-table :activities="details.activities"></activities-table>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import InfoCard from "../components/users/InfoCard";
import ActivitiesTable from "../components/users/ActivitiesTable";
import store from "../store/index";

export default {
  components: {
    InfoCard,
    ActivitiesTable,
  },

  data() {
    return {
      details: {},
    };
  },

  watch: {
    async $route(to, from) {
      await axios
        .get(`/admin/users/${to.params.id}/details`)
        .then(({ data }) => {
          store.commit("storeBreadcrumbs", [
            {
              text: "Users",
              to: { name: "Users" },
              exact: true,
            },
            {
              text: "Edit",
              to: { name: "UserEdit", params: { id: data.id } },
            },
          ]);

          this.details = data;
        });
    },
  },

  async beforeRouteEnter(to, from, next) {
    await axios.get(`/admin/users/${to.params.id}/details`).then(({ data }) => {
      // prevents other admin from accessing the superadmin's profile
      if (data.id == 1 && store.getters.authenticated.id !== 1) {
        alert("Access Forbidden | 403");

        next({
          name: "Dashboard",
        });
      } else {
        store.commit("storeBreadcrumbs", [
          {
            text: "Users",
            to: { name: "Users" },
            exact: true,
          },
          {
            text: "Edit",
            to: { name: "UserEdit", params: { id: data.id } },
          },
        ]);

        next((vm) => (vm.details = data));
      }
    });
  },

  beforeRouteLeave(to, from, next) {
    store.commit("storeBreadcrumbs", [
      {
        text: "Users",
        disabled: true,
      },
    ]);

    next();
  },
};
</script>