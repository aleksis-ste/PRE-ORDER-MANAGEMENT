<template>
    <b-navbar toggleable="lg" type="dark" variant="info">
        <b-navbar-brand href="#">Admin Panel</b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
                <b-nav-item :to="{ name: 'admin-home'}">MAIN MENU</b-nav-item>
                <b-nav-item :to="{ name: 'admin-symbols'}">DESIGN SYMBOLS</b-nav-item>
                <b-nav-item :to="{ name: 'admin-orders'}">PRE-ORDERS</b-nav-item>
            </b-navbar-nav>

            <b-navbar-nav class="ml-auto">
                <b-nav-item :to="{ name: 'admin-home'}">LOGOUT</b-nav-item>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
export default {
    
}
</script>