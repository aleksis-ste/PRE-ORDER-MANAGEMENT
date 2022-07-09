import Vue from "vue";
import VueRouter from "vue-router";
import HomeView from "../views/HomeView.vue";
import auth from './auth';

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/symbol/:symbol",
    name: "products",
    component: function () {
      return import("../views/ProductView.vue");
    },
  },
  {
    path: "/symbol/:symbol/product/:product",
    name: "variations",
    component: function () {
      return import("../views/VariationView.vue");
    },
  },
  {
    path: "/login",
    name: "login",
    component: function () {
      return import("../views/admin/LoginView.vue");
    },
  },
  {
    path: "/admin/home",
    name: "admin-home",
    component: function () {
      return import("../views/admin/HomeView.vue");
    },
    meta: {
      middleware: [auth],
    },
  },
  {
    path: "/admin/symbols",
    name: "admin-symbols",
    component: function () {
      return import("../views/admin/SymbolsView.vue");
    },
    meta: {
      middleware: [auth],
    },
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
