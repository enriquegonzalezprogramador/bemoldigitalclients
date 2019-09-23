<template>
  <div>
    <component :is="layout">
      <router-view></router-view>
    </component>

    <v-snackbar v-model="snackbar.status" :color="snackbar.color"
    >
      {{ snackbar.text }}
      <v-btn color="white" text @click="snackbar.status = false"
      >
        Cerrar
      </v-btn>
    </v-snackbar>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  computed: {
    ...mapState({
      snackbar: state => state.snackbar,
    }),
    layout() {
      return (this.$route.meta.layout || 'dashboard');
    },
  },
};
</script>
