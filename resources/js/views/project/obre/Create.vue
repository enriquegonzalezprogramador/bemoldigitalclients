<template>
  <v-layout row wrap class="px-3">
    <v-flex xs6 class="offset-xs3 mb-3">
      <v-btn class="mb-3" @click="() => { $router.go(-1) }" color="info"
      >Regresar</v-btn>

      <v-divider></v-divider>
    </v-flex>

    <v-flex xs6 class="offset-xs3 mb-3">
      <v-card>
        <v-card-title>Registrar nueva obra</v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-form ref="form" v-model="valid" :lazy-validation="true"
          >
            <v-container fluid>
              <v-layout row wrap>

                <v-flex xs12>
                  <v-select
                   v-model="obre.project_id" :items="projects" label="Proyecto"
                    outlined item-value="id" item-text="name"
                    required :rules="[rules.required]"
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="obre.name" :rules="[rules.required]" append-icon="mdi-card"
                    label="Nombre"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="obre.description" :rules="[rules.required]" append-icon="mdi-card"
                    label="Descripcion"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="obre.address" append-icon="mdi-card"
                    label="Direccion"
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
                        label="Fecha de inicio"
                        v-model="obre.start_date"
                        prepend-inner-icon="mdi-calendar"
                        v-on="on"
                        readonly
                        outlined
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="obre.start_date"
                      no-title
                      @input="menu1 = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>

                <v-flex xs12>
                  <v-select
                   v-model="obre.employee_id" :items="employees" label="Responsable"
                    outlined item-value="id" item-text="fullname"
                    required :rules="[rules.required]"
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="obre.status"  type="text"
                    append-icon="mdi-card"
                    label="Estado"
                    outlined
                    required
                  ></v-text-field>
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
      valid: true,
      obre: {
        ubication: '',
      },
      rules: {
        required: value => !!value || 'Este campo es requerido.',
        email: value => /.+@.+/.test(value) || 'Debe ser un correo electrónico válido',
      },
      date: new Date().toISOString().substr(0, 10),
      menu1: false,
      projects: [],
      employees: [],
    };
  },
  created() {
    this.getEmployees();
    this.getProjects();
  },
  methods: {
    validateForm() {
      if (this.$refs.form.validate()) this.store();
    },
    store() {
      this.$http.post('/obre', this.obre)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Obra creada exitosamente');
          this.$router.push({ name: 'obre.show', params: { id: res.data.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    getProjects() {
      this.loading = true;
      this.$http.get('/project')
        .then((res) => {
          this.projects = res.data.projects;
          this.loading = false;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
          this.loading = false;
        });
    },
    getEmployees() {
      this.$http.get('/employee')
        .then((res) => {
          this.employees = res.data.employees;
          window.console.log(res.data);
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
