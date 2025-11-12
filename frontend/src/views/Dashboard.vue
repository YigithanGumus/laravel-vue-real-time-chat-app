<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-4xl font-bold mb-2">Hoş geldin, {{ user?.name }}!</h1>
            <p class="text-blue-100">Emsal platformundan yararlanmaya başlayın</p>
          </div>
          <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
            <span class="text-3xl font-bold">{{ user?.name?.charAt(0) }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <!-- Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <!-- Stat Card 1 -->
        <div class="card hover:shadow-lg transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-600 text-sm font-medium">Toplam Mesajlar</p>
              <p class="text-3xl font-bold text-gray-900 mt-2">24</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
          </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="card hover:shadow-lg transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-600 text-sm font-medium">Aktif Konuşmalar</p>
              <p class="text-3xl font-bold text-gray-900 mt-2">8</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zM5 20a6 6 0 0112 0v2H5v-2z"></path>
              </svg>
            </div>
          </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="card hover:shadow-lg transition-shadow">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-gray-600 text-sm font-medium">Okunmayan Mesajlar</p>
              <p class="text-3xl font-bold text-gray-900 mt-2">3</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- User Info Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="card lg:col-span-2">
          <h2 class="text-xl font-bold text-gray-900 mb-6">Profil Bilgilerim</h2>
          <div class="space-y-4">
            <div class="flex justify-between items-center py-4 border-b border-gray-200">
              <span class="text-gray-600 font-medium">Ad Soyad</span>
              <span class="text-gray-900 font-semibold">{{ user?.name }}</span>
            </div>
            <div class="flex justify-between items-center py-4 border-b border-gray-200">
              <span class="text-gray-600 font-medium">Email</span>
              <span class="text-gray-900 font-semibold">{{ user?.email }}</span>
            </div>
            <div class="flex justify-between items-center py-4 border-b border-gray-200">
              <span class="text-gray-600 font-medium">Kullanıcı Adı</span>
              <span class="text-gray-900 font-semibold">@{{ user?.username }}</span>
            </div>
            <div class="flex justify-between items-center py-4">
              <span class="text-gray-600 font-medium">Hesap Durumu</span>
              <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">Aktif</span>
            </div>
          </div>
          <button class="btn-primary w-full mt-6">Profili Düzenle</button>
        </div>

        <!-- Quick Actions -->
        <div class="card">
          <h2 class="text-xl font-bold text-gray-900 mb-6">Hızlı İşlemler</h2>
          <div class="space-y-3">
            <router-link 
              to="/messages" 
              class="flex items-center space-x-3 p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors cursor-pointer"
            >
              <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div>
                <p class="font-medium text-gray-900">Mesajlara Git</p>
                <p class="text-xs text-gray-600">Sohbetlerinize erişin</p>
              </div>
            </router-link>

            <button class="flex items-center space-x-3 p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors w-full">
              <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
              </div>
              <div class="text-left">
                <p class="font-medium text-gray-900">Yeni Konuşma</p>
                <p class="text-xs text-gray-600">Biriyle sohbet başlayın</p>
              </div>
            </button>

            <button class="flex items-center space-x-3 p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors w-full">
              <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
              </div>
              <div class="text-left">
                <p class="font-medium text-gray-900">Ayarlar</p>
                <p class="text-xs text-gray-600">Tercihleri yönetin</p>
              </div>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../plugins/axios'

export default {
  data() {
    return { 
      user: null,
      loading: true
    }
  },
  async created() {
    try {
      const res = await api.get('/user')
      this.user = res.data
    } catch (err) {
      console.log('Yetki hatası:', err)
      this.$router.push('/login')
    } finally {
      this.loading = false
    }
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
      }
    }
  }
}
</script>
