<template>
  <nav class="bg-white shadow-md border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <router-link to="/" class="flex items-center space-x-2">
          <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
            <span class="text-white font-bold text-lg">E</span>
          </div>
          <span class="text-xl font-bold text-gray-900">Emsal</span>
        </router-link>

        <!-- Nav Links -->
        <div class="hidden md:flex items-center space-x-8">
          <router-link 
            to="/dashboard" 
            class="text-gray-700 hover:text-blue-600 transition-colors font-medium"
          >
            Dashboard
          </router-link>
          <router-link 
            to="/messages" 
            class="text-gray-700 hover:text-blue-600 transition-colors font-medium"
          >
            Mesajlar
          </router-link>
        </div>

        <!-- User Menu -->
        <div class="flex items-center space-x-4">
          <div v-if="user" class="hidden sm:flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
              <span class="text-white font-bold">{{ user.name?.charAt(0) }}</span>
            </div>
            <div class="hidden md:block">
              <p class="text-sm font-medium text-gray-900">{{ user.name }}</p>
              <p class="text-xs text-gray-500">{{ user.email }}</p>
            </div>
          </div>
          <button 
            v-if="user"
            @click="logout" 
            class="btn-secondary text-sm"
          >
            Çıkış Yap
          </button>
          <div v-else class="space-x-3">
            <router-link to="/login" class="btn-secondary text-sm">
              Giriş Yap
            </router-link>
            <router-link to="/register" class="btn-primary text-sm">
              Kayıt Ol
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import api from '../plugins/axios'

export default {
  data() {
    return {
      user: null
    }
  },
  created() {
    this.user = JSON.parse(localStorage.getItem('user'))
  },
  methods: {
    async logout() {
      try {
        await api.post('/logout')
      } catch (err) {
        console.log('Logout hatası:', err)
      } finally {
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        this.$router.push('/login')
        this.user = null
      }
    }
  }
}
</script>

<style scoped>
router-link.active {
  @apply text-blue-600;
}
</style>
