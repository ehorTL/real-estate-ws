<template>
  <v-app>
    <v-app-bar app>
      <v-col class="text-center" cols="12">
        <strong>AKM</strong>
      </v-col>
    </v-app-bar>
    <v-main>
      <v-container fill-height fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" lg="4" md="5" sm="8">
            <div class="login">
              <v-form ref="form" v-model="valid" lazy-validation>
                <v-text-field
                  label="Логин"
                  v-model="login"
                  :rules="validationRules"
                  outlined
                  required
                  name="login"
                />
                <v-text-field
                  label="Пароль"
                  v-model="password"
                  :rules="validationRules"
                  outlined
                  required
                  :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="showPassword ? 'text' : 'password'"
                  name="password"
                  autocomplete="on"
                  @click:append="showPassword = !showPassword"
                />
                <v-btn
                  height="45px"
                  color="#f0ad4e"
                  class="submit-login"
                  @click="validate"
                >
                  Войти
                </v-btn>
              </v-form>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </v-main>

    <v-footer app>
      <v-col class="text-center" cols="12">
        {{ new Date().getFullYear() }} — <strong>AKM</strong>
      </v-col>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    valid: true,
    login: "",
    password: "",
    showPassword: false,
    validationRules: [v => !!v || "Заполните поле"]
  }),
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        this.$store
          .dispatch("login", {
            login: this.login,
            password: this.password
          })
          .then(() => {
            this.$router.push({ name: "allObjects" });
          });
      }
    }
  }
};
</script>

<style scoped>
.submit-login {
  width: 250px;
  display: block;
  margin: 0 auto;
}
</style>
