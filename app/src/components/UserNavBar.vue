<template>
    <b-navbar toggleable="lg" type="dark" variant="info">
        <b-navbar-brand :to="{ name: 'home' }">PRE-ORDER</b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
                <template v-for="item in nav">
                    <template v-if="item.type === 'cart'">
                        <b-nav-item :to="{ name: 'cart' }" :key="item.id">
                            {{ item.name}}
                            <b-badge variant="light">{{ $store.state.count }}</b-badge>
                        </b-nav-item>
                    </template>
                    <template v-else-if="item.type === 'home'">
                        <b-nav-item :to="{ name: 'home' }" :key="item.id">{{ item.name}}</b-nav-item>
                    </template>
                    <template v-else-if="item.type === 'admin'">
                        <b-nav-item :to="{ name: 'login' }" :key="item.id">{{ item.name}}</b-nav-item>
                    </template>
                    <template v-else>
                        <b-nav-item :key="item.id">{{ item.name}}</b-nav-item>
                    </template>
                </template>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
export default {
    data() {
        return {
            nav: []
        }
    },
    mounted() {
        axios.get('/navigation').then(response => {
            this.nav = response.data
        })
    }
}
</script>