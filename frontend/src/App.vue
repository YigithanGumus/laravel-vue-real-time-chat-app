<script setup>
import { ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import Navbar from './components/Navbar.vue'

const route = useRoute()

// Navbar'ı login ve register sayfalarında gösterme
const showNavbar = computed(() => {
  return !['Login', 'Register'].includes(route.name)
})
</script>

<template>
  <div class="bg-white">
    <Navbar v-if="showNavbar" />
    <main>
      <router-view />
    </main>
  </div>
</template>

<style scoped></style>
