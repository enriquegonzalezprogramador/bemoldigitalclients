<template>
  <v-layout row wrap>
   <v-flex xs12 class="mb-3 offset-xs9">
      <v-btn color="info" :to="{ name: 'activity.create' }"> Registrar Actividad </v-btn>
    </v-flex>
    <v-flex xs12 class="mx-3">
      <v-card>
        <v-card-title>
         Lista de actividades

          <v-spacer></v-spacer>

          <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar..." single-line hide-details >
          </v-text-field>
        </v-card-title>

        <v-card-text>
          <v-data-table :headers="headers"  :search="search" :loading="loading" loading-text="Cargando..."
            :items="activitys" :footer-props="{'items-per-page-options': [10, 20, 50, 100]}"
           >
            <template v-slot:item.action="{ item }">
              <v-tooltip bottom color="info">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/activity/show/${item.id}`"
                  >
                    <v-icon v-on="on" small > mdi-eye </v-icon>
                  </v-btn>
                </template>
                <span>Ver</span>
              </v-tooltip>

              <v-tooltip bottom color="success">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/activity/edit/${item.id}`"
                  >
                    <v-icon  v-on="on"  small
                    >mdi-pencil</v-icon>
                  </v-btn>
                </template>
                <span>Editar</span>
              </v-tooltip>

              <v-tooltip bottom color="error">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text @click="toggleDeleteDialog(item.id)"
                  >
                    <v-icon v-on="on" small
                    >mdi-trash-can</v-icon>
                  </v-btn>
                </template>
                <span>Eliminar</span>
              </v-tooltip>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-flex>

    <v-dialog v-model="displayDeleteDialog" persistent max-width="350">
      <v-card>
        <v-card-title class="headline">¿Desea eliminar  esta actividad?</v-card-title>
        <v-card-text>Esta acción no puede deshacerse</v-card-text>
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
      loading: false,
      search: '',
      displayDeleteDialog: false,
      deleteDialogRegister: {},
      serverPagination: {
        page: 1,
        rowsNumber: 10,
      },
      project: {},
      obre: {},
      warehouse: {},
      employee: {},
      headers: [
        {
          text: '#',
          value: 'id',
        },
        {
          text: 'Obra',
          value: 'obre.name',
        },
        {
          text: 'Actividad',
          value: 'activity',
        },
        {
          text: 'Encargado',
          value: 'employee.first_name',
        },
        {
          text: 'Fecha de Actividad',
          value: 'start_date',
        },
        {
          text: 'Estado de Actividad',
          value: 'status',
        },
        {
          text: 'Acciones',
          value: 'action',
          sortable: false,
        },
      ],
      activitys: [],
    };
  },
  created() {
    this.getActivitys();
  },
  methods: {
    toggleDeleteDialog(id) {
      this.displayDeleteDialog = true;
      this.deleteDialogRegister = this.activitys.find(activity => activity.id === id);
    },
    getActivitys() {
      this.loading = true;
      this.$http.get('/activity')
        .then((res) => {
          window.console.log(res);
          this.activitys = res.data.activitys;
          this.project = res.data.activitys.project;
          this.obre = res.data.activitys.obre;
          this.employee = res.data.activitys.employee;
          this.loading = false;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
          this.loading = false;
        });
    },
    deleteRegister() {
      this.$http.delete(`/activity/${this.deleteDialogRegister.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Actividad eliminada éxitosamente');

          this.displayDeleteDialog = false;
          this.deleteDialogRegister = {};
          this.getActivitys();
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
