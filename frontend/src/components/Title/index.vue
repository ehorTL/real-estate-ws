<template>
  <div class="title-row">
    <h2 class="main-title">{{ title }}</h2>
    <div class="underline" />
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String
    }
  }
};
</script>

<style scoped>
.main-title {
  font-size: 50px;
  color: #1e2d3b;
  text-align: center;
  margin-bottom: 20px;
}
.underline {
  width: 160px;
  border-bottom: 5px solid #1e2d3b;
  align-items: center;
  margin: 0 auto;
}

@media screen and (max-width: 650px) {
  .main-title {
    font-size: 40px;
  }
}
</style>
