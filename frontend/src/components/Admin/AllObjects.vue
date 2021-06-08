<template>
  <v-card>
    <h2 class="ml-4 mt-4">Все объекты</h2>
    <v-card-title class="pt-0">
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Поиск"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="objects"
      :search="search"
      :loading="loadingTable"
      loading-text="Загрузка... Пожалуйста, подождите"
      :footer-props="{
        'items-per-page-options': [20, 40, 80, -1],
        'items-per-page-text': 'Количество:'
      }"
    >
      <template v-slot:top>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="headline">Удалить данный объект?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="red darken-1" text @click="closeDelete"
                >Отмена</v-btn
              >
              <v-btn color="green darken-1" text @click="deleteItemConfirm"
                >Удалить</v-btn
              >
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">
          mdi-pencil
        </v-icon>
        <v-icon small @click="deleteItem(item)">
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:no-data>
        <v-alert :value="true" color="error">
          Извините, таблица пустая :(
        </v-alert>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
export default {
  metaInfo: {
    title: "Все объекты"
  },
  data() {
    return {
      search: "",
      dialogDelete: false,
      deletedItem: {},
      loadingTable: true,
      itemsPerPage: 9999,
      page: 1,
      lastPage: null,
      headers: [
        {
          text: "ID",
          align: "start",
          value: "id"
        },
        { text: "Название", value: "title" },
        { text: "Создатель", value: "agent" },
        { text: "Дата", value: "date" },
        { text: "Действия", value: "actions", sortable: false }
      ],
      objects: []
    };
  },
  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    }
  },
  computed: {
    token() {
      return this.$store.getters.getToken;
    }
  },
  created() {
    this.getAllObjects();
  },
  methods: {
    getAllObjects() {
      this.axios
        .get(`common/real-estate-featured?per_page=${this.itemsPerPage}`)
        .then(res => {
          this.objects = res.data.data.map(el => ({
            title: el.title,
            agent: el.agent,
            id: el.id,
            date: el.created_at
          }));
          this.loadingTable = false;
        })
        .catch(e => {
          this.loadingTable = true;
          console.log(e);
        });
    },
    deleteItem(item) {
      this.deletedItem = item;
      this.dialogDelete = true;
    },
    deleteItemConfirm() {
      this.axios
        .delete(`admin/real-estate/${this.deletedItem.id}`, {
          headers: {
            Authorization: `Bearer ${this.token}`
          }
        })
        .then(() => {
          this.objects = this.objects.filter(
            el => el.id !== this.deletedItem.id
          );
        });
      this.closeDelete();
    },
    closeDelete() {
      this.dialogDelete = false;
    },
    editItem(item) {
      this.$router.push({ name: "editObject", params: { id: item.id } });
    }
  }
};
</script>

<style scoped></style>
