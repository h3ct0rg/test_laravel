<template>
  <div class="max-w-xl space-y-4">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-white">
        {{ isEdit ? 'Editar tarea' : 'Nueva tarea' }}
      </h1>
      <router-link
        :to="{ name: 'tasks.index' }"
        class="text-xs text-slate-300 hover:text-white"
      >
        ← Volver
      </router-link>
    </div>

    <form class="space-y-4" @submit.prevent="submit">
      <div>
        <label class="block text-sm font-medium text-slate-200 mb-1">
          Título
        </label>
        <input
          v-model="form.titulo"
          type="text"
          class="w-full rounded border border-slate-600 bg-slate-800 text-slate-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
        />
        <p v-if="errors.titulo" class="mt-1 text-xs text-red-400">
          {{ errors.titulo[0] }}
        </p>
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-200 mb-1">
          Descripción
        </label>
        <textarea
          v-model="form.descripcion"
          rows="3"
          class="w-full rounded border border-slate-600 bg-slate-800 text-slate-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
        ></textarea>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-slate-200 mb-1">
            Estado
          </label>
          <select
            v-model="form.estado"
            class="w-full rounded border border-slate-600 bg-slate-800 text-slate-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
          >
            <option value="pendiente">Pendiente</option>
            <option value="en_progreso">En progreso</option>
            <option value="completada">Completada</option>
          </select>
          <p v-if="errors.estado" class="mt-1 text-xs text-red-400">
            {{ errors.estado[0] }}
          </p>
        </div>

        <div>
          <label class="block text-sm font-medium text-slate-200 mb-1">
            Usuario
          </label>
          <select
            v-model="form.user_id"
            class="w-full rounded border border-slate-600 bg-slate-800 text-slate-100 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500"
          >
            <option :value="null" disabled>Seleccione un usuario</option>
            <option v-for="user in users" :key="user.id" :value="user.id">
              {{ user.nombre }}
            </option>
          </select>
          <p v-if="errors.user_id" class="mt-1 text-xs text-red-400">
            {{ errors.user_id[0] }}
          </p>
        </div>
      </div>

      <div class="flex justify-end space-x-2">
        <router-link
          :to="{ name: 'tasks.index' }"
          class="px-4 py-2 rounded bg-slate-700 text-sm text-slate-200 hover:bg-slate-600"
        >
          Cancelar
        </router-link>
        <button
          type="submit"
          class="px-4 py-2 rounded bg-emerald-600 text-sm font-semibold text-white hover:bg-emerald-500 disabled:opacity-50"
          :disabled="submitting"
        >
          {{ submitting ? 'Guardando...' : (isEdit ? 'Actualizar' : 'Crear') }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'TaskForm',
  props: ['id'],
  data() {
    return {
      form: {
        titulo: '',
        descripcion: '',
        estado: 'pendiente',
        user_id: null,
      },
      users: [],
      errors: {},
      submitting: false,
    };
  },
  computed: {
    isEdit() {
      return !!this.id;
    },
  },
  async created() {
    await this.fetchUsers();
    if (this.isEdit) {
      await this.fetchTask();
    }
  },
  methods: {
    async fetchUsers() {
      const { data } = await axios.get('/api/users');
      this.users = data;
    },
    async fetchTask() {
    const response = await axios.get(`/api/tasks/${this.id}`);
    const task = response.data.data; // aquí está la tarea

    this.form = {
        titulo: task.titulo,
        descripcion: task.descripcion,
        estado: task.estado,
        user_id: task.user.id,
    };
    },
    async submit() {
      this.errors = {};
      this.submitting = true;
      try {
        if (this.isEdit) {
          await axios.put(`/api/tasks/${this.id}`, this.form);
        } else {
          await axios.post('/api/tasks', this.form);
        }
        this.$router.push({ name: 'tasks.index' });
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors || {};
        } else {
          console.error(error);
        }
      } finally {
        this.submitting = false;
      }
    },
  },
};
</script>
