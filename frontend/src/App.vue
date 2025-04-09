<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { inject } from 'vue';

const axios = inject('$axios');

type Task = {
  id: number;
  title: string;
  done: boolean;
};

const tasks = ref<Task[]>([]);

const updateTaskStatus = async (task: Task) => {
    await axios.post(`/tasks/${task.id}`, { done: task.done });
};

onMounted(async () => {
  const res = await axios.get<Task[]>('/tasks');
  tasks.value = res.data.map((task) => ({ ...task }));
});
</script>

<template>
  <div>
    <h2>Список задач</h2>
    <ul>
      <li v-for="task in tasks" :key="task.id">
        <label>
          <input
            type="checkbox"
            v-model="task.done"
            @change="updateTaskStatus(task)"
          />
          <span :style="{ textDecoration: task.done ? 'line-through' : 'none' }">
            {{ task.title }}
          </span>
        </label>
      </li>
    </ul>
  </div>
</template>

<style scoped>
ul {
  list-style: none;
  padding: 0;
}
li {
  margin-bottom: 8px;
}
</style>
