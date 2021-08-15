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

        <v-select
          v-model="formData.agent"
          :items="agentsItems"
          :rules="mainRule"
          item-text="type"
          item-value="value"
          label="Агент"
          required
          outlined
          :menu-props="{ bottom: true, offsetY: true }"
        ></v-select>

        <v-text-field
          v-model="formData.telephone"
          label="Номер телефона"
          v-mask="'+38(###)-###-##-##'"
          disabled
          outlined
        ></v-text-field>

        <v-text-field
          v-model="formData.email"
          label="E-mail"
          disabled
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

        <image-uploader
          v-if="showImageInput"
          @getMainImage="getMainImage"
          @deleteMainImage="clearMainImage"
          :value="valueImage"
          :main-image-url="mainImageUrl"
        />
        <span v-if="!showImageInput">Главное фото:</span>
        <div
          v-if="!showImageInput"
          class="main-image-wrapper d-flex justify-center elevation-4 ma-2"
        >
          <div class="image-wrapper">
            <img class="image" :src="`${imgUrl}/${mainImage}`" />
          </div>
        </div>

        <multiple-image-uploader
          v-if="showImagesInput"
          @getMainImages="getMainImages"
          @deleteImage="clearImage"
          @changeImages="changeImages"
          :value="valueImages"
          :images="mainImages"
        />

        <span v-if="!showImagesInput">Другие фото:</span>
        <div v-if="!showImagesInput" class="images elevation-4 ma-2">
          <div class="image-wrapper" v-for="(image, i) in images" :key="i">
            <img class="image" :src="`${imgUrl}/${image.url}`" />
          </div>
        </div>

        <div class="controls mt-5 d-flex justify-space-between flex-wrap">
          <v-btn class="mb-4" v-if="!showImageInput" @click="deleteMainImage">
            Удалить главное фото
          </v-btn>
          <v-btn class="mb-4" v-if="!showImagesInput" @click="deleteImages">
            Удалить другие фото
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
    <v-dialog v-if="dialog" v-model="dialog" persistent width="300">
      <v-card color="primary" dark>
        <v-card-text>
          Пожалуйста, подождите, загружаются фотографии
          <v-progress-linear
            indeterminate
            color="white"
            class="mt-2"
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
import MultipleImageUploader from "../MultipleImageUploader";
import ImageUploader from "../ImageUploader";
export default {
  name: "EditObject",
  components: {
    MultipleImageUploader,
    ImageUploader
  },
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
    agentsItems: [
      {
        type: "Кирилюк Александр",
        value: "Кирилюк Александр"
      },
      {
        type: "Фильченков Дмитрий",
        value: "Фильченков Дмитрий"
      },
      {
        type: "Неилко Галина",
        value: "Неилко Галина"
      },
      {
        type: "Геннадий Кушманцев",
        value: "Геннадий Кушманцев"
      },
      {
        type: "Москаленко Александр",
        value: "Москаленко Александр"
      }
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
    showPreloader: true,
    dialog: false,
    valueImages: [],
    valueImage: []
  }),
  watch: {
    "formData.agent": {
      handler(val) {
        if (val == "Кирилюк Александр") {
          this.formData.telephone = "0672321325";
          this.formData.email = "2321325@gmail.com";
        } else if (val == "Фильченков Дмитрий") {
          this.formData.telephone = "0936164919";
          this.formData.email = "akm2.kiev@gmail.com";
        } else if (val == "Неилко Галина") {
          this.formData.telephone = "0960202828";
          this.formData.email = "lady.nelko82@gmail.com";
        } else if (val == "Геннадий Кушманцев") {
          this.formData.telephone = "0934494130";
          this.formData.email = "KushG.akm2@gmail.com";
        } else {
          this.formData.telephone = "0675364060";
          this.formData.email = "a.n.moskalenko14@gmail.com";
        }
      }
    }
  },
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
          this.formData.commission = this.checkType(res.data.has_commision);
          this.formData.agent = res.data.agent;
          this.formData.telephone = res.data.mobile_number;
          this.formData.email = res.data.email;
          this.formData.isRealized = this.checkType(res.data.realized);
          this.formData.isSlider = this.checkType(res.data.show_in_slider);
          this.formData.archieved = this.checkType(res.data.archieved);
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
    checkType(data) {
      if (data == 0) {
        return "false";
      } else {
        return "true";
      }
    },
    clearMainImage() {
      this.valueImage = null;
      this.mainImageUrl = null;
    },
    getMainImage(e) {
      if (e) {
        this.valueImage = e;
        this.mainImageUrl = URL.createObjectURL(e[0]);
      }
    },
    getMainImages(e) {
      if (e) {
        this.valueImages = e;
        this.mainImages = e.map(el => {
          return URL.createObjectURL(el);
        });
      }
    },
    clearImage(index) {
      this.valueImages.splice(index, 1);
      this.mainImages.splice(index, 1);
    },
    async changeImages(event) {
      this.valueImages = await this.swap(
        this.valueImages,
        event.moved.oldIndex,
        event.moved.newIndex
      );
    },
    swap(arr, a, b) {
      arr[a] = arr.splice(b, 1, arr[a])[0];
      return arr;
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
          this.showImagesInput = true;
          this.images = [];
        });
    },
    async validate() {
      if (this.$refs.form.validate()) {
        this.dialog = true;
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
        if (this.valueImage[0] && this.valueImage[0].type) {
          await this.setMainImage();
        }
        if (
          this.valueImages.length > 0 &&
          this.valueImages.filter(el => el.id).length <= 0
        ) {
          await this.setImages();
        }
        this.dialog = false;
        await this.$router.push({ name: "allObjects" });
      }
    },
    async setMainImage() {
      let data = new FormData();
      data.append("real_estate_id", this.$route.params.id);
      data.append("img", this.valueImage[0]);
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
      for (var i = 0; i < this.valueImages.length; i++) {
        let image = this.valueImages[i];

        data.append("images[]", image);
      }
      await this.axios.post("admin/upload-rs-imgs", data, {
        headers: {
          "Content-Type": "multipart/form-data",
          Authorization: `Bearer ${this.token}`
        }
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
.main-image-wrapper {
  border: 1px dashed;
  border-radius: 4px;
  padding: 10px;
  .image-wrapper {
    margin: 0;
  }
}
.image-wrapper {
  margin-bottom: 20px;
  margin-right: 20px;
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
.images {
  border: 1px dashed;
  border-radius: 4px;
  padding: 10px;
  display: flex;
  flex-wrap: wrap;
}
</style>
