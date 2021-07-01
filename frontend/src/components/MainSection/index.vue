<template>
  <div class="wrapper">
    <v-container fill-height>
      <v-row
        class="mt-10 mb-10"
        justify="space-between"
        align="center"
        justify-md="center"
        justify-sm="center"
      >
        <v-col cols="12" xl="3" lg="3" md="12" sm="12">
          <buttons-group class="button-group" />
        </v-col>
        <v-col cols="12" xl="7" lg="9" md="12" sm="12">
          <v-img
            class="logo"
            src="@/assets/logo.png"
            max-width="140"
            max-height="65"
          />
          <p class="main-title mt-5">{{ title }}</p>
          <p class="description" v-if="description">{{ description }}</p>
          <main-slider v-if="showSlider" />
          <v-dialog v-model="dialog" width="500" class="dialog">
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                class="form-btn mt-10"
                :width="205"
                :height="50"
                v-bind="attrs"
                v-on="on"
              >
                Свяжитесь с нами
              </v-btn>
            </template>
            <feedback-form @click="dialog = false" />
          </v-dialog>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import ButtonsGroup from "../../components/ButtonsGroup";
import MainSlider from "../../components/MainSlider";
import FeedbackForm from "../../components/FeedbackForm";
export default {
  props: {
    title: {
      type: String
    },
    showSlider: {
      type: Boolean,
      default: false
    },
    description: {
      type: String
    }
  },
  data() {
    return {
      dialog: false
    };
  },
  components: {
    FeedbackForm,
    MainSlider,
    ButtonsGroup
  }
};
</script>

<style scoped lang="scss">
.wrapper {
  height: calc(100vh - 64px);
  background-image: url("../../assets/bg-main.png");
  background-position: center;
  background-size: cover;
}
.logo {
  margin: auto;
}
.main-title {
  font-size: 35px;
  text-align: center;
  color: white;
}
.button-group {
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
}
.form-btn {
  display: flex;
  margin: auto;
  text-transform: none;
  padding-top: 20px !important;
  padding-bottom: 20px !important;
  border-radius: 30px;
  font-size: 17px;
}
.description {
  max-width: 560px;
  margin: 0 auto;
  color: white;
}
::v-deep .form {
  margin: 0 auto;
  background-color: white;
}
::v-deep .v-dialog {
  box-shadow: none;
}
@media screen and (max-width: 1265px) {
  .wrapper {
    height: auto;
  }
}
</style>
