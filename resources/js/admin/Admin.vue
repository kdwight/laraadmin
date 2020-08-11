<template>
  <v-app>
    <side-bar />
    <top-bar @toggleDrawer="drawer = !drawer" />

    <v-main>
      <flash />

      <v-breadcrumbs :items="$store.state.breadcrumbs">
        <template v-slot:divider>
          <v-icon>mdi-chevron-right</v-icon>
        </template>
      </v-breadcrumbs>

      <v-container>
        <router-view></router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import SideBar from "./layouts/SideBar";
import TopBar from "./layouts/TopBar";
import Flash from "./components/Flash";
import { mapGetters, mapActions } from "vuex";

export default {
  props: ["attributes"],

  components: {
    SideBar,
    TopBar,
    Flash,
  },

  data() {
    return {
      drawer: false,
    };
  },

  created() {
    this.$store.commit(
      "storeAuthenticated",
      JSON.parse(
        document.querySelector("meta[name='auth']").getAttribute("content")
      )
    );

    this.drawer = JSON.parse(localStorage.getItem("drawer")) || false;
  },

  watch: {
    drawer() {
      localStorage.setItem("drawer", this.drawer);
    },
  },
};
</script>