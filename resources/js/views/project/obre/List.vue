<template>
  <v-layout row wrap>
   <v-flex xs12 class="mb-3 offset-xs9">
      <v-btn color="info" :to="{ name: 'obre.create' }"> Registrar nueva obra </v-btn>
    </v-flex>
    <v-flex xs12 class="mx-3">
      <v-card>
        <v-card-title>
          Lista de obras

          <v-spacer></v-spacer>

          <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar..." single-line hide-details >
          </v-text-field>
        </v-card-title>

        <v-card-text>
          <v-data-table :headers="headers"  :search="search" :loading="loading" loading-text="Cargando..."
            :items="obres" :footer-props="{'items-per-page-options': [10, 20, 50, 100]}"
           >
            <template v-slot:item.action="{ item }">
              <v-tooltip bottom color="info">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/obre/show/${item.id}`"
                  >
                    <v-icon v-on="on" small > mdi-eye </v-icon>
                  </v-btn>
                </template>
                <span>Ver</span>
              </v-tooltip>

              <v-tooltip bottom color="success">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/obre/edit/${item.id}`"
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
        <v-card-title class="headline">¿Desea eliminar esta obra?</v-card-title>
        <v-card-text>Esta acción no puede deshacerse</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="displayDeleteDialog = false">Cancelar</v-btn>
          <v-btn color="error" text @click="deleteObre">Si, eliminar</v-btn>
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
      deleteDialogObre: {},
      serverPagination: {
        page: 1,
        rowsNumber: 10,
      },
      headers: [
        {
          text: '#',
          value: 'id',
        },
        {
          text: 'Proyecto',
          value: 'project.name',
        },
        {
          text: 'Nombre',
          value: 'name',
        },
        {
          text: 'Descripcion',
          value: 'description',
        },
        {
          text: 'Direccion',
          value: 'address',
        },
        {
          text: 'Fecha de Inicio',
          value: 'start_date',
        },
        {
          text: 'Responsable',
          value: 'employee.first_name',
        },
        {
          text: 'Estado',
          value: 'status',
        },
        {
          text: 'Acciones',
          value: 'action',
          sortable: false,
        },
      ],
      obres: [],
    };
  },
  created() {
    this.getObres();
  },
  methods: {
    toggleDeleteDialog(id) {
      this.displayDeleteDialog = true;
      this.deleteDialogObre = this.obres.find(obre => obre.id === id);
    },
    getObres() {
      this.loading = true;
      this.$http.get('/obre')
        .then((res) => {
          this.obres = res.data.obres;
          this.loading = false;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
          this.loading = false;
        });
    },
    deleteObre() {
      this.$http.delete(`/obre/${this.deleteDialogProject.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Obra eliminada éxitosamente');

          this.displayDeleteDialog = false;
          this.deleteDialogObre = {};
          this.getObres();
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
