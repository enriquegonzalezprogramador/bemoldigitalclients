<template>
  <v-layout row wrap class="px-3">
    <v-flex xs6 class="offset-xs3 mb-3">
      <v-btn class="mb-3" @click="() => { $router.go(-1) }" color="info"
      >Regresar</v-btn>

      <v-divider></v-divider>
    </v-flex>

    <v-flex xs6 class="offset-xs3 mb-3">
      <v-card>
        <v-card-title>Modificar Almacen</v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-form @submit.prevent>
            <v-container fluid grid-list-xs>
              <v-layout row wrap >
                <v-flex xs6>
                  <v-select
                   v-model="baseFields.project_id" :items="projects" label="Proyecto"
                    outlined item-value="id" item-text="name"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs6>
                  <v-text-field v-model="baseFields.name" append-icon="mdi-account" label="Nombre" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field  append-icon="mdi-card" label="Direccion" outlined
                    required v-model="baseFields.address"
                  ></v-text-field>
                </v-flex>

              </v-layout>
              <v-layout row wrap>
                <v-flex xs6>
                  <v-text-field v-model="baseFields.city" append-icon="mdi-card" label="Ciudad" outlined
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs6>
                  <v-text-field v-model="baseFields.phone"  append-icon="mdi-phone" label="Telefono" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-select
                   v-model="baseFields.employee_id" :items="employees" label="Encargado"
                    outlined item-value="id" item-text="first_name"
                    required
                  ></v-select>
                </v-flex>
              </v-layout>
            </v-container>
          </v-form>

           <v-btn color="info" @click="edit"
          >Actualizar</v-btn>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import statuses from '@/js/statuses';

export default {
  data() {
    return {
      warehouse: {},
      projects: [],
      employees: [],
      baseFields: {},
    };
  },
  created() {
    this.findWarehouse();
    this.getEmployees();
    this.getProjects();
  },
  methods: {
    findWarehouse() {
      this.$http.get(`/warehouse/${this.$route.params.id}`)
        .then((res) => {
          this.warehouse = res.data.warehouse;
          this.baseFields = this.warehouse;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    getEmployees() {
      this.$http.get('/employee')
        .then((res) => {
          this.employees = res.data.employees;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    getProjects() {
      this.$http.get('/project')
        .then((res) => {
          this.projects = res.data.projects;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    edit() {
      const data = this.baseFields;
      window.console.log(data);

      this.$http.patch(`/warehouse/${this.warehouse.id}`, this.baseFields)
        .then((res) => {
          window.console.log(res);
          this.$store.dispatch('snackbar/success', 'Almacen editado éxitosamente');
          this.$router.push({ name: 'warehouse.show', params: { id: this.warehouse.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
