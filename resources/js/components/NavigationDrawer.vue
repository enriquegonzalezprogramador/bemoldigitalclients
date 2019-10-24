<template>
  <v-navigation-drawer :value="toggle" app clipped >
    <v-list-item>
      <v-list-item-content>
        <v-list-item-title class="title text-center" >
         Menu
        </v-list-item-title>
      </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

    <v-list dense nav>

      <v-list-group prepend-icon="mdi-account-group-outline" value="false" v-model="users"
      >
        <template v-slot:activator>
          <v-list-item-title>Usuarios</v-list-item-title>
        </template>

          <!-- Users -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'user.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-account-tie</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Lista de usuarios</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

      </v-list-group>

    </v-list>

      <v-list dense nav>

      <v-list-group prepend-icon="mdi-account-group-outline" value="false" v-model="employees"
      >
        <template v-slot:activator>
          <v-list-item-title>Empleados</v-list-item-title>
        </template>

                  <!-- Employees -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'employee.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-account</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Lista de empleados</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

      </v-list-group>

    </v-list>

    <v-list dense nav>

      <v-list-group prepend-icon="mdi-office-building" value="false" v-model="obres"
      >
        <template v-slot:activator>
          <v-list-item-title>Obras</v-list-item-title>
        </template>

          <!-- Projects -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'project.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-book</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Lista de proyectos</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <!-- Obres -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'obre.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-office-building</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Lista de obras</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <!-- Obres -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'activity.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-file-document-outline</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Actividades obras</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

      </v-list-group>

    </v-list>

        <v-list dense nav>

      <v-list-group prepend-icon="mdi-home-variant-outline" value="false" v-model="warehouse"
      >
        <template v-slot:activator>
          <v-list-item-title>Almacen</v-list-item-title>
        </template>

                  <!-- Warehouses -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'warehouse.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-home-variant-outline</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Lista de almacenes</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <!-- Inventario de Herramientas -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'tool.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-ruler</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Lista de Herramientas</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

          <!-- Inventario de Materiales -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'inventary.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-dropbox</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Lista de Materiales</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

                    <!-- Entrada de materiales -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'inputmaterial.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-hand-pointing-right</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Entrada de Materiales</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

                    <!-- Entrada de materiales -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'outputmaterial.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-hand-pointing-left</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Salida de Materiales</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

                              <!-- Requerimientos de materiales -->
          <v-list dense nav>
            <v-list-item link :to="{ name: 'requirementmaterial.list' }"
            >

              <v-list-item-icon>
                <v-icon>mdi-basket-fill</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>Requerimientos Material</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>

      </v-list-group>

    </v-list>

    <template v-slot:append v-if="isLoggedIn">
      <div class="pa-2">
        <v-btn @click="logout" color="secondary" block outlined
        ><v-icon>mdi-power</v-icon>Cerrar sesion</v-btn>
      </div>
    </template>
  </v-navigation-drawer>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      users: false,
      obres: false,
      employees: false,
      warehouse: false,
    };
  },
  props: {
    toggle: Boolean,
  },
  computed: {
    ...mapGetters({
      isLoggedIn: 'auth/isLoggedIn',
      authUser: 'auth/authUser',
    }),
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout');
      this.$router.push({ name: 'login' });
    },
  },
};
</script>
