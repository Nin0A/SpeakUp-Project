<template>
  <div>
    <div ref="pub_video"></div>
    <div ref="sub_video"></div>
  </div>
</template>

<script>
import { LocalStream, Client } from 'ion-sdk-js';
import { IonSFUJSONRPCSignal } from 'ion-sdk-js/lib/signal/json-rpc-impl';

let client;
const config = {
  iceServers: [
    {
      urls: "stun:stun.l.google.com:19302",
    },
  ],
};

export default {
  name: 'VideoCallSection',
  data() {
    return {
      client: null
    };
  },
  created() {
    const signal = new IonSFUJSONRPCSignal("ws://localhost:7000/ws");
    this.client = new Client(signal, config);
    signal.onopen = () => this.client.join("test room");

    this.client.ontrack = (track, stream) => {
      const videoContainer = this.$refs.sub_video;
      const videoEl = document.createElement('video');
      console.log("got track: ", track.id, "for stream: ", stream.id);
      if (track.kind === 'video') {
        track.onunmute = () => {
          console.log("unmute");
          videoEl.srcObject = stream;
          videoEl.autoplay = true;
          videoEl.controls = true;
          videoEl.muted = false;
          videoContainer.appendChild(videoEl);
          stream.onremovetrack = () => {
            videoContainer.removeChild(videoEl);
          };
        };
      }
    };
  },
  methods: {
    async startPublish(type) {
      const videoContainer = this.$refs.pub_video;
      const videoEl = document.createElement('video');
      try {
        let stream;
        if (type) {
          stream = await LocalStream.getUserMedia({
            resolution: "vga",
            audio: true,
            codec: "vp8"
          });
        } else {
          stream = await LocalStream.getDisplayMedia({
            resolution: "vga",
            video: true,
            audio: true,
            codec: "vp8"
          });
        }
        videoEl.srcObject = stream;
        videoEl.autoplay = true;
        videoEl.controls = true;
        videoEl.muted = false;
        videoContainer.appendChild(videoEl);
        await this.client.publish(stream);
      } catch (error) {
        console.error("Error publishing stream:", error);
      }
    },
    stopPublish() {
      const videoContainer = this.$refs.pub_video;
      if (videoContainer && videoContainer.firstChild) {
        const videoEl = videoContainer.firstChild;
        if (videoEl.srcObject) {
          const stream = videoEl.srcObject;
          const tracks = stream.getTracks();
          tracks.forEach(track => track.stop());
          videoContainer.removeChild(videoEl);
        }
      }
    }
  }
};
</script>
