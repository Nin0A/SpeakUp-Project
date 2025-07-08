<template>
  <header class="flex h-16 justify-center items-center text-xl">
    <div class="flex gap-4">
      <button id="bnt_pubcam" class="bg-blue-500 px-4 py-2 text-white rounded-lg" @click="$emit('start-publish', true)">
        Publish Camera
      </button>
      <button id="bnt_pubscreen" class="bg-green-500 px-4 py-2 text-white rounded-lg" @click="$emit('start-publish', false)">
        Publish Screen
      </button>
      <button id="bnt_stop" class="bg-red-500 px-4 py-2 text-white rounded-lg" @click="$emit('stop-publish')">
        Stop Sharing
      </button>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header"
}
</script>

<style>
.flex {
  display: flex;
}

.h-16 {
  height: 4rem;
}

.justify-center {
  justify-content: center;
}

.items-center {
  align-items: center;
}

.gap-4 {
  gap: 1rem;
}

.bg-blue-500 {
  background-color: #3b82f6;
}

.bg-green-500 {
  background-color: #10b981;
}

.bg-red-500 {
  background-color: #ef4444;
}

.px-4 {
  padding-left: 1rem;
  padding-right: 1rem;
}

.py-2 {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.text-white {
  color: white;
}

.rounded-lg {
  border-radius: 0.5rem;
}
</style>
