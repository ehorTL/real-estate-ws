<template>
  <v-app>
    <router-view />
  </v-app>
</template>

<script>
export default {
  name: "App",
  metaInfo: {
    title: "Главная",
    titleTemplate: "%s | AKM",
    htmlAttrs: {
      lang: "ru-RU"
    },
    meta: [
      { charset: "utf-8" },
      {
        name: "description",
        content: "Коммерческая недвижимость (аренда, продажа)"
      },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      {
        property: "og:description",
        content: "Коммерческая недвижимость (аренда, продажа)"
      }
    ]
  }
};
</script>

<style>
html,
body {
  min-height: 100% !important;
  height: 100% !important;
}
</style>
