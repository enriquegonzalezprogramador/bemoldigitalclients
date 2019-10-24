<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs3">
      <v-card v-if="inventary">
        <v-card-title>
          Información de Material

          <v-spacer></v-spacer>

          <v-btn @click="displayDeleteDialog = true" color="error"
          >Eliminar Registro</v-btn>
        </v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-list two-line>

            <!-- Almacen -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-home-variant-outline</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Almacen</v-list-item-title>
                <v-list-item-subtitle> {{ warehouse.name }} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Name -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Descripcion</v-list-item-title>
                <v-list-item-subtitle>
                 {{ inventary.description }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Provider -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Proveedor</v-list-item-title>
                <v-list-item-subtitle>{{ inventary.provider }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Category -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Categoria</v-list-item-title>
                <v-list-item-subtitle>{{ inventary.category }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Quantity -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Cantidad</v-list-item-title>
                <v-list-item-subtitle>{{ inventary.quantity }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Observation -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Observacion</v-list-item-title>
                <v-list-item-subtitle>{{ inventary.observation }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Created at -->
            <v-list-item>

              <v-list-item-avatar>
                <v-icon>mdi-calendar-import</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de creación</v-list-item-title>
                <v-list-item-subtitle>{{ inventary.created_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Updated at -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-calendar-edit</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Última actualización</v-list-item-title>
                <v-list-item-subtitle>{{ inventary.updated_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn :to="{ name: 'inventary.list' }" color="info"
          >Ir al listado de Materiales</v-btn>

          <v-btn :to="{ name: 'inventary.edit', params: { id: inventary.id } }" color="success"
          >Editar información</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>

    <v-dialog v-model="displayDeleteDialog" persistent max-width="400">
      <v-card>
        <v-card-title class="headline">¿Desea eliminar este material?</v-card-title>
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
      inventary: {},
      warehouse: {},
      displayDeleteDialog: false,
    };
  },
  created() {
    this.findInventary();
  },
  methods: {
    findInventary() {
      this.$http.get(`/inventary/${this.$route.params.id}`)
        .then((res) => {
          this.inventary = res.data.inventary;
          this.warehouse = res.data.inventary.warehouse;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    deleteRegister() {
      this.$http.delete(`/inventary/${this.inventary.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Registro eliminado éxitosamente');
          this.$router.push({ name: 'inventary.list' });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
