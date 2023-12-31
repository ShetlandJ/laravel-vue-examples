import Vue from 'vue';
import VueRouter from 'vue-router';
import HomePage from './components/Home.vue';
import AddPlayer from './components/AddPlayer.vue';
import Players from './components/Players.vue'


Vue.use(VueRouter);

const routes = [
    { path: '/', component: HomePage },
    { path: '/add-player', component: AddPlayer },
    { path: '/players', component: Players }
];

const router = new VueRouter({
    routes
});

export default router;
