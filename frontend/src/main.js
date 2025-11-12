import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import echo from './echo'
import './styles/globals.css'

const app = createApp(App)
app.use(router)
app.config.globalProperties.$echo = echo
app.mount('#app')
