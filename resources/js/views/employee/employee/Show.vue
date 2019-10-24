<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs3">
      <v-card v-if="employee">
        <v-card-title>
          Información del empleado

          <v-spacer></v-spacer>

          <v-btn @click="displayDeleteDialog = true" color="error"
          >Eliminar empleado</v-btn>
        </v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-list two-line>

            <!-- DNI-->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>DNI</v-list-item-title>
                <v-list-item-subtitle>{{ employee.dni }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- First name & Last name -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Nombre completo</v-list-item-title>
                <v-list-item-subtitle>{{ employee.first_name }} {{employee.last_name}} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Phone -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-phone</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Telefono</v-list-item-title>
                <v-list-item-subtitle>{{ employee.phone }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Email -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-email</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Correo electrónico</v-list-item-title>
                <v-list-item-subtitle>{{ employee.email }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

         <!-- start Date -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de Inicio</v-list-item-title>
                <v-list-item-subtitle>{{ employee.start_date }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Salary -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Salario</v-list-item-title>
                <v-list-item-subtitle>{{ employee.salary }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Created at -->
            <v-list-item>

              <v-list-item-avatar>
                <v-icon>mdi-calendar-import</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de creación</v-list-item-title>
                <v-list-item-subtitle>{{ employee.created_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Updated at -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-calendar-edit</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Última actualización</v-list-item-title>
                <v-list-item-subtitle>{{ employee.updated_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn :to="{ name: 'employee.list' }" color="info"
          >Ir al listado de empleados</v-btn>

          <v-btn :to="{ name: 'employee.edit', params: { id: employee.id } }" color="success"
          >Editar información</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>

    <v-dialog v-model="displayDeleteDialog" persistent max-width="400">
      <v-card>
        <v-card-title class="headline">¿Desea eliminar a este empleado?</v-card-title>
        <v-card-text>Está acción no puede deshacerse</v-card-text>
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
      employee: {},
      displayDeleteDialog: false,
    };
  },
  created() {
    this.findEmployee();
  },
  methods: {
    findEmployee() {
      this.$http.get(`/employee/${this.$route.params.id}`)
        .then((res) => {
          this.employee = res.data.employee;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    deleteEmployee() {
      this.$http.delete(`/employee/${this.user.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Empleado eliminado éxitosamente');
          this.$router.push({ name: 'employee.list' });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
