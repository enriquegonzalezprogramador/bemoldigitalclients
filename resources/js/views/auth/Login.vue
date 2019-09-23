<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs5 mt-5">
      <img src="/img/ac.png" width="250px" height="250px">
    </v-flex>

    <v-flex xs4 class="offset-xs4 mt-5">
      <v-card outlined>
        <v-card-title  primary-title class="justify-center">Iniciar sesión</v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <v-form ref="form" v-model="valid" :lazy-validation="true"
          >
            <v-text-field v-model="email"  @keyup.enter="validateForm" autofous append-icon="mdi-email-outline"
              label="Correo electrónico"
              outlined
              :rules="[rules.required, rules.email]"
              type="email"
            ></v-text-field>

            <v-text-field v-model="password" @keyup.enter="validateForm" append-icon="mdi-lock-outline"
              label="Contraseña"
              outlined
              :rules="[rules.required]"
              type="password"
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-text>
          <v-btn @click="validateForm" block color="info"  large >Iniciar sesión</v-btn>
        </v-card-text>
      </v-card>
      <v-flex xs12 class="mb-3  mt-3">
      <v-btn block color="transparent" :to="{ name: 'user.recovery' }"> <v-icon >mdi-key </v-icon>
      <span>Olvido su contraseña?</span> </v-btn>
    </v-flex>
            <v-flex xs12 class="mb-3  mt-3">
      <v-btn block color="transparent" :to="{ name: 'user.register' }"> <v-icon>mdi-account-tie</v-icon>
      <span>Registrese ahora</span> </v-btn>
    </v-flex>
    </v-flex>

  </v-layout>
</template>
<script>
import statuses from '@/js/statuses';

export default {
  data() {
    return {
      valid: true,
      rules: {
        required: value => !!value || 'Este campo es requerido.',
        email: value => /.+@.+/.test(value) || 'Debe ser un correo electrónico válido',
      },
      email: '',
      password: '',
    };
  },
  methods: {
    validateForm() {
      if (this.$refs.form.validate()) this.login();
    },
    login() {
      const data = {
        email: this.email,
        password: this.password,
      };

      this.$store.dispatch('auth/login', data)
        .then(() => this.$router.push('/dashboard'))
        .catch((err) => {
          this.$store.dispatch('snackbar/error', statuses[err.response.status]);
        }) // eslint-disable-line
    },
  },
};
</script>
