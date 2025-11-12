<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-50 flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md">
      <!-- Card -->
      <div class="card shadow-lg">
        <!-- Header -->
        <div class="text-center mb-8">
          <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center mx-auto mb-4">
            <span class="text-white font-bold text-2xl">E</span>
          </div>
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Emsal</h1>
          <p class="text-gray-600">Hesabınıza giriş yapın</p>
        </div>

        <!-- Form -->
        <form @submit.prevent="login" class="space-y-4">
          <!-- Email -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input 
              v-model="email" 
              type="email"
              placeholder="example@email.com"
              class="input-field"
              required
            />
          </div>

          <!-- Password -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Şifre</label>
            <input 
              v-model="password" 
              type="password" 
              placeholder="••••••••"
              class="input-field"
              required
            />
          </div>

          <!-- Remember Me -->
          <div class="flex items-center">
            <input type="checkbox" id="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded">
            <label for="remember" class="ml-2 text-sm text-gray-700">Beni hatırla</label>
          </div>

          <!-- Submit Button -->
          <button 
            type="submit"
            class="btn-primary w-full"
          >
            Giriş Yap
          </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
          </div>
          <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">ya da</span>
          </div>
        </div>

        <!-- Sign Up Link -->
        <p class="text-center text-gray-600">
          Hesabınız yok mu?
          <router-link to="/register" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors">
            Kayıt olun
          </router-link>
        </p>
      </div>

      <!-- Footer -->
      <p class="text-center text-xs text-gray-500 mt-6">
        Giriş yaparak <a href="#" class="text-blue-600 hover:underline">Şartları Kabul Etmiş</a> olursunuz
      </p>
    </div>
  </div>
</template>

<script>
import api from '../plugins/axios'

export default {
  data() {
    return { 
      email: '', 
      password: '',
      loading: false,
      error: ''
    }
  },
  methods: {
    async login() {
      this.loading = true
      this.error = ''
      try {
        const res = await api.post('/login', {
          email: this.email,
          password: this.password
        })

        localStorage.setItem('token', res.data.token)
        localStorage.setItem('user', JSON.stringify(res.data.user))

        this.$router.push('/dashboard')
      } catch (err) {
        this.error = err.response?.data?.message || 'Giriş başarısız!'
      } finally {
        this.loading = false
      }
    }
  }
}
</script>
