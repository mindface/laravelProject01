import './bootstrap';
import { createApp } from 'vue';

import Task from './task/App.vue';

const app = createApp(Task);

app.mount('#task');
