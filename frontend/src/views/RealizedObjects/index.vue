<template>
  <property-template
    title="Реализованные объекты"
    :objects="objects"
    :show-preloader="showPreloader"
  />
</template>

<script>
import PropertyTemplate from "../../components/PropertyTemplate";

export default {
  components: {
    PropertyTemplate
  },
  metaInfo: {
    title: "Реализованные объекты"
  },
  data() {
    return {
      objects: [],
      showPreloader: true
    };
  },
  created() {
    this.getObjects();
  },
  methods: {
    getObjects() {
      this.axios
        .get("common/real-estate-featured?realized=true&arc=false")
        .then(res => {
          this.objects = res.data.data;
          this.showPreloader = false;
        });
    }
  }
};
</script>
