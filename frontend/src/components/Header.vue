<template>
  <header class="flex h-16 justify-center items-center text-xl bg-black text-white">
    <div class="absolute top-2 right-5">
      <button id="bnt_pubcam" class="bg-blue-500 px-4 py-2 text-white rounded-lg mr-5" @click="$emit('start-publish', true)">Publish Camera</button>
      <button id="bnt_pubscreen" class="bg-green-500 px-4 py-2 text-white rounded-lg mr-5" @click="$emit('start-publish', false)">Publish Screen</button>
      <button id="bnt_stop" class="bg-red-500 px-4 py-2 text-white rounded-lg" @click="$emit('stop-publish')">Stop Sharing</button>
    </div>
  </header>
</template>

<script>
export default {
  name: "Header"
}
</script>
