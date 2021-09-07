<template>
  <property-template
    title="Продажа магазинов"
    :objects="objects"
    description="Компания АКМ сотрудничает со всеми сетевыми арендаторами, поэтому мы выгодный партнер как
      для собственника помещения так и для арендаторов.
      Собственнику помещения мы поможем подобрать оптимального арендатора.
      Арендатору предоставим лучшие локации для его бизнеса.
      Для получения максимального результата оставляйте свои запросы нашим специалистам."
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
    title: "Продажа магазинов"
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
          `common/real-estate-featured?per_page=${this.itemsPerPage}&rec_ids[]=3&ct=1&realized=false`
        )
        .then(res => {
          this.objects = res.data.data;
          this.showPreloader = false;
        });
    }
  }
};
</script>
