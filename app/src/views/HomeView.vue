<template>
  <div class="home">
    <NavBar/>
    <b-container>
      <b-row>
        <b-card
          v-for="item in items"
          :key="item.id"
          v-show="item.status === true"
          :img-src="`${api}/design/symbols/image/${item.image}`"
          img-alt="Image"
          img-top
          style="max-width: 20rem;"
          class="m-1"
        >
          <b-button :to="{ name: 'products', params: { symbol: item.id }}">Select</b-button>
        </b-card>
      </b-row>
    </b-container>
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from "@/components/UserNavBar.vue";

export default {
  name: "HomeView",
  components: {
    NavBar,
  },
  data() {
    return {
      items: [],
      api: process.env.VUE_APP_API,
    }
  },
  mounted() {
    axios.get('/design/symbols').then(response => {
      this.items = response.data
    })
  }
};
</script>
