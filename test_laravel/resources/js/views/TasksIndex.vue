<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-white">Tareas</h1>
      <router-link
        :to="{ name: 'tasks.create' }"
        class="px-4 py-2 rounded bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-500"
      >
        Nueva tarea
      </router-link>
    </div>

    <div class="bg-slate-800 shadow rounded overflow-hidden">
      <table class="min-w-full text-sm text-slate-100">
        <thead class="bg-slate-700">
          <tr>
            <th class="px-4 py-2 text-left">ID</th>
            <th class="px-4 py-2 text-left">Título</th>
            <th class="px-4 py-2 text-left">Estado</th>
            <th class="px-4 py-2 text-left">Usuario</th>
            <th class="px-4 py-2 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="task in tasks"
            :key="task.id"
            class="border-t border-slate-700"
          >
            <td class="px-4 py-2">{{ task.id }}</td>
            <td class="px-4 py-2">{{ task.titulo }}</td>
            <td class="px-4 py-2">
              <span
                class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold"
                :class="badgeClass(task.estado)"
              >
                {{ task.estado }}
              </span>
            </td>
            <td class="px-4 py-2">
              {{ task.user && task.user.nombre }}
            </td>
            <td class="px-4 py-2 text-right space-x-2">
              <router-link
                :to="{ name: 'tasks.edit', params: { id: task.id } }"
                class="px-3 py-1 rounded bg-blue-600 text-white text-xs hover:bg-blue-500"
              >
                Editar
              </router-link>
              <button
                @click="destroy(task.id)"
                class="px-3 py-1 rounded bg-red-600 text-white text-xs hover:bg-red-500"
              >
                Eliminar
              </button>
            </td>
          </tr>
          <tr v-if="!loading && tasks.length === 0">
            <td colspan="5" class="px-4 py-4 text-center text-slate-400">
              No hay tareas registradas.
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="flex justify-between items-center" v-if="pagination.total">
      <p class="text-xs text-slate-400">
        Página {{ pagination.current_page }} de {{ pagination.last_page }}
      </p>
      <div class="space-x-2">
        <button
          class="px-3 py-1 rounded bg-slate-700 text-xs text-slate-200 disabled:opacity-40"
          :disabled="!pagination.prev_page_url"
          @click="fetchTasks(pagination.current_page - 1)"
        >
          Anterior
        </button>
        <button
          class="px-3 py-1 rounded bg-slate-700 text-xs text-slate-200 disabled:opacity-40"
          :disabled="!pagination.next_page_url"
          @click="fetchTasks(pagination.current_page + 1)"
        >
          Siguiente
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'TasksIndex',
  data() {
    return {
      tasks: [],
      pagination: {},
      loading: false,
    };
  },
  created() {
    this.fetchTasks();
  },
  methods: {
    async fetchTasks(page = 1) {
      this.loading = true;
      try {
        const { data } = await axios.get(`/api/tasks?page=${page}`);
        this.tasks = data.data || data;
        this.pagination = data.data ? data : {};
      } finally {
        this.loading = false;
      }
    },
    async destroy(id) {
      if (!confirm('¿Eliminar tarea?')) return;
      await axios.delete(`/api/tasks/${id}`);
      this.fetchTasks(this.pagination.current_page || 1);
    },
    badgeClass(estado) {
      if (estado === 'pendiente') {
        return 'bg-amber-500/20 text-amber-300';
      }
      if (estado === 'en_progreso') {
        return 'bg-sky-500/20 text-sky-300';
      }
      if (estado === 'completada') {
        return 'bg-emerald-500/20 text-emerald-300';
      }
      return 'bg-slate-500/20 text-slate-300';
    },
  },
};
</script>
