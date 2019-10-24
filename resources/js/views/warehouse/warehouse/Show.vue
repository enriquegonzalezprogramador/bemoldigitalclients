<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs3">
      <v-card v-if="warehouse">
        <v-card-title>
          Información de Almacen

          <v-spacer></v-spacer>

          <v-btn @click="displayDeleteDialog = true" color="error"
          >Eliminar Almacen</v-btn>
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

            <!-- Name -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-home-variant-outline</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Nombre</v-list-item-title>
                <v-list-item-subtitle>
                 {{ warehouse.name }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Address -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Direccion</v-list-item-title>
                <v-list-item-subtitle>{{ warehouse.address }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- City -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Ciudad</v-list-item-title>
                <v-list-item-subtitle>{{ warehouse.city }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Phone -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-phone</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Telefono</v-list-item-title>
                <v-list-item-subtitle>{{ warehouse.phone }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Encargado -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Encargado</v-list-item-title>
                <v-list-item-subtitle> {{ employee.first_name }} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Created at -->
            <v-list-item>

              <v-list-item-avatar>
                <v-icon>mdi-calendar-import</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de creación</v-list-item-title>
                <v-list-item-subtitle>{{ warehouse.created_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Updated at -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-calendar-edit</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Última actualización</v-list-item-title>
                <v-list-item-subtitle>{{ warehouse.updated_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn :to="{ name: 'warehouse.list' }" color="info"
          >Ir al listado de almacenes</v-btn>

          <v-btn :to="{ name: 'warehouse.edit', params: { id: warehouse.id } }" color="success"
          >Editar información</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>

    <v-dialog v-model="displayDeleteDialog" persistent max-width="400">
      <v-card>
        <v-card-title class="headline">¿Desea eliminar a este almacen?</v-card-title>
        <v-card-text>Está acción no puede deshacerse</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="displayDeleteDialog = false">Cancelar</v-btn>
          <v-btn color="error" text @click="deleteWarehouse">Si, eliminar</v-btn>
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
      warehouse: {},
      project: {},
      employee: {},
      displayDeleteDialog: false,
    };
  },
  created() {
    this.findWarehouse();
  },
  methods: {
    findWarehouse() {
      this.$http.get(`/warehouse/${this.$route.params.id}`)
        .then((res) => {
          this.warehouse = res.data.warehouse;
          this.project = res.data.warehouse.project;
          this.employee = res.data.warehouse.employee;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    deleteWarehouse() {
      this.$http.delete(`/warehouse/${this.warehouse.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Almacen eliminado éxitosamente');
          this.$router.push({ name: 'warehouse.list' });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
