<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs3">
      <v-card v-if="outputmaterial">
        <v-card-title>
          Información de Registro

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
                <v-list-item-subtitle> {{ warehouse.name }} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Obre -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Destino</v-list-item-title>
                <v-list-item-subtitle> {{ obre.name }} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Inventary -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-home-variant-outline</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Material</v-list-item-title>
                <v-list-item-subtitle> {{ inventary.description }} </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Quantity -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Cantidad</v-list-item-title>
                <v-list-item-subtitle>
                 {{ outputmaterial.quantity }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Price -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Precio</v-list-item-title>
                <v-list-item-subtitle>{{ outputmaterial.price }}</v-list-item-subtitle>
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
                <v-list-item-subtitle>{{ outputmaterial.observation }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Strat Date -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de Ingreso</v-list-item-title>
                <v-list-item-subtitle>{{ outputmaterial.start_date }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Created at -->
            <v-list-item>

              <v-list-item-avatar>
                <v-icon>mdi-calendar-import</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de creación</v-list-item-title>
                <v-list-item-subtitle>{{ outputmaterial.created_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Updated at -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-calendar-edit</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Última actualización</v-list-item-title>
                <v-list-item-subtitle>{{ outputmaterial.updated_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn :to="{ name: 'outputmaterial.list' }" color="info"
          >Ir al listado de registros</v-btn>

          <v-btn :to="{ name: 'outputmaterial.edit', params: { id: outputmaterial.id } }" color="success"
          >Editar información</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>

    <v-dialog v-model="displayDeleteDialog" persistent max-width="400">
      <v-card>
        <v-card-title class="headline">¿Desea eliminar este registro?</v-card-title>
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
      warehouse: {},
      inventary: {},
      outputmaterial: {},
      displayDeleteDialog: false,
    };
  },
  created() {
    this.findOutputmaterial();
  },
  methods: {
    findOutputmaterial() {
      this.$http.get(`/outputmaterial/${this.$route.params.id}`)
        .then((res) => {
          this.outputmaterial = res.data.outputmaterial;
          this.employee = res.data.outputmaterial.employee;
          this.project = res.data.outputmaterial.project;
          this.obre = res.data.outputmaterial.obre;
          this.warehouse = res.data.outputmaterial.warehouse;
          this.inventary = res.data.outputmaterial.inventary;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    deleteRegister() {
      this.$http.delete(`/outputmaterial/${this.outputmaterial.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Registro eliminado éxitosamente');
          this.$router.push({ name: 'warehouse.list' });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
