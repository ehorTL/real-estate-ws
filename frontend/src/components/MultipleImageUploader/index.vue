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
      @change="$emit('getMainImages', $event)"
      label="Добавить фотографии"
    >
    </v-file-input>
    <div v-if="images && images.length > 0">
      <draggable
        :list="images"
        @change="$emit('changeImages', $event)"
        class="images elevation-4"
      >
        <div class="image-wrapper" v-for="(image, i) in images" :key="i">
          <div class="img">
            <img class="image" :src="image" />
          </div>
          <v-btn
            class="delete-button pa-0"
            @click="deleteImage(i)"
            color="white"
            width="30"
            height="30"
          >
            <v-icon class="delete">mdi-delete-outline</v-icon>
          </v-btn>
        </div>
      </draggable>
    </div>
  </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
  components: {
    draggable
  },
  props: {
    images: {
      default: null
    },
    value: {
      required: true
    }
  },
  methods: {
    deleteImage(i) {
      this.$emit("deleteImage", i);
    }
  }
};
</script>

<style scoped>
.images {
  padding: 10px;
}
.image-wrapper {
  position: relative;
  height: 126px;
  max-width: 100%;
  width: fit-content;
  border-radius: 4px;
  margin-bottom: 10px;
  margin-right: 10px;
}
.img {
  width: 100%;
  height: 100%;
  max-width: 100%;
}
.image {
  display: block;
  border-radius: 4px;
  height: 100%;
  object-fit: contain;
}
.images {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  border: 1px dashed;
  border-radius: 4px;
}
.delete-button {
  position: absolute;
  top: 5px;
  right: 5px;
  min-width: 30px !important;
}
</style>
