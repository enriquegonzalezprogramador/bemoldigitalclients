<template>
  <v-layout row wrap class="px-3">
    <v-flex xs6 class="offset-xs3 mb-3">
      <v-btn class="mb-3" @click="() => { $router.go(-1) }" color="info"
      >Regresar</v-btn>

      <v-divider></v-divider>
    </v-flex>

    <v-flex xs6 class="offset-xs3 mb-3">
      <v-card>
        <v-card-title>Crear nuevo empleado</v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-form ref="form" v-model="valid" :lazy-validation="true"
          >
            <v-container fluid>
              <v-layout row wrap>
                <v-flex xs12>
                  <v-text-field v-model="employee.dni" :rules="[rules.required]" append-icon="mdi-card"
                    label="DNI"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="employee.first_name" :rules="[rules.required]" append-icon="mdi-card"
                    label="Primer Nombre"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="employee.second_name" :rules="[rules.required]" append-icon="mdi-card"
                    label="Segundo Nombre"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="employee.last_name" :rules="[rules.required]" append-icon="mdi-account"
                    label="Apellido"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="employee.phone"  type="text"
                    append-icon="mdi-phone"
                    label="Telefono"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="employee.email"  type="email"
                    append-icon="mdi-email"
                    label="Correo Electronico"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="employee.salary"  type="text"
                    append-icon="mdi-card"
                    label="Salario"
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
                        v-model="employee.start_date"
                        prepend-inner-icon="mdi-calendar"
                        v-on="on"
                        readonly
                        outlined
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="employee.start_date"
                      no-title
                      @input="menu1 = false"
                    ></v-date-picker>
                  </v-menu>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="employee.position"  type="text"
                    append-icon="mdi-card"
                    label="Cargo"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-select v-model="employee.status" :rules="[rules.required]" :items="type" label="Estado"
                    outlined
                    required
                  ></v-select>
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
      menu1: false,
      valid: true,
      employee: {},
      type: ['Activo', 'Despedido', 'Suspendido'],
      rules: {
        required: value => !!value || 'Este campo es requerido.',
        email: value => /.+@.+/.test(value) || 'Debe ser un correo electrónico válido',
      },
    };
  },
  methods: {
    validateForm() {
      if (this.$refs.form.validate()) this.store();
    },
    store() {
      this.$http.post('/employee', this.employee)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Empleado creado exitosamente');
          this.$router.push({ name: 'employee.show', params: { id: res.data.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
