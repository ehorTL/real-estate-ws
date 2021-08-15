<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app width="200px">
      <h2 class="title mb-3 mt-5">Меню</h2>
      <ul class="pa-0 pl-6">
        <li v-for="(item, index) in items" :key="index" class="item">
          <router-link :to="{ name: item.name }" class="link">
            <v-icon>{{ item.icon }}</v-icon>
            {{ item.title }}
          </router-link>
        </li>
      </ul>
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>AKM Admin Panel</v-toolbar-title>

      <v-tooltip bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            v-bind="attrs"
            v-on="on"
            icon
            style="margin-left: auto"
            @click="logout"
          >
            <v-icon>mdi-logout</v-icon>
          </v-btn>
        </template>
        <span>Выйти</span>
      </v-tooltip>
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer: null,
    items: [
      {
        title: "Все объекты",
        name: "allObjects",
        icon: "mdi-table"
      },
      {
        title: "Архивированные объекты",
        name: "archivedObjects",
        icon: "mdi-archive"
      },
      {
        title: "Добавить объекты",
        name: "addObjects",
        icon: "mdi-plus"
      }
    ]
  }),
  mounted() {
    window.addEventListener("beforeunload", () => this.logout());
  },
  methods: {
    logout() {
      this.$store.dispatch("logout");
    }
  }
};
</script>

<style scoped>
.title {
  font-size: 20px;
  padding-left: 20px;
}
.item,
.link {
  list-style-type: none;
  text-decoration: none;
}
</style>
