<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs3">
      <v-card v-if="project">
        <v-card-title>
          Información de Proyecto

          <v-spacer></v-spacer>

          <v-btn @click="displayDeleteDialog = true" color="error"
          >Eliminar Proyecto</v-btn>
        </v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-list two-line>

            <!-- Name -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Nombre</v-list-item-title>
                <v-list-item-subtitle> {{ project.name }} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Description -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Descripcion</v-list-item-title>
                <v-list-item-subtitle>
                 {{ project.description }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Direccion -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Direccion</v-list-item-title>
                <v-list-item-subtitle>{{ project.address }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Phone -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-phone</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Telefono</v-list-item-title>
                <v-list-item-subtitle>{{ project.phone }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Email -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-email</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Correo electrónico</v-list-item-title>
                <v-list-item-subtitle>{{ project.email }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Start Date -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-calendar</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de Inicio</v-list-item-title>
                <v-list-item-subtitle>{{ project.start_date }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Responsable -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Responsable</v-list-item-title>
                <v-list-item-subtitle>{{ employee.first_name }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Created at -->
            <v-list-item>

              <v-list-item-avatar>
                <v-icon>mdi-calendar-import</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de creación</v-list-item-title>
                <v-list-item-subtitle>{{ project.created_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Updated at -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-calendar-edit</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Última actualización</v-list-item-title>
                <v-list-item-subtitle>{{ project.updated_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn :to="{ name: 'project.list' }" color="info"
          >Ir al listado de proyectos</v-btn>

          <v-btn :to="{ name: 'project.edit', params: { id: project.id } }" color="success"
          >Editar información</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>

    <v-dialog v-model="displayDeleteDialog" persistent max-width="400">
      <v-card>
        <v-card-title class="headline">¿Desea eliminar este proyecto?</v-card-title>
        <v-card-text>Está acción no puede deshacerse</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="displayDeleteDialog = false">Cancelar</v-btn>
          <v-btn color="error" text @click="deleteProject">Si, eliminar</v-btn>
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
      project: {},
      employee: {},
      displayDeleteDialog: false,
    };
  },
  created() {
    this.findProject();
  },
  methods: {
    findProject() {
      this.$http.get(`/project/${this.$route.params.id}`)
        .then((res) => {
          this.project = res.data.project;
          this.employee = res.data.project.employee;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    deleteProject() {
      this.$http.delete(`/project/${this.project.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Proyecto eliminado éxitosamente');
          this.$router.push({ name: 'employee.list' });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
