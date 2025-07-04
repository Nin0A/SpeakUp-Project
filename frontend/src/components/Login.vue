<script setup>
import { ref } from 'vue'
import styles from '../assets/css/Auth.module.css'

const username = ref('')
const password = ref('')
const mockUsers = [{ username: 'test', password: 'test' }]

// Déclare les événements que le composant peut émettre
const emit = defineEmits(['login', 'go-to-register'])

function handleLogin() {
  const user = mockUsers.find(
    (u) => u.username === username.value && u.password === password.value
  )
  if (user) {
    // Émet l'événement login avec le nom d'utilisateur
    emit('login', username.value)
  } else {
    alert('Invalid credentials')
  }
}
</script>

  
<template>
  <div :class="styles['auth-bg']">
    <div :class="styles['auth-card']">
      <div :class="styles['auth-title']">Sign In</div>
      <div :class="styles['auth-label']">Email</div>
      <input
        :class="styles['auth-input']"
        type="text"
        placeholder="Value"
        v-model="username"
      />
      <div :class="styles['auth-label']">Password</div>
      <input
        :class="styles['auth-input']"
        type="password"
        placeholder="Value"
        v-model="password"
      />
      <button :class="styles['auth-btn']" @click="handleLogin">Sign In</button>
      <button :class="styles['auth-switch']" @click="$emit('go-to-register')">
        Create an account
      </button>
      <button :class="styles['auth-link']">Forgot password?</button>
    </div>
  </div>
</template>