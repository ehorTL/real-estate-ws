<template>
  <div>
    <Form @click="addNewObject" />
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
  </div>
</template>

<script>
import Form from "../Form";
export default {
  components: {
    Form
  },
  metaInfo: {
    title: "Добавить объект"
  },
  data() {
    return {
      objectId: null,
      dialog: false
    };
  },
  computed: {
    token() {
      return this.$store.getters.getToken;
    }
  },
  methods: {
    async addNewObject(formData, pricePerMeter, mainImage, images) {
      this.dialog = true;
      await this.axios
        .post(
          "admin/real-estate",
          {
            title: formData.title,
            description: formData.description,
            currency_id: formData.currency,
            price: +formData.price,
            price_per_square_meter: +pricePerMeter,
            square: +formData.area,
            address: formData.address,
            agent: formData.agent,
            mobile_number: formData.telephone,
            email: formData.email,
            realized: formData.isRealized,
            has_commision: formData.commission,
            real_estate_categories: formData.objectType,
            contract_type_id: formData.deal,
            show_in_slider: formData.isSlider
          },
          {
            headers: {
              Authorization: `Bearer ${this.token}`
            }
          }
        )
        .then(res => {
          this.objectId = res.data.id;
        });
      await this.setMainImage(mainImage);
      await this.setImages(images);
      this.dialog = false;
      await this.$router.push({ name: "allObjects" });
    },
    async setMainImage(mainImage) {
      let data = new FormData();
      data.append("real_estate_id", this.objectId);
      data.append("img", mainImage);
      await this.axios.post("admin/set-rs-main-img", data, {
        headers: {
          "Content-Type": "multipart/form-data",
          Authorization: `Bearer ${this.token}`
        }
      });
    },
    async setImages(images) {
      if (images) {
        let data = new FormData();
        data.append("real_estate_id", this.objectId);
        for (var i = 0; i < images.length; i++) {
          let image = images[i];

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
  }
};
</script>

<style scoped></style>
