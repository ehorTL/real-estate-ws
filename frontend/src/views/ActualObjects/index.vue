<template>
  <property-template
    title="Актуальные объекты"
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
  data() {
    return {
      objects: [],
      showPreloader: true,
      itemsPerPage: 9999
    };
  },
  created() {
    this.getObjects();
  },
  methods: {
    getObjects() {
      this.axios
        .get(
          `common/real-estate-featured?per_page=${this.itemsPerPage}&realized=false&show_in_slider=false&arc=false`
        )
        .then(res => {
          this.objects = res.data.data;
          this.showPreloader = false;
        });
    }
  }
};
</script>
