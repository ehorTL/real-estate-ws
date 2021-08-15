<template>
  <div class="wrapper">
    <v-file-input
      :value="value"
      show-size
      accept="image/png, image/jpeg, image/bmp"
      prepend-icon="mdi-camera"
      counter
      outlined
      dense
      multiple
      :clearable="false"
      @change="$emit('getMainImage', $event)"
      label="Добавить главную фотографию"
    >
    </v-file-input>
    <div
      class="d-flex justify-center elevation-4 image-container"
      v-if="mainImageUrl"
    >
      <div class="image-wrapper">
        <img class="image" :src="mainImageUrl" />
        <v-btn
          class="delete-button pa-0"
          @click="deleteImage"
          color="white"
          width="30"
          height="30"
        >
          <v-icon class="delete">mdi-delete-outline</v-icon>
        </v-btn>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    mainImageUrl: {
      default: null
    },
    value: {
      required: true
    }
  },
  methods: {
    deleteImage() {
      this.$emit("deleteMainImage");
    }
  }
};
</script>

<style scoped>
.image-container {
  padding: 10px;
  border: 1px dashed;
  margin-bottom: 20px;
  border-radius: 4px;
}
.image-wrapper {
  position: relative;
  height: 126px;
  max-width: 100%;
  width: fit-content;
  border-radius: 4px;
}
.image {
  display: block;
  margin: 0 auto;
  border-radius: 4px;
  height: 100%;
  object-fit: contain;
}
.delete-button {
  position: absolute;
  top: 5px;
  right: 5px;
  min-width: 30px !important;
}
</style>
