import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
  // Por ahora vacío, luego agregamos vistas reales
];

const router = new VueRouter({
  mode: 'history',
  routes,
});

export default router;
