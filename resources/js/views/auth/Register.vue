<template>
  <v-layout row wrap>
    <v-flex xs6 class="offset-xs3 mt-5">
      <v-card outlined>
        <v-card-title>Register</v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <v-form @submit.prevent>
            <v-text-field v-model="name" autofous append-icon="mdi-account-outline" label="Name" outlined
            ></v-text-field>

            <v-text-field v-model="email" append-icon="mdi-email-outline" label="Email" outlined type="email"
            ></v-text-field>

            <v-text-field v-model="password" append-icon="mdi-lock-open-outline" label="Password" outlined
              type="password"
            ></v-text-field>

            <v-text-field v-model="passwordConfirm" append-icon="mdi-lock-outline" label="Confirm password" outlined
              type="password"
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-text>
          <v-btn @click="register" block color="secondary" large
          >Register</v-btn>

          <router-link :to="{ name: 'login' }" class="mt-3 d-block text-center"
          >
            Ya tienes una cuenta?
          </router-link>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      passwordConfirm: '',
    };
  },
  methods: {
    register() {
      const data = {
        name: this.name,
        email: this.email,
        password: this.password,
      };

      this.$store.auth.dispatch('register', data)
        .then(() => this.$router.push('login'))
        .catch(err => console.log(err)); // eslint-disable-line
    },
  },
};
</script>
