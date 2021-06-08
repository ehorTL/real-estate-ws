<template>
  <div class="main-wrapper">
    <div class="wrapper">
      <v-container>
        <v-row justify="space-between" justify-sm="center">
          <v-col cols="12" xl="4" lg="6" md="7" sm="10">
            <div v-if="object" class="object">
              <h2 class="object-title">
                {{ object.title }}
              </h2>
              <p class="description">
                {{ object.description }}
              </p>
              <div class="object-details">
                <div class="object-information">
                  <p v-if="!object.realized">
                    <b class="mr-15">Цена:</b>{{ objectPrice }}
                  </p>
                  <p v-if="!object.realized">
                    <b class="mr-4">Цена за м<sup>2</sup>:</b
                    >{{ objectPricePerMeter }}
                  </p>
                  <p>
                    <b class="mr-7">Площадь:</b>{{ object.square }} м<sup
                      >2</sup
                    >
                  </p>
                  <p><b class="mr-13">Адрес:</b>{{ object.address }}</p>
                  <p><b class="mr-4">ID объекта:</b>{{ object.id }}</p>
                  <b v-if="!object.has_commision && !object.realized">
                    Без комисии!
                  </b>
                </div>
                <div class="object-contacts">
                  <p v-if="!object.realized">
                    <b class="mr-4">Агент:</b>{{ object.agent }}
                  </p>
                  <p v-if="!object.realized">
                    <b class="mr-7">Моб:</b>{{ object.mobile_number }}
                  </p>
                  <p v-if="!object.realized">
                    <b class="mr-4">E-mail:</b>{{ object.email }}
                  </p>
                  <ShareButton v-if="!object.realized" :object="object" />
                </div>
              </div>
            </div>
          </v-col>
          <v-col cols="12" xl="4" lg="6" md="5" sm="12">
            <ObjectsGallery :slides="objectImages()" />
          </v-col>
        </v-row>
      </v-container>
    </div>
    <Footer :showBackground="false" />
  </div>
</template>

<script>
import ObjectsGallery from "../../components/ObjectsGallery";
import Footer from "../../components/Footer";
import ShareButton from "../../components/ShareButton";
export default {
  components: {
    ObjectsGallery,
    Footer,
    ShareButton
  },
  data() {
    return {
      object: null
    };
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
  async created() {
    await this.getObject();
  },
  methods: {
    getObject() {
      this.axios
        .get(`common/real-estate/${this.$route.params.id}`)
        .then(res => {
          this.object = res.data;
        });
    },
    objectImages() {
      if (this.object && this.object.images && this.object.images.length > 0) {
        const images = this.object.images.map(el => el.url);
        images.push(this.object.main_image_url);

        return images;
      } else {
        const image = [];
        image.push(this.object.main_image_url);

        return image;
      }
    }
  }
};
</script>

<style scoped lang="scss">
.main-wrapper {
  min-height: 100%;
  background-image: url("../../assets/bg-main.png");
  background-position: top;
  background-size: cover;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  color: #fff;
}
.wrapper {
  flex: 1;
  width: 100%;
  display: flex;
  align-items: center;
}
.object-title {
  color: #f5faff;
  font-size: 30px;
  line-height: 32px;
  margin-bottom: 30px;
}
.description {
  line-height: 30px;
  margin-bottom: 30px;
}
.object-details {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}
</style>
