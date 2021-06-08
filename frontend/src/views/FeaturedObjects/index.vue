<template>
  <property-template title="Избранные объекты" :objects="featuredObjects" />
</template>

<script>
import PropertyTemplate from "../../components/PropertyTemplate";

export default {
  components: {
    PropertyTemplate
  },
  metaInfo: {
    title: "Избранные объекты"
  },
  computed: {
    featuredObjects() {
      return this.$store.getters.getFeaturedObjects;
    }
  }
};
</script>
