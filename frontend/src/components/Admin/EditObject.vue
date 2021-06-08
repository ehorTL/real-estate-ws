<template>
  <v-card class="pa-5 ma-7">
    <v-card-title class="justify-center">
      <h3>Редактировать объект:</h3>
    </v-card-title>
    <v-card-text v-if="showPreloader" class="mt-16 mb-16 text-center">
      <v-progress-circular
        :size="70"
        :width="7"
        color="#1e2d3b"
        indeterminate
      />
    </v-card-text>
    <v-card-text v-else class="justify-center">
      <v-form ref="form" v-model="formData.valid" lazy-validation class="form">
        <v-text-field
          v-model="formData.title"
          :rules="mainRule"
          label="Название обьекта"
          required
          outlined
        ></v-text-field>

        <v-textarea
          v-model="formData.description"
          color="teal"
          required
          :rules="mainRule"
          outlined
        >
          <template v-slot:label>
            <div>
              Описание обьекта
            </div>
          </template>
        </v-textarea>

        <v-text-field
          v-model="formData.address"
          :rules="mainRule"
          label="Адрес обьекта"
          required
          outlined
        ></v-text-field>

        <v-select
          v-model="formData.objectType"
          :items="objectTypes"
          multiple
          item-text="type"
          item-value="value"
          :rules="objectTypeRules"
          label="Тип обьекта"
          required
          outlined
          small-chips
          :menu-props="{ bottom: true, offsetY: true }"
        ></v-select>

        <v-select
          v-model="formData.currency"
          :items="currencyItems"
          :rules="mainRule"
          item-text="type"
          item-value="value"
          label="Валюта"
          required
          outlined
          :menu-props="{ bottom: true, offsetY: true }"
        ></v-select>

        <v-text-field
          label="Цена"
          v-model="formData.price"
          :rules="mainRule"
          required
          outlined
        ></v-text-field>

        <v-text-field
          label="Площадь"
          v-model="formData.area"
          :rules="mainRule"
          required
          outlined
        ></v-text-field>

        <v-text-field
          label="Цена за м2"
          v-model="pricePerMeter"
          disabled
          outlined
        ></v-text-field>

        <v-select
          v-model="formData.deal"
          :items="dealItems"
          :rules="mainRule"
          item-text="type"
          item-value="value"
          label="Вид сделки"
          required
          outlined
          :menu-props="{ bottom: true, offsetY: true }"
        ></v-select>

        <v-select
          v-model="formData.commission"
          :items="commissionItems"
          :rules="mainRule"
          item-text="type"
          item-value="value"
          label="Комиссия"
          required
          outlined
          :menu-props="{ bottom: true, offsetY: true }"
        ></v-select>

        <v-text-field
          v-model="formData.agent"
          :rules="mainRule"
          label="Агент"
          required
          outlined
        ></v-text-field>

        <v-text-field
          v-model="formData.telephone"
          :rules="mainRule"
          label="Номер телефона"
          v-mask="'+38(###)-###-##-##'"
          required
          outlined
        ></v-text-field>

        <v-text-field
          v-model="formData.email"
          :rules="emailRules"
          label="E-mail"
          required
          outlined
        ></v-text-field>

        <v-select
          v-model="formData.isRealized"
          :items="realizedItems"
          :rules="mainRule"
          item-text="type"
          item-value="value"
          label="Реализованый объект?"
          required
          outlined
          :menu-props="{ bottom: true, offsetY: true }"
        ></v-select>

        <v-select
          v-model="formData.isSlider"
          :items="sliderItems"
          :rules="mainRule"
          item-text="type"
          item-value="value"
          label="Добавить объект в слайдер?"
          required
          outlined
          :menu-props="{ bottom: true, offsetY: true }"
        ></v-select>

        <v-select
          v-model="formData.archieved"
          :items="archievedItems"
          :rules="mainRule"
          item-text="type"
          item-value="value"
          label="Архивировать объект(не показывать)?"
          required
          outlined
          :menu-props="{ bottom: true, offsetY: true }"
        ></v-select>

        <v-file-input
          v-if="showImageInput"
          v-model="mainImage"
          show-size
          accept="image/png, image/jpeg, image/bmp"
          prepend-icon="mdi-camera"
          counter
          outlined
          dense
          required
          label="Добавить главную фотографию"
          ref="image"
          @change="getMainImage"
          @click:clear="clearMainImage"
        ></v-file-input>

        <img
          v-if="!showImageInput"
          class="image"
          :src="`${imgUrl}/${mainImage}`"
          alt=""
        />

        <img
          v-if="mainImageUrl && showImageInput"
          class="image"
          :src="mainImageUrl"
          alt=""
        />

        <v-file-input
          v-if="showImagesInput"
          v-model="images"
          show-size
          accept="image/png, image/jpeg, image/bmp"
          prepend-icon="mdi-camera"
          counter
          outlined
          dense
          multiple
          required
          @change="getMainImages"
          label="Добавить фотографии"
        ></v-file-input>

        <div v-if="!showImagesInput" class="images">
          <img
            class="image"
            v-for="(image, i) in images"
            :key="i"
            :src="`${imgUrl}/${image.url}`"
            alt=""
          />
        </div>

        <div v-if="mainImages && showImagesInput" class="images">
          <img
            class="image"
            v-for="(image, i) in mainImages"
            :key="i"
            :src="image"
            alt=""
          />
        </div>

        <div class="controls mt-5 d-flex justify-space-between">
          <v-btn v-if="!showImageInput" @click="deleteMainImage">
            Удалить главное фото
          </v-btn>
          <v-btn v-if="!showImagesInput" @click="deleteImages">
            Удалить второстепенные фото
          </v-btn>
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="validate"
          >
            Сохранить
          </v-btn>
        </div>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "EditObject",
  metaInfo: {
    title: "Редактирование объекта"
  },
  data: () => ({
    valid: true,
    mainRule: [v => !!v || "Заполните поле"],
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+\..+/.test(v) || "E-mail must be valid"
    ],
    objectTypes: [],
    objectTypeRules: [
      v => !!v || "Заполните поле",
      v => v.length <= 3 || "Максимальное количество объектов - три"
    ],
    dealItems: [
      { type: "Продажа", value: 1 },
      { type: "Аренда", value: 2 }
    ],
    commissionItems: [
      { type: "С комиссией!", value: "true" },
      { type: "Без комисси!", value: "false" }
    ],
    currencyItems: [
      { type: "USD", value: 1 },
      { type: "ГРН", value: 2 }
    ],
    realizedItems: [
      { type: "Да", value: "true" },
      { type: "Нет", value: "false" }
    ],
    sliderItems: [
      { type: "Да", value: "true" },
      { type: "Нет", value: "false" }
    ],
    archievedItems: [
      { type: "Да", value: "true" },
      { type: "Нет", value: "false" }
    ],
    formData: {
      title: "",
      description: "",
      objectType: [],
      address: "",
      area: "",
      currency: "",
      price: "",
      deal: null,
      commission: null,
      agent: "",
      telephone: "",
      email: "",
      isRealized: null,
      isSlider: false,
      archieved: false
    },
    mainImage: [],
    images: [],
    mainImageUrl: null,
    mainImages: null,
    showImageInput: false,
    showImagesInput: false,
    imgUrl: null,
    showPreloader: true
  }),
  async created() {
    this.imgUrl = process.env.VUE_APP_IMG_URL;
    await this.getObjectTypes();
    await this.getObjectById();
  },
  computed: {
    token() {
      return this.$store.getters.getToken;
    },
    pricePerMeter() {
      return this.formData.price && this.formData.area
        ? Math.round(this.formData.price / this.formData.area)
        : 0;
    }
  },
  methods: {
    getObjectTypes() {
      this.axios.get("common/real-estate-categories").then(res => {
        this.objectTypes = res.data.map(el => ({
          type: el.category_name,
          value: el.id
        }));
      });
    },
    getObjectById() {
      const objectId = this.$route.params.id;
      this.axios
        .get(`common/real-estate/${objectId}`)
        .then(res => {
          this.formData.title = res.data.title;
          this.formData.description = res.data.description;
          this.formData.objectType = res.data.real_estate_categories.map(
            el => ({
              type: el.category_name,
              value: el.id
            })
          );
          this.formData.address = res.data.address;
          this.formData.area = res.data.square;
          this.formData.currency = res.data.currency_id;
          this.formData.price = res.data.price;
          this.formData.deal = res.data.contract_type_id;
          this.formData.commission = res.data.has_commision.toString();
          this.formData.agent = res.data.agent;
          this.formData.telephone = res.data.mobile_number;
          this.formData.email = res.data.email;
          this.formData.isRealized = res.data.realized.toString();
          this.formData.isSlider = res.data.show_in_slider.toString();
          this.formData.archieved = res.data.archieved.toString();
          this.mainImage = res.data.main_image_url;
          this.images = res.data.images;

          if (this.images.length < 1) {
            this.showImagesInput = true;
          }
          if (!this.mainImage) {
            this.showImageInput = true;
          }

          this.showPreloader = false;
        })
        .catch(e => {
          console.log(e);
        });
    },
    clearMainImage() {
      this.mainImageUrl = null;
    },
    getMainImage(e) {
      if (e) {
        this.mainImageUrl = URL.createObjectURL(this.mainImage);
      }
    },
    getMainImages(e) {
      if (e) {
        this.mainImages = this.images.map(el => {
          return URL.createObjectURL(el);
        });
      }
    },
    async deleteMainImage() {
      await this.axios
        .delete(`admin/delete-rs-main-img/${this.$route.params.id}`, {
          headers: {
            Authorization: `Bearer ${this.token}`
          }
        })
        .then(() => {
          this.showImageInput = true;
          this.mainImage = null;
        });
    },
    async deleteImages() {
      await this.axios
        .post(
          `admin/delete-rs-imgs`,
          {
            img_ids: this.images.map(el => el.id)
          },
          {
            headers: {
              Authorization: `Bearer ${this.token}`
            }
          }
        )
        .then(() => {
          this.images = [];
        });
    },
    async validate() {
      if (this.$refs.form.validate()) {
        await this.axios.put(
          `admin/real-estate/${this.$route.params.id}`,
          {
            title: this.formData.title,
            description: this.formData.description,
            currency_id: this.formData.currency,
            price: +this.formData.price,
            price_per_square_meter: +this.pricePerMeter,
            square: +this.formData.area,
            address: this.formData.address,
            agent: this.formData.agent,
            mobile_number: this.formData.telephone,
            email: this.formData.email,
            has_commision: this.formData.commission,
            real_estate_categories: this.formData.objectType[0].value
              ? this.formData.objectType.map(el => el.value)
              : this.formData.objectType,
            contract_type_id: this.formData.deal,
            realized: this.formData.isRealized,
            show_in_slider: this.formData.isSlider,
            archieved: this.formData.archieved
          },
          {
            headers: {
              Authorization: `Bearer ${this.token}`
            }
          }
        );
        await this.setMainImage();
        await this.setImages();
      }
    },
    async setMainImage() {
      let data = new FormData();
      data.append("real_estate_id", this.$route.params.id);
      data.append("img", this.mainImage);
      await this.axios.post("admin/set-rs-main-img", data, {
        headers: {
          "Content-Type": "multipart/form-data",
          Authorization: `Bearer ${this.token}`
        }
      });
    },
    async setImages() {
      let data = new FormData();
      data.append("real_estate_id", this.$route.params.id);
      for (var i = 0; i < this.images.length; i++) {
        let image = this.images[i];

        data.append("images[]", image);
      }
      await this.axios
        .post("admin/upload-rs-imgs", data, {
          headers: {
            "Content-Type": "multipart/form-data",
            Authorization: `Bearer ${this.token}`
          }
        })
        .then(() => {
          this.$router.push({ name: "allObjects" });
        });
    }
  }
};
</script>

<style scoped lang="scss">
.form {
  max-width: 70%;
  margin: 0 auto;
}
@media screen and (max-width: 800px) {
  .form {
    max-width: 100%;
  }
}
.image {
  width: 120px;
  height: 140px;
  display: block;
  margin: 0 auto;
  margin-bottom: 20px;
  margin-right: 15px;
}
.images {
  display: flex;
  flex-wrap: wrap;
}
</style>
