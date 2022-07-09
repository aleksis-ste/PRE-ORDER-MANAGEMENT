<template>
  <div class="home">
    <NavBar/>
    <b-container>
      <b-row>
        <b-card
          v-for="item in items.variations"
          :key="item.id"
          :img-src="`${api}/products/image/${item.image}`"
          img-alt="Image"
          img-top
          style="max-width: 20rem;"
          class="m-1 position-relative"
          :title="items.name"
        >
          <img v-if="symbol" :src="`${api}/design/symbols/image/${symbol.image}`" alt="symbol" style="top: -30%; bottom: 0; right: 0; left: 0;" class="position-absolute m-auto" width="100%">
          <h3>{{items.price}}$</h3>
          <b-button @click="addToCart(item.id)">Add to cart</b-button>
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
      symbol: null,
    }
  },
  async mounted() {
    await axios.get(`/products/${this.$route.params.product}`).then(response => {
      this.items = response.data
      console.log(this.items)
    })

    await axios.get(`/design/symbols/${this.$route.params.symbol}`).then(response => {
      this.symbol = response.data
      console.log(response)
    })
  },
  methods: {
    addToCart(variation) {
      let data = {
        symbol: this.$route.params.symbol,
        product: this.$route.params.product,
        variation: variation,
      }

      let cart = localStorage.getItem('cart');

      if(cart) cart = JSON.parse(cart)
      else cart = []

      cart.push(data)

      localStorage.setItem('cart', JSON.stringify(cart))

      this.$store.commit('setCount', cart.length)

      this.$bvToast.toast('Product added to cart', {
        title: 'Success',
        autoHideDelay: 5000,
        variant: 'success',
        appendToast: false
      })
    }
  }
};
</script>
