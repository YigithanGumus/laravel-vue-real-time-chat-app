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
          <p class="text-gray-600">Yeni bir hesap oluşturun</p>
        </div>

        <!-- Form -->
        <form @submit.prevent="register" class="space-y-4">
          <!-- Full Name -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Ad Soyad</label>
            <input 
              v-model="name" 
              type="text"
              placeholder="Adınızı ve soyadınızı girin"
              class="input-field"
              required
            />
          </div>

          <!-- Username -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kullanıcı Adı</label>
            <input 
              v-model="username" 
              type="text"
              placeholder="Kullanıcı adınızı seçin"
              class="input-field"
              required
            />
          </div>

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
              placeholder="En az 8 karakter"
              class="input-field"
              required
            />
            <p class="text-xs text-gray-500 mt-1">Güvenlik için en az 8 karakter kullanın</p>
          </div>

          <!-- Terms -->
          <div class="flex items-center">
            <input type="checkbox" id="terms" class="w-4 h-4 text-blue-600 border-gray-300 rounded" required>
            <label for="terms" class="ml-2 text-sm text-gray-700">
              <a href="#" class="text-blue-600 hover:underline">Şartları Kabul Etmekle</a> Anlaştım
            </label>
          </div>

          <!-- Submit Button -->
          <button 
            type="submit"
            class="btn-primary w-full"
          >
            Kayıt Ol
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

        <!-- Sign In Link -->
        <p class="text-center text-gray-600">
          Zaten hesabınız var mı?
          <router-link to="/login" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors">
            Giriş yapın
          </router-link>
        </p>
      </div>

      <!-- Footer -->
      <p class="text-center text-xs text-gray-500 mt-6">
        © 2025 Emsal. Tüm hakları saklıdır.
      </p>
    </div>
  </div>
</template>

<script>
import api from '../plugins/axios'


export default {
  data() {
    return { 
      name: '', 
      username: '', 
      email: '', 
      password: '',
      loading: false,
      error: ''
    }
  },
  methods: {
    async register() {
      this.loading = true
      this.error = ''
      try {
        const res = await api.post('/register', {
          name: this.name,
          username: this.username,
          email: this.email,
          password: this.password
        })

        // Backend direkt token dönmüyor, login olmamız gerekebilir.
        alert('Kayıt başarılı! Şimdi giriş yapabilirsin.')
        this.$router.push('/login')
      } catch (err) {
        this.error = err.response?.data?.message || 'Kayıt başarısız!'
      } finally {
        this.loading = false
      }
    }
  }
}
</script>
