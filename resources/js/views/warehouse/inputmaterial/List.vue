<template>
  <v-layout row wrap>
   <v-flex xs12 class="mb-3 offset-xs9">
      <v-btn color="info" :to="{ name: 'inputmaterial.create' }"> Registrar Entrada Material </v-btn>
    </v-flex>
    <v-flex xs12 class="mx-3">
      <v-card>
        <v-card-title>
         Lista de entrada de Material

          <v-spacer></v-spacer>

          <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar..." single-line hide-details >
          </v-text-field>
        </v-card-title>

        <v-card-text>
          <v-data-table :headers="headers"  :search="search" :loading="loading" loading-text="Cargando..."
            :items="inputmaterials" :footer-props="{'items-per-page-options': [10, 20, 50, 100]}"
           >
            <template v-slot:item.action="{ item }">
              <v-tooltip bottom color="info">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/inputmaterial/show/${item.id}`"
                  >
                    <v-icon v-on="on" small > mdi-eye </v-icon>
                  </v-btn>
                </template>
                <span>Ver</span>
              </v-tooltip>

              <v-tooltip bottom color="success">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/inputmaterial/edit/${item.id}`"
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
        <v-card-title class="headline">¿Desea eliminar  este registro?</v-card-title>
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
      employee: {},
      headers: [
        {
          text: '#',
          value: 'id',
        },
        {
          text: 'Material',
          value: 'inventary.description',
        },
        {
          text: 'Proveedor',
          value: 'inventary.provider',
        },
        {
          text: 'Cantidad',
          value: 'quantity',
        },
        {
          text: 'Precio',
          value: 'price',
        },
        {
          text: 'Total',
          value: 'total',
        },
        {
          text: 'Responsable',
          value: 'employee.first_name',
        },
        {
          text: 'Observacion',
          value: 'observation',
        },
        {
          text: 'Fecha Ingreso',
          value: 'start_date',
        },
        {
          text: 'Acciones',
          value: 'action',
          sortable: false,
        },
      ],
      inputmaterials: [],
    };
  },
  created() {
    this.getInputmaterials();
  },
  methods: {
    toggleDeleteDialog(id) {
      this.displayDeleteDialog = true;
      this.deleteDialogRegister = this.inputmaterials.find(inputmaterial => inputmaterial.id === id);
    },
    getInputmaterials() {
      this.loading = true;
      this.$http.get('/inputmaterial')
        .then((res) => {
          window.console.log(res);
          this.inputmaterials = res.data.inputmaterials;
          this.project = res.data.inputmaterials.project;
          this.warehouse = res.data.inputmaterials.warehouse;
          this.employee = res.data.inputmaterials.employee;
          this.loading = false;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
          this.loading = false;
        });
    },
    deleteRegister() {
      this.$http.delete(`/inputmaterial/${this.deleteDialogRegister.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Registro eliminado éxitosamente');

          this.displayDeleteDialog = false;
          this.deleteDialogRegister = {};
          this.getInputmaterials();
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
