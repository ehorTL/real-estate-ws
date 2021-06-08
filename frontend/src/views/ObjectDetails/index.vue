<template>
  <div class="wrapper">
    <Header />
    <objects-details />
  </div>
</template>

<script>
import Header from "../../components/Header";
import ObjectsDetails from "../../components/ObjectsDetails";
export default {
  components: {
    ObjectsDetails,
    Header
  }
};
</script>

<style scoped>
.wrapper {
  height: 100%;
}
</style>
