import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import App from './components/App.vue'
import WriteExample from './components/WriteExample.vue'
const app = createApp({})
app.component('app', App)
app.mount("#app")
