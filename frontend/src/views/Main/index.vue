<template>
  <div class="wrapper-main">
    <Header />
    <MainSection :show-slider="true" title="Коммерческая недвижимость" />
    <MainActualObjects
      :objects="actualObjects"
      :show-preloader="showActualPreloader"
    />
    <MainRealizedObjects
      :objects="realizedObjects"
      :show-preloader="showRealizedPreloader"
    />
    <ContactInformation />
    <MainFooter />
  </div>
</template>

<script>
import Header from "../../components/Header";
import MainSection from "../../components/MainSection";
import ContactInformation from "../../components/ContactInformation";
import MainRealizedObjects from "../../components/MainRealizedObjects";
import MainActualObjects from "../../components/MainActualObjects";
import MainFooter from "../../components/MainFooter";
export default {
  components: {
    Header,
    MainSection,
    ContactInformation,
    MainRealizedObjects,
    MainActualObjects,
    MainFooter
  },
  data() {
    return {
      realizedObjects: [],
      actualObjects: [],
      showActualPreloader: true,
      showRealizedPreloader: true
    };
  },
  created() {
    this.getObjects();
  },
  methods: {
    getRealizedObjects() {
      this.axios
        .get("common/real-estate-featured?per_page=6&realized=true&arc=false")
        .then(res => {
          this.realizedObjects = res.data.data;
          this.showRealizedPreloader = false;
        });
    },
    getActualObjects() {
      this.axios
        .get(
          "common/real-estate-featured?per_page=6&realized=false&show_in_slider=false&arc=false"
        )
        .then(res => {
          this.actualObjects = res.data.data;
          this.showActualPreloader = false;
        });
    },
    getObjects() {
      this.getActualObjects();
      this.getRealizedObjects();
    }
  }
};
</script>
