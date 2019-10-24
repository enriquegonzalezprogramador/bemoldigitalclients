<template>
  <v-layout row wrap class="px-3">
    <v-flex xs6 class="offset-xs3 mb-3">
      <v-btn class="mb-3" @click="() => { $router.go(-1) }" color="info"
      >Regresar</v-btn>

      <v-divider></v-divider>
    </v-flex>

    <v-flex xs6 class="offset-xs3 mb-3">
      <v-card>
        <v-card-title>Modificar Obra</v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-form @submit.prevent>
            <v-container fluid grid-list-xs>
              <v-layout row wrap >

                <v-flex xs6>
                  <v-select
                   v-model="baseFields.project_id" :items="projects" label="Proyecto"
                    outlined item-value="id" item-text="first_name"
                    required
                  ></v-select>
                </v-flex>
                <v-flex xs6>
                  <v-text-field v-model="baseFields.name" append-icon="mdi-card" label="Nombre" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs6>
                  <v-text-field v-model="baseFields.description" append-icon="mdi-card" label="Description" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs6>
                  <v-text-field  append-icon="mdi-card" label="Direccion" outlined
                    required v-model="baseFields.address"
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

                <v-flex xs6>
                  <v-select
                   v-model="baseFields.employee_id" :items="employees" label="Encargado"
                    outlined item-value="id" item-text="first_name"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="baseFields.status"  append-icon="mdi-card" label="Cargo" outlined
                    required
                  ></v-text-field>
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
      obre: {},
      projects: [],
      employees: [],
      baseFields: {},
      date: new Date().toISOString().substr(0, 10),
      menu1: false,
    };
  },
  created() {
    this.findObre();
    this.getProjects();
    this.getEmployees();
  },
  methods: {
    findObre() {
      this.$http.get(`/obre/${this.$route.params.id}`)
        .then((res) => {
          this.obre = res.data.obre;
          this.baseFields = this.obre;
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
    edit() {
      const data = this.baseFields;
      window.console.log(data);

      this.$http.patch(`/obre/${this.obre.id}`, this.baseFields)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Obra editado éxitosamente');
          this.$router.push({ name: 'obre.show', params: { id: this.obre.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
