<template>
  <div class="wrapper">
    <Header />
    <MainSection :title="title" :description="description" />
    <div v-if="showPreloader" class="preloader-wrapper">
      <v-progress-circular
        class="d-flex justify-center align-center"
        :size="70"
        :width="7"
        color="#1e2d3b"
        indeterminate
      />
    </div>
    <div v-else class="list-wrapper" :class="{ 'empty-list': objects.length <= 0 }">
      <div v-if="objects && objects.length > 0" class="list">
        <ObjectCard
          v-for="(object, index) in objects"
          :key="index"
          :object="object"
          class="item"
        />
      </div>
      <p v-if="objects.length <= 0">Объектов в данной категории пока нету!</p>
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from "../../components/Header";
import MainSection from "../../components/MainSection";
import Footer from "../../components/Footer";
import ObjectCard from "../../components/ObjectCard";
export default {
  props: {
    objects: {
      type: Array,
      required: true
    },
    title: {
      type: String
    },
    description: {
      type: String
    },
    showPreloader: {
      type: Boolean,
      default: false
    }
  },
  components: {
    Header,
    MainSection,
    Footer,
    ObjectCard
  }
};
</script>

<style scoped src="@/assets/style.css" />
