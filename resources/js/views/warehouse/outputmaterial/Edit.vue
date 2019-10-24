<template>
  <v-layout row wrap class="px-3">
    <v-flex xs6 class="offset-xs3 mb-3">
      <v-btn class="mb-3" @click="() => { $router.go(-1) }" color="info"
      >Regresar</v-btn>

      <v-divider></v-divider>
    </v-flex>

    <v-flex xs6 class="offset-xs3 mb-3">
      <v-card>
        <v-card-title>Modificar Registro</v-card-title>

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
                  <v-select
                   v-model="baseFields.obre_id" :items="obres" label="Obra"
                    outlined item-value="id" item-text="name"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs6>
                  <v-select
                   v-model="baseFields.warehouse_id" :items="warehouses" label="Almacen"
                    outlined item-value="id" item-text="name"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs6>
                  <v-select
                   v-model="baseFields.inventary_id" :items="inventarys" label="Material"
                    outlined item-value="id" item-text="description"
                    required
                  ></v-select>
                </v-flex>

              </v-layout>
              <v-layout row wrap>
                <v-flex xs12>
                  <v-text-field v-model="baseFields.quantity"  append-icon="mdi-card" label="Cantidad" outlined
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="baseFields.price"  append-icon="mdi-card" label="Precio" outlined
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <v-select
                   v-model="baseFields.employee_id" :items="employees" label="Responsable"
                    outlined item-value="id" item-text="first_name"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs12>
                  <v-text-field v-model="baseFields.observation"  append-icon="mdi-card" label="Observacion" outlined
                    required
                  ></v-text-field>
                </v-flex>
                <v-flex xs12>
                  <!-- Start Date -->
                  <v-menu
                    v-model="menu1"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    full-width
                    max-width="290px"
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        label="Fecha de salida"
                        v-model="baseFields.start_date"
                        prepend-inner-icon="mdi-calendar"
                        v-on="on"
                        readonly
                        outlined
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="baseFields.start_date"
                      no-title
                      @input="menu1 = false"
                    ></v-date-picker>
                  </v-menu>
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
      date: new Date().toISOString().substr(0, 10),
      menu1: false,
      projects: [],
      obres: [],
      warehouses: [],
      inventarys: [],
      employees: [],
      baseFields: {},
      outputmaterial: {},
    };
  },
  created() {
    this.findOutputmaterial();
    this.getEmployees();
    this.getProjects();
    this.getObres();
    this.getWarehouses();
    this.getInventarys();
  },
  methods: {
    findOutputmaterial() {
      this.$http.get(`/outputmaterial/${this.$route.params.id}`)
        .then((res) => {
          this.outputmaterial = res.data.outputmaterial;
          this.baseFields = this.outputmaterial;
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
    getObres() {
      this.$http.get('/obre')
        .then((res) => {
          this.obres = res.data.obres;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    getWarehouses() {
      this.$http.get('/warehouse')
        .then((res) => {
          this.warehouses = res.data.warehouses;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    getInventarys() {
      this.$http.get('/inventary')
        .then((res) => {
          this.inventarys = res.data.inventarys;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    edit() {
      const data = this.baseFields;
      window.console.log(data);

      this.$http.patch(`/outputmaterial/${this.outputmaterial.id}`, this.baseFields)
        .then((res) => {
          window.console.log(res);
          this.$store.dispatch('snackbar/success', 'Registro de salida editado éxitosamente');
          this.$router.push({ name: 'outputmaterial.show', params: { id: this.outputmaterial.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
