<template>
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <v-app-bar app clipped-left color="#0078AA" dark flat
  >
    <v-app-bar-nav-icon @click="() => { this.$emit('toggle-drawer') }"
    ></v-app-bar-nav-icon>

    <img src="/img/Bemol.logo.png" width="45px" height="45px">

    <v-toolbar-title class="ml-4">Bemoldigital</v-toolbar-title>

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
