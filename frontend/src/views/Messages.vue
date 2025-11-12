<template>
  <div class="chat-page flex h-[calc(100vh-64px)]">
    <!-- Sidebar - Users List -->
    <div class="sidebar w-80 bg-white border-r border-gray-200 flex flex-col">
      <!-- Header -->
      <div class="p-4 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-900">Mesajlar</h2>
        <div class="mt-4 relative">
          <input 
            type="text" 
            placeholder="Kullanıcı ara..."
            class="input-field text-sm"
          />
          <svg class="absolute right-3 top-3 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
      </div>

      <!-- Users List -->
      <div class="flex-1 overflow-y-auto">
        <div v-if="users.length === 0" class="p-4 text-center text-gray-500">
          <p>Henüz kullanıcı yok</p>
        </div>
        <ul v-else class="list-none p-0 m-0">
          <li 
            v-for="u in users" 
            :key="u.id" 
            @click="selectUser(u)"
            :class="{ 
              'bg-blue-50 border-l-4 border-blue-600': receiver && receiver.id === u.id,
              'hover:bg-gray-50': !(receiver && receiver.id === u.id)
            }"
            class="p-4 cursor-pointer border-l-4 border-transparent transition-all"
          >
            <div class="flex items-center space-x-3">
              <!-- Avatar -->
              <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold">{{ u.name?.charAt(0) }}</span>
              </div>
              
              <!-- User Info -->
              <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                  <p class="font-medium text-gray-900">{{ u.name }}</p>
                  <span v-if="u.unreadCount" class="badge bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                    {{ u.unreadCount }}
                  </span>
                </div>
                <p v-if="u.lastMessage" class="text-sm text-gray-600 truncate">{{ u.lastMessage }}</p>
                <p v-else class="text-sm text-gray-400">Henüz mesaj yok</p>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Chat Area -->
    <div class="flex-1 bg-gray-50 flex flex-col">
      <!-- Chat Header -->
      <div v-if="receiver" class="bg-white border-b border-gray-200 p-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
            <span class="text-white font-bold text-sm">{{ receiver.name?.charAt(0) }}</span>
          </div>
          <div>
            <h3 class="font-semibold text-gray-900">{{ receiver.name }}</h3>
            <p class="text-xs text-gray-500">Çevrimiçi</p>
          </div>
        </div>
        <div class="flex space-x-2">
          <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
          </button>
          <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
          </button>
          <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Messages -->
      <div v-if="receiver" class="flex-1 overflow-y-auto p-6 space-y-4">
        <div v-if="messages.length === 0" class="flex items-center justify-center h-full text-gray-500">
          <p>Henüz mesaj yok. Konuşmayı başlatın!</p>
        </div>
        <div v-for="m in messages" :key="m.id" :class="m.sender_id === user.id ? 'flex justify-end' : 'flex justify-start'">
          <div 
            :class="{
              'bg-blue-600 text-white rounded-tl-lg': m.sender_id === user.id,
              'bg-gray-200 text-gray-900 rounded-tr-lg': m.sender_id !== user.id
            }"
            class="rounded-lg px-4 py-2 max-w-xs"
          >
            <p class="font-medium text-sm mb-1">{{ m.sender.name }}</p>
            <p class="text-sm">{{ m.content }}</p>
            <p class="text-xs opacity-75 mt-1">{{ formatTime(m.created_at) }}</p>
          </div>
        </div>
      </div>

      <!-- Chat Placeholder -->
      <div v-else class="flex-1 flex items-center justify-center bg-gray-50">
        <div class="text-center">
          <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
          </svg>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Sohbet Başlayın</h3>
          <p class="text-gray-500">Konuşmaya başlamak için soldan bir kişi seçin</p>
        </div>
      </div>

      <!-- Input Area -->
      <div v-if="receiver" class="bg-white border-t border-gray-200 p-4">
        <div class="flex items-center space-x-3">
          <button class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
          </button>
          <input 
            v-model="newMessage" 
            @keyup.enter="sendMessage"
            type="text"
            placeholder="Mesaj yaz..."
            class="input-field flex-1"
          />
          <button 
            @click="sendMessage"
            :disabled="newMessage.length < 1"
            class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors"
          >
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import api from '../plugins/axios'
import echo from '../echo'

export default {
  data() {
    return {
      users: [],
      user: JSON.parse(localStorage.getItem('user')),
      receiver: null,
      messages: [],
      newMessage: ''
    }
  },
  async created() {
    const res = await api.get('/users')
    this.users = res.data

    // 🔹 Tüm yeni mesaj yayınlarını dinle
    echo.channel('messages')
      .listen('.MessageSent', (event) => {
        const msg = event.message
        
        // Eğer bu mesaj aktif konuşmadaki 2 kişiden birine aitse:
        if (
          this.receiver &&
          (
            (msg.sender_id === this.user.id && msg.receiver_id === this.receiver.id) ||
            (msg.sender_id === this.receiver.id && msg.receiver_id === this.user.id)
          )
        ) {
          this.messages.push(msg)
        }
        
        // Diğer kişinin mesaj alması durumunda, listede o kişiye mesaj geldiğini göster
        if (msg.receiver_id === this.user.id) {
          const senderUser = this.users.find(u => u.id === msg.sender_id)
          if (senderUser && !senderUser.unreadCount) {
            senderUser.unreadCount = 0
          }
          if (senderUser) {
            senderUser.unreadCount++
            senderUser.lastMessage = msg.content
          }
        }
      })
  },
  methods: {
    async selectUser(u) {
      this.receiver = u
      const res = await api.get(`/messages?receiver_id=${u.id}`)
      this.messages = res.data
      
      // Yeni mesaj sayacını sıfırla
      u.unreadCount = 0
    },
    async sendMessage() {
      if (!this.receiver || this.newMessage.length < 1) return
      const res = await api.post('/messages', {
        receiver_id: this.receiver.id,
        content: this.newMessage
      })
      this.messages.push(res.data)
      this.newMessage = ''
    },
    formatTime(timestamp) {
      const date = new Date(timestamp)
      return date.toLocaleTimeString('tr-TR', { hour: '2-digit', minute: '2-digit' })
    }
  }
}
</script>
