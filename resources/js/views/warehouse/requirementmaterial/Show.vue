<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs3">
      <v-card v-if="requirementmaterial">
        <v-card-title>
          Información de Requerimiento

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

            <!--  Activity -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-account</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Actividad</v-list-item-title>
                <v-list-item-subtitle>
                 {{ requirementmaterial.activity }}</v-list-item-subtitle>
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
                 {{ requirementmaterial.quantity }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Price -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Precio</v-list-item-title>
                <v-list-item-subtitle>{{ requirementmaterial.price }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Deliveried -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Entregado</v-list-item-title>
                <v-list-item-subtitle>{{ requirementmaterial.deliveried }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Responsable -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Encargado</v-list-item-title>
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
                <v-list-item-subtitle>{{ requirementmaterial.observation }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Strat Date -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de solicitud</v-list-item-title>
                <v-list-item-subtitle>{{ requirementmaterial.start_date }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Status -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-card</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Estado</v-list-item-title>
                <v-list-item-subtitle>{{ requirementmaterial.status }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Created at -->
            <v-list-item>

              <v-list-item-avatar>
                <v-icon>mdi-calendar-import</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Fecha de creación</v-list-item-title>
                <v-list-item-subtitle>{{ requirementmaterial.created_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <!-- Updated at -->
            <v-list-item>
              <v-list-item-avatar>
                <v-icon>mdi-calendar-edit</v-icon>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>Última actualización</v-list-item-title>
                <v-list-item-subtitle>{{ requirementmaterial.updated_at }}</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn :to="{ name: 'requirementmaterial.list' }" color="info"
          >Ir al listado de registros</v-btn>

          <v-btn :to="{ name: 'requirementmaterial.edit', params: { id: requirementmaterial.id } }" color="success"
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
      warehouse: {},
      inventary: {},
      requirementmaterial: {},
      displayDeleteDialog: false,
    };
  },
  created() {
    this.findRequirementmaterial();
  },
  methods: {
    findRequirementmaterial() {
      this.$http.get(`/requirementmaterial/${this.$route.params.id}`)
        .then((res) => {
          this.requirementmaterial = res.data.requirementmaterial;
          this.employee = res.data.requirementmaterial.employee;
          this.project = res.data.requirementmaterial.project;
          this.warehouse = res.data.requirementmaterial.warehouse;
          this.inventary = res.data.requirementmaterial.inventary;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    deleteRegister() {
      this.$http.delete(`/requirementmaterial/${this.outputmaterial.id}`)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Requerimiento eliminado éxitosamente');
          this.$router.push({ name: 'requirementmaterial.list' });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
