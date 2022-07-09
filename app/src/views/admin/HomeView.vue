<template>
  <div>
    <NavBar/>
    <h1>MAIN MENU ITEM RE-ORDERING</h1>

    <ul id="items" class="list-unstyled">
      <li v-for="item in items" :key="item.id" :data-id="item.id">{{ item.name }}</li>
    </ul>

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
    }
  },
  async mounted() {
    await axios.get('/navigation').then(response => {
      this.items = response.data
    })

    const el = document.getElementById('items');
    const sortable = Sortable.create(el, {
      onEnd: (evt) => {
        axios.post('/navigation', {order: sortable.toArray()})
      }
    });
  },  
};
</script>
