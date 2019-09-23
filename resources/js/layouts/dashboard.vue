<template>
  <v-app>
    <x-app-bar @toggle-drawer="drawer = !drawer"></x-app-bar>
    <x-navigation-drawer :toggle.sync="drawer"></x-navigation-drawer>
    <v-content>
      <v-container fluid>
        <slot/>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import XAppBar from '@/js/components/AppBar.vue';
import XNavigationDrawer from '@/js/components/NavigationDrawer.vue';


export default {
  data() {
    return {
      drawer: true,
    };
  },
  components: {
    XAppBar,
    XNavigationDrawer,
  },
};
</script>
