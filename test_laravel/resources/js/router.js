import Vue from 'vue';
import VueRouter from 'vue-router';

import TasksIndex from './views/TasksIndex.vue';
import TaskForm from './views/TaskForm.vue';

Vue.use(VueRouter);

const routes = [
  { path: '/', name: 'tasks.index', component: TasksIndex },
  { path: '/tasks/create', name: 'tasks.create', component: TaskForm },
  { path: '/tasks/:id/edit', name: 'tasks.edit', component: TaskForm, props: true }
];

const router = new VueRouter({
  mode: 'history',
  routes,
});

export default router;
