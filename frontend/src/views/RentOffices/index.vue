<template>
  <property-template
    title="Аренда офисов"
    :objects="objects"
    description="Имея большую базу данных офисных помещений и работая с большинством бизнес центров города Киева наши
      сотрудники помогут вам подобрать офисное помещение соответсвующее вашим критериям поиска.
      Владельцам офисных помещений мы поможем найти стабильных арендаторов."
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
    title: "Аренда офисов"
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
          `common/real-estate-featured?per_page=${this.itemsPerPage}&rec_ids[]=1&ct=2&realized=false&arc=false`
        )
        .then(res => {
          this.objects = res.data.data;
          this.showPreloader = false;
        });
    }
  }
};
</script>
