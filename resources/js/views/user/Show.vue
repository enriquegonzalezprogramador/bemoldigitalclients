<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs3">
      <v-card v-if="user">
        <v-card-title>
          Información del usuario

          <v-spacer></v-spacer>

          <v-btn @click="displayDeleteDialog = true" color="error"
          >Eliminar usuario</v-btn>
        </v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-list two-line>

            <!-- First name & Last name -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Nombre completo</v-list-item-title>
                <v-list-item-subtitle>{{ user.first_name }} {{user.last_name}} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Email -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-email</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Correo electrónico</v-list-item-title>
                <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Type -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account-tie</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Tipo de usuario</v-list-item-title>
                <v-list-item-subtitle>{{ user.type }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Created at -->
            <v-list-item>

              <v-list-item-avatar>
                <v-icon>mdi-calendar-import</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de creación</v-list-item-title>
                <v-list-item-subtitle>{{ user.created_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Updated at -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-calendar-edit</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Última actualización</v-list-item-title>
                <v-list-item-subtitle>{{ user.updated_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn :to="{ name: 'user.list' }" color="info"
          >Ir al listado de usuarios</v-btn>

          <v-btn :to="{ name: 'user.edit', params: { id: user.id } }" color="success"
          >Editar información</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>

    <v-dialog v-model="displayDeleteDialog" persistent max-width="400">
      <v-card>
        <v-card-title class="headline">¿Desea eliminar a este usuario?</v-card-title>
        <v-card-text>Está acción no puede deshacerse</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="displayDeleteDialog = false">Cancelar</v-btn>
          <v-btn color="error" text @click="deleteUser">Si, eliminar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
import statuses from '@/js/statuses';

export default {
  data() {
    return {
      user: {},
      displayDeleteDialog: false,
    };
  },
  created() {
    this.findUser();
  },
  methods: {
    findUser() {
      this.$http.get(`/user/${this.$route.params.id}`)
        .then((res) => {
          this.user = res.data.user;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    deleteUser() {
      this.$http.delete(`/user/${this.user.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Usuario eliminado éxitosamente');
          this.$router.push({ name: 'user.list' });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
