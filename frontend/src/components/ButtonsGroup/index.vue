<template>
  <div>
    <Button
      title="Офисы"
      first-link-title="Аренда"
      second-link-title="Продажа"
      first-link="/ofisy/arenda-ofisov"
      second-link="/ofisy/prodazha-ofisov"
    />
    <v-btn height="50" class="main-button mb-3" to="/dokhodnaya-nedvizhimost">
      Доходная недвижимость
    </v-btn>
    <Button
      title="Магазины"
      first-link-title="Аренда"
      second-link-title="Продажа"
      first-link="/magaziny/arenda-magazinov"
      second-link="/magaziny/prodazha-magazinov"
    />
    <Button
      title="Здания"
      first-link-title="Аренда"
      second-link-title="Продажа"
      first-link="/rent-builds"
      second-link="/sale-builds"
    />
    <Button
      title="Рестораны"
      first-link-title="Аренда"
      second-link-title="Продажа"
      first-link="/restorany/arenda-restoranov"
      second-link="/restorany/prodazha-restoranov"
    />
  </div>
</template>

<script>
import Button from "./Button";
export default {
  components: {
    Button
  }
};
</script>

<style scoped>
.main-button {
  font-size: 14px;
  text-transform: none;
  border-radius: 30px;
  color: #1e2d3b !important;
}
</style>
