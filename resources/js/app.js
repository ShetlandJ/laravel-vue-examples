require('./bootstrap')

import Vue from 'vue'

import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)

import App from './components/App.vue'

new Vue({
  render: h => h(App),
}).$mount('#app')
