<script setup>
import { ref } from 'vue'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import ChatDashboard from './components/ChatDashboard.vue'
import SettingsDashboard from './components/SettingsDashboard.vue'

const page = ref('login')
const user = ref(null)

function handleLogin(username) {
  user.value = username
  page.value = 'dashboard'
}
</script>

<template>
  <div>
    <Login
      v-if="!user && page === 'login'"
      @login="handleLogin"
      @go-to-register="page = 'register'"
    />
    <Register
      v-else-if="!user && page === 'register'"
      @register="page = 'login'"
      @go-to-login="page = 'login'"
    />
    <SettingsDashboard
      v-else-if="page === 'settings'"
      @back="page = 'dashboard'"
    />
    <ChatDashboard
      v-else
      :username="user"
      @go-to-settings="page = 'settings'"
    />
  </div>
</template>