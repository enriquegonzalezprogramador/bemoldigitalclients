<template>
  <v-app-bar app clipped-left color="red" dark flat
  >
    <v-app-bar-nav-icon @click="() => { this.$emit('toggle-drawer') }"
    ></v-app-bar-nav-icon>

    <img src="/img/ac.png" width="45px" height="45px">

    <v-toolbar-title class="ml-4">AID CORPORACION</v-toolbar-title>

    <v-spacer></v-spacer>


  </v-app-bar>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      title: 'Obras',
    };
  },
  computed: {
    ...mapGetters({
      // isLoggedIn: 'auth/isLoggedIn',
      // authUser: 'auth/authUser',
    }),
  },
  created() {
    this.title = document.title;
  },
  methods: {

  },
};
</script>
