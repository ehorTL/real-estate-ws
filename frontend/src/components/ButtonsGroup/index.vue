<template>
  <div>
    <Button
      title="Офисы"
      first-link-title="Аренда"
      second-link-title="Продажа"
      first-link="/rent-offices"
      second-link="/sale-offices"
    />
    <Button
      title="Доходная недвижимость"
      second-link-title="Продажа"
      second-link="/sale-property"
    />
    <Button
      title="Магазины"
      first-link-title="Аренда"
      second-link-title="Продажа"
      first-link="/rent-shops"
      second-link="/sale-shops"
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
      first-link="/rent-restaurants"
      second-link="/sale-restaurants"
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
