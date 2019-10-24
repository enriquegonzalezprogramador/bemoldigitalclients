<template>
  <v-layout row wrap class="px-3">
    <v-flex xs6 class="offset-xs3 mb-3">
      <v-btn class="mb-3" @click="() => { $router.go(-1) }" color="info"
      >Regresar</v-btn>

      <v-divider></v-divider>
    </v-flex>

    <v-flex xs6 class="offset-xs3 mb-3">
      <v-card>
        <v-card-title>Registrar Salida Material</v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-form ref="form" v-model="valid" :lazy-validation="true"
          >
            <v-container fluid>
              <v-layout row wrap>

                <v-flex xs12>
                  <v-select
                   v-model="outputmaterial.project_id" :items="projects" label="Proyecto"
                    outlined item-value="id" item-text="name"
                    required :rules="[rules.required]"
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-select
                   v-model="outputmaterial.warehouse_id" :items="warehouses" label="Almacen"
                    outlined item-value="id" item-text="name"
                    required :rules="[rules.required]"
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-select
                   v-model="outputmaterial.obre_id" :items="obres" label="Destino"
                    outlined item-value="id" item-text="name"
                    required :rules="[rules.required]"
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-select
                   v-model="outputmaterial.inventary_id" :items="inventarys" label="Material"
                    outlined item-value="id" item-text="description"
                    required :rules="[rules.required]"
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="outputmaterial.quantity" append-icon="mdi-account"
                    label="Cantidad"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="outputmaterial.price"  append-icon="mdi-card"
                    label="Precio"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-select
                   v-model="outputmaterial.employee_id" :items="employees" label="Responsable"
                    outlined item-value="id" item-text="first_name"
                    required :rules="[rules.required]"
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="outputmaterial.observation"
                    append-icon="mdi-card"
                    label="Observacion"
                    outlined
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
                        v-model="outputmaterial.start_date"
                        prepend-inner-icon="mdi-calendar"
                        v-on="on"
                        readonly
                        outlined
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="outputmaterial.start_date"
                      no-title
                      @input="menu1 = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>
              </v-layout>
            </v-container>

            <v-btn @click="validateForm" color="info"
            >Guardar</v-btn>
          </v-form>
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
      valid: true,
      projects: [],
      obres: [],
      warehouses: [],
      inventarys: [],
      employees: [],
      outputmaterial: {
        quantity: 0,
        price: 0,
        observation: 'Ninguna',
      },
      rules: {
        required: value => !!value || 'Este campo es requerido.',
        email: value => /.+@.+/.test(value) || 'Debe ser un correo electrónico válido',
      },
    };
  },
  created() {
    this.getEmployees();
    this.getProjects();
    this.getObres();
    this.getWarehouses();
    this.getInventarys();
  },
  methods: {
    validateForm() {
      if (this.$refs.form.validate()) window.console.log(this.outputmaterial); this.store();
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
    store() {
      this.$http.post('/outputmaterial', this.outputmaterial)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Registro de salida creado exitosamente');
          this.$router.push({ name: 'outputmaterial.show', params: { id: res.data.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
