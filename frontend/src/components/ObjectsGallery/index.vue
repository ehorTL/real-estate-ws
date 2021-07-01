<template>
  <div class="thumb-example">
    <swiper
      class="swiper gallery-top"
      :options="swiperOptionTop"
      ref="swiperTop"
    >
      <swiper-slide v-for="(slide, index) in slides" :key="index">
        <div class="swiper-zoom-container" @click="openCarousel(index)">
          <img :src="`${imgUrl}/${slide}`" />
        </div>
      </swiper-slide>
    </swiper>
    <swiper
      class="swiper gallery-thumbs"
      :options="swiperOptionThumbs"
      ref="swiperThumbs"
    >
      <swiper-slide v-for="(slide, index) in slides" :key="index">
        <img :src="`${imgUrl}/${slide}`" />
      </swiper-slide>
    </swiper>

    <v-dialog v-model="isCarouselOpened" width="800">
      <v-carousel
        v-model="carousel"
        cycle
        hide-delimiter-background
        show-arrows-on-hover
      >
        <v-carousel-item v-for="(slide, index) in slides" :key="index">
          <img class="carousel-img" :src="`${imgUrl}/${slide}`" />
        </v-carousel-item>
      </v-carousel>
    </v-dialog>
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
import "swiper/css/swiper.css";

export default {
  props: {
    slides: {
      required: true
    }
  },
  components: {
    Swiper,
    SwiperSlide
  },
  data() {
    return {
      swiperOptionTop: {
        loop: true,
        loopedSlides: 5,
        spaceBetween: 10
      },
      swiperOptionThumbs: {
        loop: true,
        loopedSlides: 5,
        spaceBetween: 10,
        slidesPerView: 3,
        touchRatio: 0.2,
        slideToClickedSlide: true,
        autoplay: {
          delay: 10000,
          disableOnInteraction: true
        }
      },
      isCarouselOpened: false,
      carousel: 0,
      imgUrl: null
    };
  },
  created() {
    this.imgUrl = process.env.VUE_APP_IMG_URL;
  },
  mounted() {
    this.$nextTick(() => {
      const swiperTop = this.$refs.swiperTop.$swiper;
      const swiperThumbs = this.$refs.swiperThumbs.$swiper;
      swiperTop.controller.control = swiperThumbs;
      swiperThumbs.controller.control = swiperTop;
    });
  },
  methods: {
    openCarousel(index) {
      this.carousel = index;
      this.isCarouselOpened = !this.isCarouselOpened;
    }
  }
};
</script>

<style lang="scss" scoped>
.thumb-example {
  height: 480px;
  width: 400px;
  margin-left: auto;
}

.carousel-img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

.swiper {
  .swiper-slide {
    height: 270px;
  }

  img {
    height: 100%;
    object-fit: cover;
    object-position: center;
    width: 100%;
    border-radius: 20px;
    cursor: pointer;
  }

  &.gallery-top {
    width: 100%;
  }
  &.gallery-thumbs {
    height: 20%;
    box-sizing: border-box;
    padding: 10px 0;
  }
  &.gallery-thumbs .swiper-slide {
    height: 100%;
    opacity: 0.4;
  }
  &.gallery-thumbs .swiper-slide-active {
    opacity: 1;
  }
}

@media screen and (max-width: 960px) {
  .thumb-example {
    margin: 0 auto;
  }
}

@media screen and (max-width: 430px) {
  .thumb-example {
    width: 290px;
  }
}
</style>
