<template>
  <div>
    <NavBar/>
    <h1>DESIGN SYMBOL MANAGEMENT</h1>

    <b-form-group label="Upload design symbol" label-cols-sm="2" label-size="sm">
      <b-form-file v-model="file" id="file-small" size="sm" accept="image/*"></b-form-file>
    </b-form-group>

    <b-container>
      <b-row no-gutters align-content="center">
        <b-card
          v-for="item in items"
          :key="item.id"
          :img-src="`${api}/design/symbols/image/${item.image}`"
          img-alt="Image"
          img-top
          style="max-width: 20rem;"
          class="m-1"
        >
          <b-button variant="primary" @click="disable(item.id, item.status)" class="mr-2">{{ item.status ? 'Disable' : 'Enable' }}</b-button>
    
          <b-button variant="danger" @click="destory(item.id)" :disabled="item.status">Delete</b-button>
        </b-card>
      </b-row>

    </b-container>

  </div>
</template>

<script>
import Sortable from 'sortablejs';
import NavBar from "@/components/NavBar.vue";

export default {
  name: "HomeView",
  components: {
    NavBar,
  },
  data() {
    return {
      items: [],
      fields: ['order', 'name'],
      api: process.env.VUE_APP_API,
    }
  },
  async mounted() {
    await this.fetchData()
  },  
  computed: {
    file: {
      set(data) {
        let form = new FormData()
        form.append('image', data)

        axios.post('/design/symbols', form).then(response => {
          this.fetchData()
        })
      },
      get() {

      }
    }
  },
  methods: {
    async fetchData() {
      await axios.get('/design/symbols').then(response => {
        this.items = response.data
      })
    },
    disable(id, status) {
      axios.post(`/design/symbols/${id}`, {status: !status}).then(async () => {
        await this.fetchData()
      })
    },
    destory(id) {
      axios.delete(`/design/symbols/${id}`).then(async () => {
        await this.fetchData()
      })
    }
  }
};
</script>
