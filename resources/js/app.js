require('./bootstrap')

import Vue from 'vue'
import router from './router.js';


import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.use(BootstrapVue)

import App from './components/App.vue'

new Vue({
  render: h => h(App),
  router,
}).$mount('#app')
