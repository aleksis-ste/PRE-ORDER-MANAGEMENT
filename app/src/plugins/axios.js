"use strict";

import Vue from "vue";
import axios from "axios";

// Full config:  https://github.com/axios/axios#request-config
// axios.defaults.baseURL = process.env.baseURL || process.env.apiUrl || '';
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
// axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

let config = {
  baseURL: process.env.VUE_APP_API || "http://localhost/api"
  // timeout: 60 * 1000, // Timeout
  // withCredentials: true, // Check cross-site Access-Control
};

const _axios = axios.create(config);

_axios.interceptors.request.use(
  function (config) {
    // Do something before request is sent
    return config;
  },
  function (error) {
    // Do something with request error
    return Promise.reject(error);
  }
);

// Add a response interceptor
_axios.interceptors.response.use(
  function (response) {
    const vm = new Vue()
    const h = vm.$createElement

    // Do something with response data
    if(response.data.message) {
      vm.$bvToast.toast(response.data.message, {
        title: 'Success',
        autoHideDelay: 5000,
        variant: 'success',
        appendToast: false
      })
    }

    return response;
  },
  function (error) {
    const vm = new Vue()
    const h = vm.$createElement

    vm.$bvToast.toast(`${error.response.data.message}`, {
      title: 'Error',
      autoHideDelay: 5000,
      variant: 'danger',
      appendToast: false
    })
    // Do something with response error
    return Promise.reject(error);
  }
);

Plugin.install = function (Vue) {
  Vue.axios = _axios;
  window.axios = _axios;
  Object.defineProperties(Vue.prototype, {
    axios: {
      get() {
        return _axios;
      },
    },
    $axios: {
      get() {
        return _axios;
      },
    },
  });
};

Vue.use(Plugin);

export default Plugin;
