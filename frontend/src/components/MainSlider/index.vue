<template>
  <div v-if="showSlides" class="slider-wrapper">
    <img
      class="button-prev"
      src="@/assets/next.png"
      alt=""
      height="57"
      width="31"
    />
    <swiper class="swiper" :options="swiperOption">
      <swiper-slide v-for="(slide, index) in slides" :key="index">
        <img :src="`${imgUrl}/${slide.main_image_url}`" />
        <p class="text" @click="redirectToObjectDetails(slide.id)">
          {{ slide.title }}
        </p>
      </swiper-slide>
    </swiper>
    <img
      class="button-next"
      src="@/assets/next.png"
      alt=""
      height="57"
      width="31"
    />
  </div>
</template>

<script>
import { Swiper, SwiperSlide } from "vue-awesome-swiper";
import "swiper/css/swiper.css";

export default {
  components: {
    Swiper,
    SwiperSlide
  },
  data() {
    return {
      swiperOption: {
        slidesPerView: 3,
        slidesPerGroup: 1,
        loop: true,
        centeredSlides: true,
        slideToClickedSlide: true,
        navigation: {
          nextEl: ".button-next",
          prevEl: ".button-prev"
        },
        autoplay: {
          delay: 10000,
          disableOnInteraction: true
        },
        breakpoints: {
          620: {
            slidesPerView: 3
          },
          320: {
            slidesPerView: 1
          }
        }
      },
      slides: [],
      showSlides: false,
      imgUrl: null
    };
  },
  created() {
    this.imgUrl = process.env.VUE_APP_IMG_URL;
    this.getObjectsInSlider();
  },
  methods: {
    getObjectsInSlider() {
      this.axios
        .get("common/real-estate-featured?show_in_slider=true")
        .then(res => {
          this.slides = res.data.data;
          this.showSlides = true;
        })
        .catch(e => {
          console.log(e);
          this.showSlides = false;
        });
    },
    redirectToObjectDetails(id) {
      this.$router.push({ name: "objectDetails", params: { id: `${id}` } });
    }
  }
};
</script>

<style lang="scss" scoped>
.slider-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 auto;
  max-width: 750px;
}
.button-prev,
.button-next {
  outline: none;
  display: block;
  margin-top: -60px;
}
.button-prev {
  transform: rotate(180deg);
}
.swiper {
  .swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 120px;
    opacity: 0.4;
    img {
      height: 100%;
      max-width: 160px;
      width: 100%;
      border-radius: 20px;
      object-fit: cover;
      object-position: center;
      margin-top: 70px;
      cursor: pointer;
    }
    .text {
      margin-top: 10px;
      text-align: center;
      font-size: 10px;
      font-weight: bold;
      max-width: 140px;
      word-break: break-all;
      margin-bottom: 0;
      color: white;
    }
  }
  .swiper-slide-active {
    height: 220px;
    opacity: 1;
    img {
      max-width: 210px;
      margin-top: 0;
    }
    .text {
      font-size: 14px;
      max-width: 160px;
      word-break: break-all;
    }
  }
}
</style>
