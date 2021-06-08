<template>
  <div class="form elevation-10">
    <h3 class="title">Свяжитесь с нами</h3>
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-text-field
        class="field"
        v-model="name"
        :rules="rules"
        placeholder="Ваше имя"
        dense
        solo
        required
        background-color="#e9e7e7"
      ></v-text-field>

      <v-text-field
        class="field"
        v-model="number"
        :rules="rules"
        placeholder="Номер телефона"
        dense
        solo
        required
        background-color="#e9e7e7"
        v-mask="'+38(###)-###-##-##'"
      ></v-text-field>

      <v-textarea
        class="field"
        v-model="description"
        placeholder="Примечание"
        auto-grow
        rows="3"
        dense
        solo
        background-color="#e9e7e7"
      />

      <v-btn :disabled="!valid" class="subm-button d-flex" @click="validate">
        Отправить
      </v-btn>
    </v-form>
  </div>
</template>

<script>
export default {
  data: () => ({
    valid: true,
    name: "",
    number: "",
    description: "",
    rules: [v => !!v || "Обязательное поле"]
  }),
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        this.axios.post("common/send-feedback", {
          name: this.name,
          tel: this.number,
          text: this.description,
          email: "",
          subject: ""
        });
        this.$emit("click");
      }
    }
  }
};
</script>

<style scoped lang="scss">
.form {
  max-width: 300px;
  border-radius: 20px;
  padding: 20px;
  margin-left: auto;
}
.title {
  text-align: center;
  font-weight: bold;
  margin-bottom: 20px;
}
.field {
  border-radius: 12px !important;
}
.subm-button {
  margin: auto;
  background-color: #1e2d3b !important;
  border-radius: 12px !important;
  color: white;
  text-transform: none;
  font-weight: normal;
  padding-left: 50px !important;
  padding-right: 50px !important;
}
@media screen and (max-width: 960px) {
  .form {
    margin: auto;
  }
}
</style>
