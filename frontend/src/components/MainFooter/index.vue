<template>
  <footer class="footer">
    <div class="wrapper">
      <div class="items-wrapper">
        <div class="rent">
          <h3 class="item-title">Аренда помещений</h3>
          <div class="list">
            <router-link
              class="item-link"
              v-for="(rentItem, index) in rentList"
              :key="index"
              :to="rentItem.to"
            >
              {{ rentItem.title }}
            </router-link>
          </div>
        </div>
        <div class="sale">
          <h3 class="item-title">Продажа помещений</h3>
          <div class="list">
            <router-link
              class="item-link"
              v-for="(saleItem, index) in saleList"
              :key="index"
              :to="saleItem.to"
            >
              {{ saleItem.title }}
            </router-link>
          </div>
        </div>
      </div>
      <div class="underline" />
      <div class="information">
        <div class="main-information">
          <span>Адрес:</span>
          <p>Киев ул. Мечникова, 14, оф.406</p>
          <div class="information-wrapper">
            <div>
              <span>Телефон: </span>
              <p>(097)147-77-88</p>
            </div>
            <div class="email">
              <span>E-mail: </span>
              <p>akmkiev2010@gmail.com</p>
            </div>
          </div>
        </div>
        <div class="social-information">
          <v-img
            class="logo"
            src="@/assets/logo.png"
            max-width="140"
            max-height="65"
          />
          <div class="socials-list">
            <a href="https://t.me/+380971477788">
              <v-img
                src="@/assets/telegram.png"
                max-width="31"
                max-height="31"
              />
            </a>
            <a href="https://api.whatsapp.com/send?phone=380971477788">
              <v-img
                src="@/assets/whatsapp.png"
                max-width="31"
                max-height="31"
              />
            </a>
            <a href="viber://chat/?number=%2B380971477788" target="_blank">
              <v-img
                src="@/assets/viber.png"
                max-width="31"
                max-height="31"
              />
            </a>
          </div>
        </div>
      </div>
      <div class="underline" />
      <div class="company">
        <p>Компания комерческой недвижимости АКМ © 2021</p>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  data() {
    return {
      rentList: [
        {
          title: "Аренда офисов",
          to: "/rent-offices"
        },
        {
          title: "Аренда ресторанов",
          to: "/rent-restaurants"
        },
        {
          title: "Аренда магазинов",
          to: "/rent-shops"
        },
        {
          title: "Аренда зданий",
          to: "/rent-builds"
        }
      ],
      saleList: [
        {
          title: "Продажа офисов",
          to: "/sale-offices"
        },
        {
          title: "Продажа ресторанов",
          to: "/sale-restaurants"
        },
        {
          title: "Продажа магазинов",
          to: "/sale-shops"
        },
        {
          title: "Продажа зданий",
          to: "/sale-builds"
        },
        {
          title: "Доходная недвижемость",
          to: "/sale-property"
        }
      ]
    };
  }
};
</script>

<style scoped lang="scss">
.footer {
  background-image: url("../../assets/bg-main.png");
  background-position: center;
  background-size: cover;
}
.wrapper {
  width: 80%;
  margin: 0 auto;
  padding-top: 30px;
  padding-bottom: 10px;
}
.underline {
  border-bottom: 2px solid #fff;
  margin-top: 20px;
  margin-bottom: 20px;
}
.items-wrapper {
  width: 80%;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  margin-bottom: 40px;
}
.item-title {
  font-size: 28px;
  color: white;
  margin-bottom: 10px;
}
.list {
  display: flex;
  flex-direction: column;
}
.item-link {
  font-size: 20px;
  color: white;
  text-decoration: none;
}
.item-link::after {
  content: "";
  display: block;
  width: 0;
  height: 2px;
  background: #fff;
  transition: width 0.3s;
}
.item-link:hover::after {
  width: 100%;
  transition: width 0.5s;
}
.information {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  width: 80%;
  margin: 0 auto;
}
.information-wrapper {
  display: flex;
  flex-wrap: wrap;
}
.socials-list {
  margin-top: 15px;
  display: flex;
  justify-content: space-between;
}
.main-information {
  color: white;
  span {
    font-size: 20px;
    font-weight: bold;
  }
  p {
    font-size: 19px;
  }
}
.email {
  margin-left: 20px;
}
.company {
  font-size: 18px;
  color: white;
  text-align: center;
}
@media screen and (max-width: 595px) {
  .information {
    justify-content: center;
  }
  .email {
    margin-left: 5px;
  }
}
</style>
