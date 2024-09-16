import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import vuetify from '@/plugins/vuetify'
import Toastification from '@/plugins/toastification'

const app = createApp(App)

app.use(createPinia())
app.use(vuetify)
app.use(router)
app.use(Toastification);

app.mount('#app')
