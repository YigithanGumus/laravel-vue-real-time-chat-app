import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Dashboard from '../views/Dashboard.vue'
import Messages from '../views/Messages.vue'

const routes = [
  { path: '/login', name: 'Login', component: Login },
  { path: '/register', name: 'Register', component: Register },
  { path: '/dashboard', name: 'Dashboard', component: Dashboard, meta: { requiresAuth: true } },
  { path: '/messages', name: 'Messages', component: Messages, meta: { requiresAuth: true } },
  { path: '/', redirect: '/dashboard' }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// Route guard
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')

  if (to.meta.requiresAuth && !token) {
    // Token yok → giriş sayfasına yönlendir
    next('/login')
  } else if ((to.path === '/login' || to.path === '/register') && token) {
    // Giriş yapmışsa login/register sayfasına giremesin
    next('/dashboard')
  } else {
    next()
  }
})

export default router
