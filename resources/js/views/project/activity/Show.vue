<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs3">
      <v-card v-if="activity">
        <v-card-title>
          Información de Actividad

          <v-spacer></v-spacer>

          <v-btn @click="displayDeleteDialog = true" color="error"
          >Eliminar Registro</v-btn>
        </v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-list two-line>

            <!-- Proyecto -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Proyecto</v-list-item-title>
                <v-list-item-subtitle> {{ project.name }} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Almacen -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-home-variant-outline</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Almacen</v-list-item-title>
                <v-list-item-subtitle> {{ obre.name }} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!--  Activity -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Actividad</v-list-item-title>
                <v-list-item-subtitle>
                 {{ activity.activity }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Responsable -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Responsable</v-list-item-title>
                <v-list-item-subtitle>{{ employee.first_name }}  {{ employee.last_name }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Observation -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Observacion</v-list-item-title>
                <v-list-item-subtitle>{{ activity.observation }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Strat Date -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de solicitud</v-list-item-title>
                <v-list-item-subtitle>{{ activity.start_date }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Status -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Estado</v-list-item-title>
                <v-list-item-subtitle>{{ activity.status }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Created at -->
            <v-list-item>

              <v-list-item-avatar>
                <v-icon>mdi-calendar-import</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de creación</v-list-item-title>
                <v-list-item-subtitle>{{ activity.created_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Updated at -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-calendar-edit</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Última actualización</v-list-item-title>
                <v-list-item-subtitle>{{ activity.updated_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn :to="{ name: 'activity.list' }" color="info"
          >Ir al listado de registros</v-btn>

          <v-btn :to="{ name: 'activity.edit', params: { id: activity.id } }" color="success"
          >Editar información</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>

    <v-dialog v-model="displayDeleteDialog" persistent max-width="400">
      <v-card>
        <v-card-title class="headline">¿Desea eliminar esta actividad?</v-card-title>
        <v-card-text>Está acción no puede deshacerse</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="displayDeleteDialog = false">Cancelar</v-btn>
          <v-btn color="error" text @click="deleteRegister">Si, eliminar</v-btn>
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
      employee: {},
      project: {},
      obre: {},
      activity: {},
      displayDeleteDialog: false,
    };
  },
  created() {
    this.findActivity();
  },
  methods: {
    findActivity() {
      this.$http.get(`/activity/${this.$route.params.id}`)
        .then((res) => {
          this.activity = res.data.activity;
          this.employee = res.data.activity.employee;
          this.project = res.data.activity.project;
          this.obre = res.data.activity.obre;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    deleteRegister() {
      this.$http.delete(`/activity/${this.outputmaterial.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Actividad eliminada éxitosamente');
          this.$router.push({ name: 'activity.list' });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
