<template>
  <div class="wrapper">
    <v-menu
      max-width="85"
      offset-x
      content-class="elevation-0"
      :close-on-content-click="false"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn height="50" class="main-button mb-3" v-bind="attrs" v-on="on">
          {{ title }}
        </v-btn>
      </template>

      <router-link :to="firstLink" class="link-button">
        {{ firstLinkTitle }}
      </router-link>
      <router-link :to="secondLink" class="link-button">
        {{ secondLinkTitle }}
      </router-link>
    </v-menu>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      required: true
    },
    firstLink: {},
    secondLink: {},
    firstLinkTitle: {},
    secondLinkTitle: {}
  }
};
</script>

<style scoped>
.main-button,
.link-button {
  font-size: 14px;
  text-transform: none;
  border-radius: 30px;
  color: #1e2d3b !important;
}
.main-button {
  width: 220px;
}
.link-button {
  display: block;
  width: 80px;
  background-color: rgb(245 245 245);
  text-align: center;
  margin-top: 2px;
  margin-left: 5px;
  text-decoration: none;
}
</style>
