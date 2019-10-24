<template>
  <v-layout row wrap>
   <v-flex xs12 class="mb-3 offset-xs9">
      <v-btn color="info" :to="{ name: 'requirementmaterial.create' }"> Registrar Requerimiento </v-btn>
    </v-flex>
    <v-flex xs12 class="mx-3">
      <v-card>
        <v-card-title>
         Lista de requerimientos

          <v-spacer></v-spacer>

          <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar..." single-line hide-details >
          </v-text-field>
        </v-card-title>

        <v-card-text>
          <v-data-table :headers="headers"  :search="search" :loading="loading" loading-text="Cargando..."
            :items="requirementmaterials" :footer-props="{'items-per-page-options': [10, 20, 50, 100]}"
           >
            <template v-slot:item.action="{ item }">
              <v-tooltip bottom color="info">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/requirementmaterial/show/${item.id}`"
                  >
                    <v-icon v-on="on" small > mdi-eye </v-icon>
                  </v-btn>
                </template>
                <span>Ver</span>
              </v-tooltip>

              <v-tooltip bottom color="success">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/requirementmaterial/edit/${item.id}`"
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
        <v-card-title class="headline">¿Desea eliminar  este requerimiento?</v-card-title>
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
      warehouse: {},
      inventary: {},
      employee: {},
      headers: [
        {
          text: '#',
          value: 'id',
        },
        {
          text: 'Actividad',
          value: 'activity',
        },
        {
          text: 'Material',
          value: 'inventary.description',
        },
        {
          text: 'En almacen',
          value: 'inventary.quantity',
        },
        {
          text: 'Solicitado',
          value: 'quantity',
        },
        {
          text: 'Precio',
          value: 'price',
        },
        {
          text: 'Total /S',
          value: 'total',
        },
        {
          text: 'Entregado',
          value: 'deliveried',
        },
        {
          text: 'Falta entregar',
          value: 'notdeliveried',
        },
        {
          text: 'Fecha Requerimiento',
          value: 'start_date',
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
      requirementmaterials: [],
    };
  },
  created() {
    this.getRequirementmaterials();
  },
  methods: {
    toggleDeleteDialog(id) {
      this.displayDeleteDialog = true;
      this.deleteDialogRegister = this.requirementmaterials.find(requirementmaterial => requirementmaterial.id === id);
    },
    getRequirementmaterials() {
      this.loading = true;
      this.$http.get('/requirementmaterial')
        .then((res) => {
          window.console.log(res);
          this.requirementmaterials = res.data.requirementmaterials;
          this.project = res.data.requirementmaterials.project;
          this.warehouse = res.data.requirementmaterials.warehouse;
          this.inventary = res.data.requirementmaterials.inventary;
          this.employee = res.data.requirementmaterials.employee;
          this.loading = false;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
          this.loading = false;
        });
    },
    deleteRegister() {
      this.$http.delete(`/requirementmaterial/${this.deleteDialogRegister.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Requerimiento eliminado éxitosamente');

          this.displayDeleteDialog = false;
          this.deleteDialogRegister = {};
          this.getRequirementmaterials();
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
