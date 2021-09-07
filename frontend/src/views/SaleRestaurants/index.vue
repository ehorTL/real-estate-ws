<template>
  <property-template
    title="Продажа ресторанов"
    :objects="objects"
    description="Наша компания на протяжении многих лет успешно сотрудничает с ключевыми рестораторами города Киева,
      благодаря этому мы получаем закрытую информацию об освободившихся площадях.
      Не всегда информацию о продаже или аренде действующего ресторана можно афишировать, что б не навредить его репутации,
      по этому обращайтесь к нам и мы поможем Вам подобрать оптимальный объект для вашего бизнеса!"
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
    title: "Продажа ресторанов"
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
          `common/real-estate-featured?per_page=${this.itemsPerPage}&rec_ids[]=4&ct=1&realized=false&arc=false`
        )
        .then(res => {
          this.objects = res.data.data;
          this.showPreloader = false;
        });
    }
  }
};
</script>
