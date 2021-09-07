<template>
  <footer class="footer" :class="{ 'show-background': showBackground }">
    <div class="information">
      <div class="main-information">
        <div class="address">
          <v-img
            class="icon"
            src="@/assets/home.png"
            max-width="28"
            max-height="22"
          />
          <p>Киев ул. Мечникова, 14, оф.406</p>
        </div>
        <div class="telephone">
          <v-img
            class="icon"
            src="@/assets/phone-call.png"
            max-width="25"
            max-height="25"
          />
          <p>(097)147-77-88</p>
        </div>
      </div>
      <div class="company">
        <p>Компания коммерческой недвижимости АКМ © 2021</p>
        <v-img
          class="logo"
          src="@/assets/logo.png"
          max-width="50"
          max-height="22"
        />
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  props: {
    showBackground: {
      type: Boolean,
      default: true
    }
  }
};
</script>

<style scoped>
footer {
  width: 100%;
  padding-top: 30px;
  padding-bottom: 30px;
  background-color: rgb(30, 45, 59);
}
.show-background {
  background-image: url("../../assets/bg-main.png");
  background-position: center;
  background-size: cover;
}
p {
  margin: 0;
}
.information {
  width: 100%;
  color: white;
}
.main-information {
  width: 90%;
  display: flex;
  justify-content: center;
  margin: auto;
  border-bottom: 2px solid #fff;
}
.address,
.telephone {
  display: flex;
  margin-bottom: 10px;
}
.icon {
  margin-right: 10px;
}
.address {
  margin-right: 80px;
}
.company {
  margin-top: 20px;
  font-size: 12px;
  display: flex;
  justify-content: center;
}
.logo {
  margin-left: 15px;
}

@media screen and (max-width: 580px) {
  .main-information,
  .company {
    align-items: center;
    flex-direction: column;
  }
  .address {
    margin-right: 0;
  }
  .address,
  .telephone p {
    text-align: center;
  }
  .logo {
    margin-top: 10px;
  }
}
</style>
