<template>
  <v-app-bar class="main__navigation">
    <v-container fluid class="pa-0">
      <div class="d-flex justify-space-between">
        <a class="logo" href="/">
          <img src="@/assets/logo.png" width="100" height="40" />
        </a>
        <v-spacer />
        <v-toolbar-items class="hidden-sm-and-down">
          <v-btn :to="'/'" class="toolbar__item" text max-width="200">
            Главная
          </v-btn>
          <v-menu class="mt-3" offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                class="toolbar__item"
                text
                max-width="200"
                v-bind="attrs"
                v-on="on"
              >
                Аренда коммерческой недвижимости
              </v-btn>
            </template>
            <div class="objects-categories">
              <v-btn
                class="object-btn"
                text
                v-for="(item, index) in rentList"
                :key="index"
                :to="item.link"
              >
                {{ item.title }}
              </v-btn>
            </div>
          </v-menu>
          <v-menu class="mt-3" offset-y>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                class="toolbar__item"
                text
                max-width="200"
                v-bind="attrs"
                v-on="on"
              >
                Продажа коммерческой недвижимости
              </v-btn>
            </template>
            <div class="objects-categories">
              <v-btn
                class="object-btn"
                text
                v-for="(item, index) in items2"
                :key="index"
                :to="item.link"
              >
                {{ item.title }}
              </v-btn>
            </div>
          </v-menu>
          <v-btn
            to="/portfolio"
            class="toolbar__item"
            text
            max-width="200"
          >
            Реализованные объекты
          </v-btn>
          <v-btn to="/o-kompanii" class="toolbar__item" text max-width="200">
            О компании
          </v-btn>
          <v-btn
            to="/izbrannye"
            class="toolbar__item"
            text
            max-width="200"
          >
            Избранные
          </v-btn>
        </v-toolbar-items>
        <v-menu
          :close-on-content-click="false"
          offset-y
          transition="fab-transition"
          class="menu"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              class="hidden-md-and-up menu-activator"
              v-bind="attrs"
              v-on="on"
            >
              Меню
            </v-btn>
          </template>
          <v-list color="menu-list">
            <v-btn :to="'/'" class="toolbar__item" text max-width="200">
              Главная
            </v-btn>
            <v-menu class="mt-3" offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  class="toolbar__item"
                  text
                  max-width="200"
                  v-bind="attrs"
                  v-on="on"
                >
                  Аренда объектов
                </v-btn>
              </template>
              <div class="objects-categories">
                <v-btn
                  class="object-btn"
                  text
                  v-for="(item, index) in rentList"
                  :key="index"
                  :to="item.link"
                >
                  {{ item.title }}
                </v-btn>
              </div>
            </v-menu>
            <v-menu class="mt-3" offset-y>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  class="toolbar__item"
                  text
                  max-width="200"
                  v-bind="attrs"
                  v-on="on"
                >
                  Продажа объектов
                </v-btn>
              </template>
              <div class="objects-categories">
                <v-btn
                  class="object-btn"
                  text
                  v-for="(item, index) in items2"
                  :key="index"
                  :to="item.link"
                >
                  {{ item.title }}
                </v-btn>
              </div>
            </v-menu>
            <v-btn
              to="/portfolio"
              class="toolbar__item"
              text
              max-width="200"
            >
              Реализованные объекты
            </v-btn>
            <v-btn to="/o-kompanii" class="toolbar__item" text max-width="200">
              О компании
            </v-btn>
            <v-btn
              to="/izbrannye"
              class="toolbar__item"
              text
              max-width="200"
            >
              Избранные
            </v-btn>
          </v-list>
        </v-menu>
      </div>
    </v-container>
  </v-app-bar>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      rentList: [
        { link: "/ofisy/arenda-ofisov", title: "Офисы" },
        { link: "/magaziny/arenda-magazinov", title: "Магазины" },
        { link: "/rent-builds", title: "Здания" },
        { link: "/restorany/arenda-restoranov", title: "Рестораны" }
      ],
      items2: [
        { link: "/ofisy/prodazha-ofisov", title: "Офисы" },
        { link: "/dokhodnaya-nedvizhimost", title: "Доходная недвижимость" },
        { link: "/magaziny/prodazha-magazinov", title: "Магазины" },
        { link: "/sale-builds", title: "Здания" },
        { link: "/restorany/prodazha-restoranov", title: "Рестораны" }
      ]
    };
  }
};
</script>

<style scoped>
.container {
  max-width: 1200px !important;
}
.logo {
  display: flex;
  align-items: center;
}
.main__navigation {
  background-color: #1e2d3b !important;
}
::v-deep .v-btn__content {
  white-space: pre-wrap;
  max-width: 200px;
  text-align: center;
}
.toolbar__item {
  color: #d5d6d8 !important;
  text-transform: none;
  font-size: 14px;
  margin-left: 10px;
}
.menu__link {
  cursor: pointer;
}
.menu__link:hover {
  border-bottom: 1px solid #fff;
  margin-bottom: -1px;
}
::v-deep.v-menu__content {
  margin-top: 12px;
  border-radius: 0 0 5px 5px;
}
.objects-categories {
  background-color: #1e2d3b;
  padding: 2px;
}
.object-btn {
  color: #f6f6f6 !important;
  text-transform: none;
  font-size: 13px !important;
  padding: 0 8px !important;
}

.menu-list {
  display: flex;
  color: #1e2d3b;
  justify-content: center;
  flex-direction: column;
}

.menu-activator {
  text-transform: none;
  font-size: 17px !important;
}
@media screen and (max-width: 960px) {
  ::v-deep.v-menu__content {
    margin-top: 0;
    width: 170px;
  }
  .objects-categories {
    display: flex;
    justify-content: center;
    flex-direction: column;
  }
  .toolbar__item {
    color: #1e2d3b !important;
  }
}

@media screen and (max-width: 1170px) {
  ::v-deep .v-btn__content {
    max-width: 170px !important;
  }
  .toolbar__item {
    max-width: 170px !important;
    margin-left: 0;
  }
}
</style>
