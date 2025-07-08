<script setup>
import { ref, computed, onMounted } from 'vue';
import styles from '../assets/css/ChatDashboard.module.css';
import VideoCallSection from './VideoCallSection.vue';
import Header from './Header.vue';

const props = defineProps({
  username: String
});

const mockChannels = [
  { name: 'family-group' },
  { name: 'friends-group' },
  { name: 'private' },
  { name: 'students-project' },
  { name: 'work' }
];

const mockUsers = [
  { name: 'Emma', online: true },
  { name: 'Pierre', online: true },
  { name: 'Martin', online: true },
  { name: 'Jean', online: false }
];

const mockMessages = [
  { sender: 'Emma', text: 'Hello everyone!', date: '12/03/2025 15:28' },
  { sender: 'Martin', text: "Hi @Emma what's up? 😏", date: '12/03/2025 15:28' },
  { sender: 'Emma', text: "Let's do a call!", date: '12/03/2025 15:34' }
];

const selectedChannel = ref('work');
const message = ref('');
const messages = ref([...mockMessages]);
const videoCallSection = ref(null);
const hasVideo = ref(false);

const onlineUsers = computed(() => mockUsers.filter(u => u.online));
const offlineUsers = computed(() => mockUsers.filter(u => !u.online));

function sendMessage() {
  if (message.value.trim() !== '') {
    messages.value.push({
      sender: props.username,
      text: message.value,
      date: new Date().toLocaleString()
    });
    message.value = '';
  }
}

function startPublish(type) {
  if (videoCallSection.value) {
    videoCallSection.value.startPublish(type);
    hasVideo.value = true;
  }
}

function stopPublish() {
  if (videoCallSection.value) {
    videoCallSection.value.stopPublish();
    hasVideo.value = false;
  }
}

</script>

<template>
  <div :class="styles['dashboard-root']">

    <!-- Sidebar -->
    <div :class="styles['dashboard-sidebar']">
      <div :class="styles['dashboard-sidebar-title']">SpeakUp</div>
      <div :class="styles['dashboard-channels']">
        <div
          v-for="c in mockChannels"
          :key="c.name"
          :class="[
            styles['dashboard-channel'],
            selectedChannel === c.name ? styles['dashboard-channel--selected'] : ''
          ]"
          @click="selectedChannel = c.name"
        >
          #{{ c.name }}
        </div>
      </div>
    </div>
    <div :class="styles['communication-area']">
        <div :class="styles['dashboard-header']">
          <div :class="styles['dashboard-main-title']"># {{ selectedChannel }}</div>
          <Header v-if="!hasVideo" @start-publish="startPublish" @stop-publish="stopPublish" />
        </div>

        <!-- Videocall area -->
        <div :class="styles['container-video-header']">
            <div :class="styles['container-videocall']">
                <VideoCallSection ref="videoCallSection" />
            </div>
            <Header v-if="hasVideo" @start-publish="startPublish" @stop-publish="stopPublish" />
        </div>
        <!-- Main chat area -->
        <div :class="styles['dashboard-main']">
        <div :class="styles['dashboard-messages']">
            <div
                v-for="(msg, idx) in messages"
                :key="idx"
                :class="[
                    styles['dashboard-message'],
                    msg.sender === username ? styles['dashboard-message--me'] : ''
                ]"
                >
                <strong>{{ msg.sender }}</strong>
                <span :class="styles['dashboard-message-meta']">{{ msg.date }}</span>
                <div>{{ msg.text }}</div>
                </div>
            </div>
            <div :class="styles['dashboard-input-row']">
                <input
                :class="styles['dashboard-input']"
                type="text"
                placeholder="Envoyer un message"
                v-model="message"
                @keydown.enter="sendMessage"
                />
                <button :class="styles['dashboard-send-btn']" @click="sendMessage">
                Envoyer
                </button>
            </div>
        </div>
    </div>

    <!-- Users list -->
    <div :class="styles['dashboard-users']">
      <div :class="styles['dashboard-users-title']">
        En Ligne - {{ onlineUsers.length }}
      </div>
      <div
        v-for="u in onlineUsers"
        :key="u.name"
        :class="styles['dashboard-user']"
      >
        <span :class="styles['dashboard-user-dot'] + ' ' + styles['dashboard-user-dot--online']"></span>
        {{ u.name }}
      </div>
      <div :class="styles['dashboard-users-offline-title']">
        Hors Ligne - {{ offlineUsers.length }}
      </div>
      <div
        v-for="u in offlineUsers"
        :key="u.name"
        :class="styles['dashboard-user']"
        style="color: #bbb"
      >
        <span :class="styles['dashboard-user-dot'] + ' ' + styles['dashboard-user-dot--offline']"></span>
        {{ u.name }}
      </div>
      <button
        :class="styles['dashboard-settings-btn']"
        @click="$emit('go-to-settings')"
      >
        ⚙️ Paramètres
      </button>
    </div>
  </div>
</template>
