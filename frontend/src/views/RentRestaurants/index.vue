<template>
  <property-template
    title="Аренда ресторанов"
    :objects="objects"
    description="Наша компания на протяжении многих лет успешно сотрудничает с ключевыми рестораторами города Киева,
      благодаря этому мы получаем закрытую информацию об освободившихся площадях.
      Не всегда информацию о продаже или аренде действующего ресторана можно афишировать, чтоб не навредить его репутации,
      поэтому обращайтесь к нам и мы поможем Вам подобрать оптимальный объект для Вашего бизнеса!"
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
    title: "Аренда ресторанов",
    showPreloader: true
  },
  data() {
    return {
      objects: [],
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
          `common/real-estate-featured?per_page=${this.itemsPerPage}&rec_ids[]=4&ct=2&realized=false&arc=false`
        )
        .then(res => {
          this.objects = res.data.data;
          this.showPreloader = false;
        });
    }
  }
};
</script>
