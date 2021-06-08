<template>
  <div class="wrapper">
    <v-container>
      <Title class="mt-10" title="Контактная информация" />
      <v-row class="mt-10 mb-10" justify="space-between" justify-sm="center">
        <v-col cols="12" xl="5" lg="7" md="10" sm="10">
          <div class="contact-list">
            <div class="wrapper-list">
              <div
                class="contact-item"
                v-for="(contact, index) in contactList"
                :key="index"
              >
                <p class="name">{{ contact.name }}</p>
                <p class="telephone">
                  Моб:<span>{{ contact.telephone }}</span>
                </p>
                <p class="email">
                  E-mail:<span>{{ contact.email }}</span>
                </p>
              </div>
            </div>
            <div class="wrapper-list">
              <div
                class="contact-item"
                v-for="(contact, index) in contactList2"
                :key="index"
              >
                <p class="name">{{ contact.name }}</p>
                <p class="telephone">
                  Моб:<span>{{ contact.telephone }}</span>
                </p>
                <p class="email">
                  E-mail:<span>{{ contact.email }}</span>
                </p>
              </div>
              <v-img
                class="logo mt-12"
                src="@/assets/logo-blue.png"
                max-width="125"
                max-height="57"
              />
            </div>
          </div>
        </v-col>
        <v-col cols="12" lg="4" md="4" sm="10">
          <feedback-form />
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import FeedbackForm from "../../components/FeedbackForm";
import Title from "../../components/Title";
export default {
  components: {
    FeedbackForm,
    Title
  },
  data() {
    return {
      contactList: [
        {
          name: "Кирилюк Александр",
          telephone: "(067) 232-13-25",
          email: "2321325@gmail.com"
        },
        {
          name: "Фильченков Дмитрий",
          telephone: "(093) 616-49-19",
          email: "akm2.kiev@gmail.com"
        },
        {
          name: "Неилко Галина",
          telephone: "(096) 020-28-28",
          email: "lady.nelko82@gmail.com"
        }
      ],
      contactList2: [
        {
          name: "Геннадий Кушманцев",
          telephone: "(093) 449-41-30",
          email: "KushG.akm2@gmail.com"
        },
        {
          name: "Москаленко Александр",
          telephone: "(067) 536-40-60",
          email: "a.n.moskalenko14@gmail.com"
        }
      ]
    };
  }
};
</script>

<style scoped>
.wrapper {
  background-color: #f7f5f5;
}
.contact-list {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}
.contact-item {
  margin-bottom: 30px;
}
.name,
.telephone,
.email {
  margin: 0;
  font-size: 20px;
  font-weight: bold;
  color: #1e2d3b;
}
.telephone span,
.email span {
  font-weight: normal;
  margin-left: 5px;
  font-size: 18px;
}
.logo {
  margin: auto;
}
</style>
