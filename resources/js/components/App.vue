<!-- <template>
  <div id="app">
    <Home></Home>
  </div>
</template>

<script>
import Home from './Home.vue'

export default {
  name: 'App',
  components: {
    Home
  }
}
</script> -->

<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>
