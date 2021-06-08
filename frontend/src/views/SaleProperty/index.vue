<template>
  <property-template
    title="Продажа доходной недвижимости"
    :objects="objects"
    description="Доходная недвижимость один из лучших инструментов для сохранения и приумножения вашего капитала.
      Правильно инвестируя в недвижимость вы получаете пассивный доход от сдачи в аренду с минимальными рисками.
      Как говорят наши сотрудники - «работает тот, кому нечего сдать в аренду»"
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
    title: "Продажа доходной недвижимости"
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
        .get(
          "common/real-estate-featured?rec_ids[]=5&ct=1&realized=false&arc=false"
        )
        .then(res => {
          this.objects = res.data.data;
          this.showPreloader = false;
        });
    }
  }
};
</script>
