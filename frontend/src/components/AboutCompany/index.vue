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
        <v-col cols="12">
          <v-img
            class="logo"
            src="@/assets/logo.png"
            max-width="220"
            max-height="100"
          />
          <p class="title mt-4 text-center">
            Компания АКМ специализируется на коммерческой недвижимости Киева.
          </p>
          <div class="item">
            <v-img
              class="item-logo"
              src="@/assets/dot-arrow.png"
              max-width="34"
              max-height="65"
            />
            <p class="description">
              Управление объектами недвижимости, аренда и продажа торговых и
              офисных площадей, а также инвестиции в арендный бизнес –
              приоритетные направления нашей компании.
            </p>
          </div>
          <div class="item">
            <v-img
              class="item-logo"
              src="@/assets/dot-arrow.png"
              max-width="34"
              max-height="65"
            />
            <p class="description">
              Более чем 10-летняя история компании, наши давние партнерские
              отношения с владельцами недвижимости и надёжными сетевыми
              арендаторами - это доказательство того, что наш комплексный подход
              обеспечивает наилучшие результаты.
            </p>
          </div>
          <div class="item">
            <v-img
              class="item-logo"
              src="@/assets/dot-arrow.png"
              max-width="34"
              max-height="65"
            />
            <p class="description">
              Мы анализируем рынок недвижимости и находим помещения в самых
              популярных и доходных локациях, так как при выборе коммерческой
              недвижимости есть три основополагающих фактора:
              <strong>Локация, Локация и еще раз локация</strong>.
            </p>
          </div>
          <div class="item">
            <v-img
              class="item-logo"
              src="@/assets/dot-arrow.png"
              max-width="34"
              max-height="65"
            />
            <p class="description">
              Наши сотрудники индивидуально подходят к реализации каждого
              проекта и проведению каждой сделки, демонстрируя свой
              профессионализм в разработке стратегии для достижения целей наших
              клиентов.
            </p>
          </div>
          <div class="item">
            <v-img
              class="item-logo"
              src="@/assets/dot-arrow.png"
              max-width="34"
              max-height="65"
            />
            <p class="description">
              Мы знаем как реализовать ваш объект по максимальной цене в
              кратчайшие сроки! Больше о нашей компании расскажет раздел
              <router-link class="item-link" to="/realized-objects"
                >РЕАЛИЗОВАННЫЕ ОБЪЕКТЫ</router-link
              >, где представлена часть наших проектов.
            </p>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<style scoped>
.wrapper {
  background-image: url("../../assets/bg-main.png");
  background-position: center;
  background-size: cover;
}
.logo {
  margin: 0 auto;
}
.title {
  font-weight: bold;
  color: white;
}
.item {
  margin: 20px auto;
  max-width: 920px;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
}
.description {
  margin-bottom: 0;
  margin-left: 30px;
}
.item-link {
  color: white;
  text-decoration: none;
  transition: all 0.3s linear;
}
.item-link:hover {
  transition: all 0.3s linear;
  border-bottom: 1px dotted white;
}
</style>
