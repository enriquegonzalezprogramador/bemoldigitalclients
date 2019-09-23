<template>
  <v-navigation-drawer :value="toggle" app clipped >
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="title text-center" >
         Menu
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

    <v-list dense nav>

      <v-list-group prepend-icon="mdi-account-group-outline" value="false" v-model="users"
      >
        <template v-slot:activator>
          <v-list-item-title>Usuarios</v-list-item-title>
        </template>

          <!-- Users -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'user.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-account-tie</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Lista de usuarios</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

      </v-list-group>

    </v-list>

    <template v-slot:append v-if="isLoggedIn">
      <div class="pa-2">
        <v-btn @click="logout" color="secondary" block outlined
        ><v-icon>mdi-power</v-icon>Cerrar sesion</v-btn>
      </div>
    </template>
  </v-navigation-drawer>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      users: false,
    };
  },
  props: {
    toggle: Boolean,
  },
  computed: {
    ...mapGetters({
      isLoggedIn: 'auth/isLoggedIn',
      authUser: 'auth/authUser',
    }),
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout');
      this.$router.push({ name: 'login' });
    },
  },
};
</script>
