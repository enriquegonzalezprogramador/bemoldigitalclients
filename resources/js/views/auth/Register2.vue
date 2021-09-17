<template>
  <v-layout row wrap class="px-3">
    <v-flex xs3 class="offset-xs4 mb-3">
      <v-card>
        <v-card-title primary-title class="justify-center">Registro de usuarios</v-card-title>

        <v-divider></v-divider>

        <v-card-text>
          <v-form ref="form" v-model="valid" :lazy-validation="true"
          >
            <v-container fluid>
              <v-layout row wrap>

                <v-flex xs12>
                  <v-text-field v-model="user.first_name" :rules="[rules.required]" append-icon="mdi-account"
                    label="Nombre"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="user.last_name" :rules="[rules.required]" append-icon="mdi-account"
                    label="Apellido"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="user.email" :rules="[rules.required, rules.email]" type="email"
                    append-icon="mdi-email"
                    label="Correo electrónico"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-select v-model="user.type" :rules="[rules.required]" :items="type" label="Tipo de usuario"
                    outlined
                    required
                  ></v-select>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="user.password" :rules="[rules.required]" type="password"
                    append-icon="mdi-lock-open"
                    label="Nueva contraseña"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>

                <v-flex xs12>
                  <v-text-field v-model="passwordConfirm" :rules="[rules.confirm, rules.required]" type="password"
                    append-icon="mdi-lock"
                    label="Confirmar nueva contraseña"
                    outlined
                    required
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
            <v-flex xs12 >
            <v-btn block  @click="validateForm" color="info"
            >Crear</v-btn>
            </v-flex>
          </v-form>
        </v-card-text>
      </v-card>
             <v-flex xs12 class="mb-3  mt-3">
      <v-btn block color="transparent" :to="{ name: 'login' }"> <v-icon>mdi-account-tie</v-icon>
      <span>Tienes una cuenta? Ingresa </span> </v-btn>
    </v-flex>
    </v-flex>
  </v-layout>
</template>

<script>
import statuses from '@/js/statuses';

export default {
  data() {
    return {
      correo: '',
      mensaje: '',
      valid: true,
      user: {
        confirm: true,
      },
      type: ['Mobile', 'Web'],
      passwordConfirm: '',
      rules: {
        required: value => !!value || 'Este campo es requerido.',
        confirm: value => value === this.user.password || 'Las contraseñas deben coincidir.',
        email: value => /.+@.+/.test(value) || 'Debe ser un correo electrónico válido',
      },
    };
  },
  methods: {
    validateForm() {
      if (this.$refs.form.validate()) this.store();
    },
    async store() {
      this.user.confirmed=this.user.email;
      this.correo = this.user.email;
      await this.$http.post('/user', this.user)
        .then((res) => {
          window.console.log(res);
          this.mensaje=`Usuario creado exitosamente
          . Se le ha enviado un correo de confirmacion al correo: . ${this.correo}`;
          this.$store.dispatch('snackbar/success', this.mensaje);
          this.$router.push('/login');
        })
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        });
    },
  },
};
</script>
