<template>
  <div class="space-y-4">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-[#0D124F]">Tasks</h1>
      <router-link
        :to="{ name: 'tasks.create' }"
        class="px-4 py-2 rounded bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-500"
      >
        Nueva tarea
      </router-link>
    </div>

    <div class="bg-white shadow rounded overflow-hidden shadow-md">
      <table class="min-w-full text-sm">
        <thead class="bg-[#0D124F] text-white">
          <tr>
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
            class="border-t border-slate-700 hover:bg-gray-200 text-[#0D124F]"
          >
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

    <div class="flex justify-between items-center mt-4" v-if="pagination.total">
      <p class="text-xs text-[#0D124F]">
        Página {{ pagination.current_page }} de {{ pagination.last_page }}
      </p>
      <div class="space-x-2">
        <button
          class="px-3 py-1 rounded bg-slate-200 text-xs text-[#0D124F] disabled:opacity-40"
          :disabled="!pagination.prev_page_url"
          @click="fetchTasks(pagination.current_page - 1)"
        >
          Anterior
        </button>
        <button
          class="px-3 py-1 rounded bg-slate-200 text-xs text-[#0D124F] disabled:opacity-40"
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
        pagination: {
        current_page: 1,
        last_page: 1,
        prev_page_url: null,
        next_page_url: null,
        total: 0,
        },
        loading: false,
    };
    },
  created() {
    this.fetchTasks();
  },
  methods: {
    async fetchTasks(page = 1) { //despliega tareas
        this.loading = true;
        try {
            const { data } = await axios.get(`/api/tasks?page=${page}`);

            // Para Resource::collection, las tareas vienen en data.data
            this.tasks = data.data;

            // La paginación viene en data.meta y data.links
            this.pagination = {
            current_page: data.meta.current_page,
            last_page: data.meta.last_page,
            prev_page_url: data.links.prev,
            next_page_url: data.links.next,
            total: data.meta.total,
            };
        } finally {
            this.loading = false;
        }
    },
    async destroy(id) {
      if (!confirm('¿Eliminar tarea?')) return;
      await axios.delete(`/api/tasks/${id}`);
      this.fetchTasks(this.pagination.current_page || 1); //vuelve a paginar
    },
    badgeClass(estado) { //clases para cada tipo de estado
      if (estado === 'pendiente') {
        return 'bg-orange-500 text-white';
      }
      if (estado === 'en_progreso') {
        return 'bg-sky-500 text-white';
      }
      if (estado === 'completada') {
        return 'bg-emerald-500 text-white';
      }
      return 'bg-slate-500/20 text-slate-300';
    },
  },
};
</script>
