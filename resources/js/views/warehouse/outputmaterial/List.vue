<template>
  <v-layout row wrap>
   <v-flex xs12 class="mb-3 offset-xs9">
      <v-btn color="info" :to="{ name: 'outputmaterial.create' }"> Registrar Salida de Material </v-btn>
    </v-flex>
    <v-flex xs12 class="mx-3">
      <v-card>
        <v-card-title>
         Lista de salida de Material

          <v-spacer></v-spacer>

          <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar..." single-line hide-details >
          </v-text-field>
        </v-card-title>

        <v-card-text>
          <v-data-table :headers="headers"  :search="search" :loading="loading" loading-text="Cargando..."
            :items="outputmaterials" :footer-props="{'items-per-page-options': [10, 20, 50, 100]}"
           >
            <template v-slot:item.action="{ item }">
              <v-tooltip bottom color="info">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/outputmaterial/show/${item.id}`"
                  >
                    <v-icon v-on="on" small > mdi-eye </v-icon>
                  </v-btn>
                </template>
                <span>Ver</span>
              </v-tooltip>

              <v-tooltip bottom color="success">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/outputmaterial/edit/${item.id}`"
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
      obre: {},
      warehouse: {},
      employee: {},
      headers: [
        {
          text: '#',
          value: 'id',
        },
        {
          text: 'Destino',
          value: 'obre.name',
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
          text: 'Fecha Salida',
          value: 'start_date',
        },
        {
          text: 'Acciones',
          value: 'action',
          sortable: false,
        },
      ],
      outputmaterials: [],
    };
  },
  created() {
    this.getOutputmaterials();
  },
  methods: {
    toggleDeleteDialog(id) {
      this.displayDeleteDialog = true;
      this.deleteDialogRegister = this.outputmaterials.find(outputmaterial => outputmaterial.id === id);
    },
    getOutputmaterials() {
      this.loading = true;
      this.$http.get('/outputmaterial')
        .then((res) => {
          window.console.log(res);
          this.outputmaterials = res.data.outputmaterials;
          this.project = res.data.outputmaterials.project;
          this.obre = res.data.outputmaterials.obre;
          this.warehouse = res.data.outputmaterials.warehouse;
          this.employee = res.data.outputmaterials.employee;
          this.loading = false;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
          this.loading = false;
        });
    },
    deleteRegister() {
      this.$http.delete(`/outputmaterial/${this.deleteDialogRegister.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Registro eliminado éxitosamente');

          this.displayDeleteDialog = false;
          this.deleteDialogRegister = {};
          this.getOutputmaterials();
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
