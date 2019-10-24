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
                   v-model="baseFields.warehouse_id" :items="warehouses" label="Almacen"
                    outlined item-value="id" item-text="name"
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs6>
                  <v-text-field v-model="baseFields.description" append-icon="mdi-card" label="Material" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs6>
                  <v-text-field  append-icon="mdi-account" label="Proveedor" outlined
                    required v-model="baseFields.provider"
                  ></v-text-field>
                </v-flex>

                 <v-flex xs6>
                  <v-select v-model="baseFields.category" :rules="[rules.required]" :items="type" label="Categoria"
                    outlined
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
                  <v-text-field v-model="baseFields.observation"  append-icon="mdi-card" label="Observacion" outlined
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
      inventary: {},
      warehouses: [],
      baseFields: {},
      type: ['Materiales', 'Grafiteria', 'Electricidad', 'Aguas Blancas', 'Aguas Negras'],
      rules: {
        required: value => !!value || 'Este campo es requerido.',
        email: value => /.+@.+/.test(value) || 'Debe ser un correo electrónico válido',
      },
    };
  },
  created() {
    this.findInventary();
    this.getWarehouses();
  },
  methods: {
    findInventary() {
      this.$http.get(`/inventary/${this.$route.params.id}`)
        .then((res) => {
          this.inventary = res.data.inventary;
          this.baseFields = this.inventary;
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
    edit() {
      const data = this.baseFields;
      window.console.log(data);

      this.$http.patch(`/inventary/${this.inventary.id}`, this.baseFields)
        .then((res) => {
          window.console.log(res);
          this.$store.dispatch('snackbar/success', 'Registro editado éxitosamente');
          this.$router.push({ name: 'inventary.show', params: { id: this.inventary.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
