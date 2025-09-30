import { createRouter, createWebHistory } from 'vue-router';
import CardsView from '../views/CardsView.vue';

const routes = [
  { path: '/', name: 'cards', component: CardsView }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
