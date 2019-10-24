<template>
  <v-layout row wrap class="px-3">
    <v-flex xs6 class="offset-xs3 mb-3">
      <v-btn class="mb-3" @click="() => { $router.go(-1) }" color="info"
      >Regresar</v-btn>

      <v-divider></v-divider>
    </v-flex>

    <v-flex xs6 class="offset-xs3 mb-3">
      <v-card>
        <v-card-title>Registrar nuevo Material</v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-form ref="form" v-model="valid" :lazy-validation="true"
          >
            <v-container fluid>
              <v-layout row wrap>

                <v-flex xs12>
                  <v-select
                   v-model="inventary.warehouse_id" :items="warehouses" label="Almacen"
                    outlined item-value="id" item-text="name"
                    required :rules="[rules.required]"
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="inventary.description" append-icon="mdi-card"
                    label="Material"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="inventary.provider" append-icon="mdi-account"
                    label="Proveedor"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                 <v-flex xs12>
                  <v-select v-model="inventary.category" :rules="[rules.required]" :items="type" label="Categoria"
                    outlined
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="inventary.quantity" append-icon="mdi-account"
                    label="Cantidad"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="inventary.price"  append-icon="mdi-card"
                    label="Precio"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="inventary.observation"
                    append-icon="mdi-card"
                    label="Observacion"
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
      warehouses: [],
      inventary: {
        quantity: 0,
        price: 0,
        observation: 'Ninguna',
      },
      type: ['Materiales', 'Grafiteria', 'Electricidad', 'Aguas Blancas', 'Aguas Negras'],
      rules: {
        required: value => !!value || 'Este campo es requerido.',
        email: value => /.+@.+/.test(value) || 'Debe ser un correo electrónico válido',
      },
    };
  },
  created() {
    this.getWarehouses();
  },
  methods: {
    validateForm() {
      if (this.$refs.form.validate()) window.console.log(this.inventary); this.store();
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
    store() {
      this.$http.post('/inventary', this.inventary)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Registro creado exitosamente');
          this.$router.push({ name: 'inventary.show', params: { id: res.data.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
