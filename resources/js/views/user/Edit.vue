<template>
  <v-layout row wrap class="px-3">
    <v-flex xs6 class="offset-xs3 mb-3">
      <v-btn class="mb-3" @click="() => { $router.go(-1) }" color="info"
      >Regresar</v-btn>

      <v-divider></v-divider>
    </v-flex>

    <v-flex xs6 class="offset-xs3 mb-3">
      <v-card>
        <v-card-title>Modificar usuario</v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-form @submit.prevent>
            <v-container fluid grid-list-xs>
              <v-layout row wrap >
                <v-flex xs6>
                  <v-text-field v-model="baseFields.first_name" append-icon="mdi-account" label="Nombre" outlined
                    required
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
                  <v-text-field v-model="baseFields.email" type="email" append-icon="mdi-email" label="Correo" outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-select v-model="baseFields.type" label="Tipo de acceso" :items="type" outlined
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
      user: {},
      type: ['Móvil', 'Web'],
      baseFields: {},
      password: '',
      passwordConfirm: '',
    };
  },
  created() {
    this.findUser();
  },
  methods: {
    findUser() {
      this.$http.get(`/user/${this.$route.params.id}`)
        .then((res) => {
          this.baseFields = res.data.user;
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
    edit() {
      this.baseFields.confirmed='1';
      this.baseFields.confirmed='1';
      if (this.password) this.baseFields.password = this.password;
      console.log(this.baseFields);
      this.user.id = this.baseFields.id;
      this.user.first_name = this.baseFields.first_name;
      this.user.last_name = this.baseFields.last_name;
      this.user.email = this.baseFields.email;
      this.user.password = '12345';
      this.user.confirmed = this.baseFields.confirmed;
      this.user.type = this.baseFields.type;
      console.log(this.user);

      this.$http.put(`/user/${this.user.id}`, this.user)
        .then((res) => {
          this.$store.dispatch('snackbar/success', 'Usuario editado éxitosamente');
          this.$router.push({ name: 'user.show', params: { id: this.user.id } });
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
