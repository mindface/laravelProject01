import './bootstrap';
import { createApp } from 'vue';

import Todo from './todo/App.vue';

const app = createApp(Todo);

app.mount('#todo');
