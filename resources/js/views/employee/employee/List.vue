<template>
  <v-layout row wrap>
   <v-flex xs12 class="mb-3 offset-xs9">
      <v-btn color="info" :to="{ name: 'employee.create' }"> Crear empleado </v-btn>
    </v-flex>
    <v-flex xs12 class="mx-3">
      <v-card>
        <v-card-title>
          Lista de empleados

          <v-spacer></v-spacer>

          <v-text-field v-model="search" append-icon="mdi-magnify" label="Buscar..." single-line hide-details >
          </v-text-field>
        </v-card-title>

        <v-card-text>
          <v-data-table :headers="headers" :items="employees" :search="search" :loading="loading"
           loading-text="Cargando..." :footer-props="{'items-per-page-options': [10, 20, 50, 100]}"
           >
            <template v-slot:item.action="{ item }">
              <v-tooltip bottom color="info">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/employee/show/${item.id}`"
                  >
                    <v-icon v-on="on" small > mdi-eye </v-icon>
                  </v-btn>
                </template>
                <span>Ver</span>
              </v-tooltip>

              <v-tooltip bottom color="success">
                <template v-slot:activator="{ on }">
                  <v-btn icon small text :to="`/employee/edit/${item.id}`"
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
        <v-card-title class="headline">¿Desea eliminar este empleado?</v-card-title>
        <v-card-text>Esta acción no puede deshacerse</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="displayDeleteDialog = false">Cancelar</v-btn>
          <v-btn color="error" text @click="deleteEmployee">Si, eliminar</v-btn>
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
      deleteDialogEmployee: {},
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
          text: 'DNI',
          value: 'dni',
        },
        {
          text: 'Nombre',
          value: 'first_name',
        },
        {
          text: 'Apellido',
          value: 'last_name',
        },
        {
          text: 'Telefono',
          value: 'phone',
        },
        {
          text: 'Salario',
          value: 'salary',
        },
        {
          text: 'Fecha de inicio',
          value: 'start_date',
        },
        {
          text: 'Cargo',
          value: 'position',
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
      employees: [],
    };
  },
  created() {
    this.getEmployees();
  },
  methods: {
    toggleDeleteDialog(id) {
      this.displayDeleteDialog = true;
      this.deleteDialogUser = this.employees.find(employee => employee.id === id);
    },
    getEmployees() {
      this.loading = true;
      this.$http.get('/employee')
        .then((res) => {
          this.employees = res.data.employees;
          this.loading = false;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
          this.loading = false;
        });
    },
    deleteEmployee() {
      this.$http.delete(`/employee/${this.deleteDialogEmployee.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Empleado eliminado éxitosamente');

          this.displayDeleteDialog = false;
          this.deleteDialogEmployee = {};
          this.getEmployees();
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
