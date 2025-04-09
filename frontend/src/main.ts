import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import axios from 'axios'

axios.defaults.withCredentials = true;
axios.defaults.baseURL = '/api';

const app = createApp(App);
app.provide('$axios', axios);
app.mount('#app');