<template>
  <div class="wrapper">
    <Header />
    <AboutCompany />
    <Footer :show-background="false" />
  </div>
</template>

<script>
import Header from "../../components/Header";
import AboutCompany from "../../components/AboutCompany";
import Footer from "../../components/Footer";
export default {
  components: {
    Header,
    AboutCompany,
    Footer
  },
  metaInfo: {
    title: "О компании"
  }
};
</script>

<style scoped>
.wrapper {
  height: 88.9%;
}
@media screen and (max-width: 959px){
  .wrapper {
    height: 100%;
  }
}
</style>
