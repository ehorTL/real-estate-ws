<template>
  <div>
    <Button
      title="Офисы"
      first-link-title="Аренда"
      second-link-title="Продажа"
      first-link="/ofisy/arenda-ofisov"
      second-link="/ofisy/prodazha-ofisov"
    />
    <Button
      title="Доходная недвижимость"
      second-link-title="Продажа"
      second-link="/dokhodnaya-nedvizhimost"
    />
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
