<script setup>
import { ref } from 'vue'
import styles from '../assets/css/Auth.module.css'

const username = ref('')
const password = ref('')
const confirm = ref('')

const mockUsers = [{ username: 'test', password: 'test' }]

function handleRegister() {
  if (password.value !== confirm.value) {
    alert('Passwords do not match')
    return
  }
  if (mockUsers.find((u) => u.username === username.value)) {
    alert('User already exists')
  } else {
    mockUsers.push({ username: username.value, password: password.value })
    alert('User registered')
    emit('register', username.value)
  }
}

const emit = defineEmits(['register', 'go-to-login'])
</script>

<template>
  <div :class="styles['auth-bg']">
    <div :class="styles['auth-card']">
      <div :class="styles['auth-title']">Create your account</div>
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
      <div :class="styles['auth-label']">Confirm Password</div>
      <input
        :class="styles['auth-input']"
        type="password"
        placeholder="Value"
        v-model="confirm"
      />
      <button :class="styles['auth-btn']" @click="handleRegister">Register</button>
      <button :class="styles['auth-switch']" @click="$emit('go-to-login')">
        Back to Login
      </button>
    </div>
  </div>
</template>