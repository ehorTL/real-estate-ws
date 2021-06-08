<template>
  <v-btn
    :to="to"
    class="main-button"
    :width="width"
    :height="height"
    :color="backgroundColor"
    :style="{ color: color }"
  >
    {{ text }}
  </v-btn>
</template>

<script>
export default {
  props: {
    text: {
      type: String
    },
    width: {
      type: Number
    },
    height: {
      type: Number
    },
    backgroundColor: {},
    color: {},
    to: {}
  }
};
</script>

<style scoped>
.main-button {
  display: flex;
  margin: auto;
  text-transform: none;
  padding-top: 20px !important;
  padding-bottom: 20px !important;
  border-radius: 30px;
  font-size: 17px;
}
</style>
