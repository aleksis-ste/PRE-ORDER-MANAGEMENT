<template>
  <div class="home">
    <NavBar/>
    <b-container>
      <b-row>
        <b-card
          v-for="item in items"
          :key="item.id"
          :img-src="`${api}/products/image/${item.variations[0].image}`"
          img-alt="Image"
          img-top
          style="max-width: 20rem;"
          class="m-1"
          :title="item.name"
        >
          <h3>{{item.price}}$</h3>
          <b-button :to="{ name: 'variations', params: { symbol: $route.params.symbol, product: item.id }}">Select</b-button>
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
      symbol: null,
      api: process.env.VUE_APP_API,
    }
  },
  async mounted() {
    await axios.get('/products').then(response => {
      this.items = response.data
      console.log(this.items)
    })
  }
};
</script>
