<template>
  <div>
    <v-dialog v-model="dialog" width="400">
      <template v-slot:activator="{ on, attrs }">
        <v-btn class="mt-3 share-btn" v-bind="attrs" v-on="on">
          <v-icon class="mr-2">mdi-share-variant-outline</v-icon>
          Поделиться
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="headline">
          Поделиться объектом в:
        </v-card-title>
        <div class="share-network-list">
          <ShareNetwork
            v-for="network in networks"
            :network="network.network"
            :key="network.network"
            :style="{ backgroundColor: network.color }"
            :url="sharing.url"
            :title="sharing.title"
            :description="sharing.description"
            :quote="sharing.quote"
          >
            <div class="titles">
              <v-icon size="45" color="rgb(33, 150, 243)">{{
                network.icon
              }}</v-icon>
            </div>
          </ShareNetwork>
          <a
            class="sharing-item"
            :href="viber"
            target="_blank"
            @click="viberSharingLink"
          >
            <img
              class="sharing-item"
              src="@/assets/share-vb.png"
              alt="Viber"
              width="45"
              height="45"
            />
          </a>
        </div>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  props: {
    object: {
      type: Object
    }
  },
  data() {
    return {
      dialog: false,
      sharing: {
        url: null,
        description: null,
        title: null,
        quote: null
      },
      networks: [
        {
          network: "email",
          name: "Email",
          icon: "mdi-email-newsletter"
        },
        {
          network: "facebook",
          name: "Facebook",
          icon: "mdi-facebook"
        },
        {
          network: "telegram",
          name: "Telegram",
          icon: "mdi-telegram"
        },
        {
          network: "whatsapp",
          name: "Whatsapp",
          icon: "mdi-whatsapp"
        }
      ],
      viber: null
    };
  },
  created() {
    this.sharing.url = window.location.href;
    this.sharing.title = this.object.title;
    if (!this.object.has_commision) {
      this.sharing.description = `Адрес: ${this.object.address}%0AПлощадь: ${this.object.square} м/2%0A%0AБез Комисии!`;
      this.sharing.quote = `Адрес: ${this.object.address}  Площадь: ${this.object.square} м/2  Без Комисии!`;
    } else {
      this.sharing.description = `Адрес: ${this.object.address}%0AПлощадь: ${this.object.square} м/2}`;
      this.sharing.quote = `Адрес: ${this.object.address}  Площадь: ${this.object.square} м/2}`;
    }
  },
  methods: {
    viberSharingLink() {
      if (!this.object.has_commision) {
        this.sharing.description = `Адрес: ${this.object.address}%0AПлощадь: ${this.object.square} м/2%0A%0AБез Комисии!`;
      } else {
        this.sharing.description = `Адрес: ${this.object.address}%0AПлощадь: ${this.object.square} м/2}`;
      }
      this.viber = `viber://forward?text=${this.object.title}%0D%0A${this.sharing.url}%0D%0A${this.sharing.description}`;
    }
  }
};
</script>

<style scoped>
.share-network-list {
  display: flex;
  justify-content: center;
  padding: 20px;
  flex-wrap: wrap;
}
.titles {
  margin-right: 20px;
}
a {
  text-decoration: none;
}
.share-btn {
  text-transform: none;
  font-size: 15px;
  width: 100%;
  color: #000000de;
  justify-content: start;
}
</style>
