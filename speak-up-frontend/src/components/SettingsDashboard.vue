<script setup>
import { ref } from 'vue'
import styles from '../scss/SettingsDashboard.module.scss'
import defaultProfilePic from '../assets/profile.png'

const tab = ref('profile')
const profilePic = ref(null)
const username = ref('Emma')
const description = ref('Hello! I love SpeakUp.')

function handlePicChange(e) {
  if (e.target.files && e.target.files[0]) {
    profilePic.value = URL.createObjectURL(e.target.files[0])
  }
}
</script>
  
<template>
  <div :class="styles['settings-root']">
    <div :class="styles['settings-sidebar']">
      <div :class="styles['settings-sidebar-header']">
        <div :class="styles['settings-logo']">
          <span :class="styles['settings-logo-text']">SpeakUp</span>
        </div>
      </div>
      <div :class="styles['settings-menu']">
        <div
          :class="[
            styles['settings-menu-item'],
            tab === 'profile' ? styles['settings-menu-item--selected'] : ''
          ]"
          @click="tab = 'profile'"
        >
          Profile
        </div>
        <div
          :class="[
            styles['settings-menu-item'],
            tab === 'voice' ? styles['settings-menu-item--selected'] : ''
          ]"
          @click="tab = 'voice'"
        >
          Voice and Video
        </div>
      </div>
      <button :class="styles['settings-back-btn']" @click="$emit('back')">
        ← Retour au chat
      </button>
    </div>
    <div :class="styles['settings-main']">
      <template v-if="tab === 'profile'">
        <h2 :class="styles['settings-title']">Profile</h2>
        <div :class="styles['profile-section']">
          <div :class="styles['profile-pic-block']">
            <img
              :src="profilePic || defaultProfilePic"
              alt="Profile"
              :class="styles['profile-pic']"
            />
            <label :class="styles['profile-pic-upload']">
              Change photo
              <input
                type="file"
                accept="image/*"
                style="display: none"
                @change="handlePicChange"
              />
            </label>
          </div>
          <div :class="styles['profile-fields']">
            <label>Username</label>
            <input
              :class="styles['profile-input']"
              v-model="username"
            />
            <label>Description</label>
            <textarea
              :class="styles['profile-textarea']"
              v-model="description"
              rows="3"
            />
          </div>
        </div>
      </template>
      <template v-else>
        <h2 :class="styles['settings-title']">Voice & Video</h2>
        <div :class="styles['settings-row']">
          <div :class="styles['settings-col']">
            <label>Input device</label>
            <select>
              <option>Value</option>
            </select>
          </div>
          <div :class="styles['settings-col']">
            <label>Output device</label>
            <select>
              <option>Value</option>
            </select>
          </div>
        </div>
        <div :class="styles['settings-section']">
          <label>Volume</label>
          <input type="range" min="0" max="100" :class="styles['settings-slider']" />
        </div>
        <div :class="styles['settings-section']">
          <label>Camera</label>
          <select>
            <option>Value</option>
          </select>
        </div>
      </template>
    </div>
  </div>
</template>