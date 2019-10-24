<template>
  <v-layout row wrap class="px-3">
    <v-flex xs6 class="offset-xs3 mb-3">
      <v-btn class="mb-3" @click="() => { $router.go(-1) }" color="info"
      >Regresar</v-btn>

      <v-divider></v-divider>
    </v-flex>

    <v-flex xs6 class="offset-xs3 mb-3">
      <v-card>
        <v-card-title>Modificar empleado</v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-form @submit.prevent>
            <v-container fluid grid-list-xs>
              <v-layout row wrap >
                <v-flex xs6>
                  <v-text-field v-model="baseFields.dni" append-icon="mdi-card" label="DNI" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs6>
                  <v-text-field v-model="baseFields.first_name" append-icon="mdi-account" label=" Primer Nombre"
                    required outlined
                  ></v-text-field>
                </v-flex>

                <v-flex xs6>
                  <v-text-field v-model="baseFields.second_name" append-icon="mdi-account" label=" Segundo Nombre"
                    required outlined
                  ></v-text-field>
                </v-flex>

                <v-flex xs6>
                  <v-text-field v-model="baseFields.last_name" append-icon="mdi-account" label="Apellido" outlined
                    required
                  ></v-text-field>
                </v-flex>
              </v-layout>
              <v-layout row wrap>
                <v-flex xs12>
                  <v-text-field v-model="baseFields.phone" type="text" append-icon="mdi-phone" label="Telefono" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="baseFields.email" type="email" append-icon="mdi-email" label="Correo" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="baseFields.salary" type="text" append-icon="mdi-card" label="Salario" outlined
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

                <v-flex xs12>
                  <v-text-field v-model="baseFields.position" type="text" append-icon="mdi-card" label="Cargo" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-select v-model="baseFields.status" :rules="[rules.required]" :items="type" label="Estado"
                    outlined
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
      menu1: false,
      type: ['Activo', 'Despedido', 'Suspendido'],
      rules: {
        required: value => !!value || 'Este campo es requerido.',
        email: value => /.+@.+/.test(value) || 'Debe ser un correo electrónico válido',
      },
      employee: {},
      baseFields: {},
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
          this.baseFields = this.employee;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    edit() {
      const data = this.baseFields;
      window.console.log(data);

      this.$http.patch(`/employee/${this.employee.id}`, this.baseFields)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Empleado editado éxitosamente');
          this.$router.push({ name: 'employee.show', params: { id: this.employee.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
