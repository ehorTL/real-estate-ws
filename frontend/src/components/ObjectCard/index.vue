<template>
  <div class="object-card elevation-12" @click="openObjectDetails">
    <h2 class="object-title">{{ object.title }}</h2>
    <div class="img-object">
      <v-img
        height="200"
        class="object-img"
        :src="`${imgUrl}/${object.main_image_url}`"
      />
      <v-tooltip v-if="$route.path !== '/featured-objects'" bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn class="star-btn" @click.stop="addToFavorite" icon>
            <v-icon class="star" v-bind="attrs" v-on="on">mdi-star</v-icon>
          </v-btn>
        </template>
        <span>Добавить в избранное</span>
      </v-tooltip>
      <v-tooltip v-if="$route.path == '/featured-objects'" bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn class="star-btn" @click.stop="removeFromFavorite" icon>
            <v-icon class="star" v-bind="attrs" v-on="on"
              >mdi-delete-outline</v-icon
            >
          </v-btn>
        </template>
        <span>Удалить из избранного</span>
      </v-tooltip>
      <div v-if="!object.has_commision && !object.realized" class="marquee">
        <p>
          Без комиссии!<span class="mr-10 ml-10">Без комиссии!</span> Без
          комиссии!
        </p>
      </div>
    </div>
    <div class="object-footer">
      <p class="footer-text">
        <span class="mr-2" v-if="!object.realized">{{ objectPrice }}</span>
        <span class="mr-2" v-if="!object.realized"
          >{{ objectPricePerMeter }}/м<sup>2</sup></span
        >
        <span>{{ object.square }} м<sup>2</sup></span>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    object: {}
  },
  data () {
    return {
      imgUrl: null
    }
  },
  created() {
    this.imgUrl = process.env.VUE_APP_IMG_URL;
  },
  computed: {
    objectPrice() {
      if (this.object.currency_id == 2) {
        return `${this.object.price}грн`;
      } else {
        return `${this.object.price}$`;
      }
    },
    objectPricePerMeter() {
      if (this.object.currency_id == 2) {
        return `${this.object.price_per_square_meter}грн`;
      } else {
        return `${this.object.price_per_square_meter}$`;
      }
    }
  },
  methods: {
    addToFavorite() {
      this.$store.dispatch("addToFeatured", this.object);
    },
    openObjectDetails() {
      this.$router.push({
        name: "objectDetails",
        params: { id: `${this.object.id}` }
      });
    },
    removeFromFavorite() {
      this.$store.dispatch("removeFromFeatured", this.object);
    }
  }
};
</script>

<style scoped>
.object-card {
  max-width: 240px;
  border-radius: 18px;
  max-height: 280px;
  background-color: white;
  cursor: pointer;
}
.img-object {
  overflow: hidden;
  position: relative;
}
.object-img {
  transition: all 0.6s ease-out;
}
.object-card:hover .object-img {
  transform: scale(1.1);
}
.object-title {
  font-size: 14px;
  text-align: center;
  line-height: 18px;
  padding: 5px;
  color: #1e2d3b;
}
.object-footer {
  background-color: #1e2d3b;
  color: #d5d6d8;
  border-bottom-left-radius: 18px;
  border-bottom-right-radius: 18px;
}
.footer-text {
  margin: 0;
  font-size: 14px;
  text-align: center;
  padding: 7px 0;
}
.star-btn {
  position: absolute;
  top: 0;
  right: 0;
}
.star {
  color: white !important;
}
.star:hover {
  transition: 0.5s all;
  color: yellow !important;
}
.marquee {
  position: absolute;
  z-index: 1;
  max-width: 240px;
  bottom: 0;
  margin: 0 auto;
  height: 17px;
  background-color: rgb(248, 65, 71);
  font-size: 12px;
  color: #fff;
  white-space: nowrap;
  overflow: hidden;
}

.marquee p {
  display: inline-block;
  margin: 0;
  padding-left: 100%;
  animation: marquee 7s linear infinite;
}

.marquee p:hover {
  animation-play-state: paused;
}

@keyframes marquee {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(-100%, 0);
  }
}
</style>
