<template>
    <div class="playback-container">
      <div class="waves-animation-container">
        <div 
          v-for="(line, index) in getLines" 
          :key="index" 
          class="wave-line" 
          :dest-height="`${line.dest_height}`"
          :style="{ transform: `rotate(${line.angle}deg)  `, height: `${line.dest_height}`, 'animation-duration': `${line.animation_duration}` }"
          >
        </div> 
        <div 
          class="waves-middle"
          >
        </div> 
      </div>
      <div class="playback-actions-cnt"> 
        <span class="playback-btn prev-btn fa-solid fa-caret-left" ></span>
        <span class="playback-btn playpause-btn fa-solid" :class="{'fa-play': getPlaybackState === 'play', 'fa-pause': getPlaybackState === 'pause'}" @click="togglePlayback"></span>
        <span class="playback-btn next-btn fa-solid fa-caret-right" ></span> 
      </div>
    </div>
</template>



<script> 


import { mapGetters, mapActions } from 'vuex';

export default {
  data() {
    return {
      lines: [],
      playbackState: 'play', // Initial state is 'play'
    };
  },
  computed: {
    ...mapGetters(['getPlaybackState']),
    ...mapGetters(['getLines']),
  },
  methods: {
    ...mapActions(['togglePlayback']), 
  },
  created() { 
    this.$store.dispatch('generateLines');
    this.togglePlayback();
  },
};
</script>

<style scoped> 
/* Add your component-specific styles here */
.playback-container {
    position: fixed;
    bottom: 50px;
    left: 50%;
    transform: translate(-50%, 0%);
    width: 100px;
    height: 100px;
    border-radius: 100px; 
    z-index: 5;
    
    /*background-color: var(--col-primary); */
}
 
.waves-animation-container {
  position: relative;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  top: 50%; left: 50%;
  transform: translate(-50%, -50%);
  overflow: hidden;
  /*background-color: var(--col-primary); */
}

.wave-line {
  position: absolute;
  top: 50%;
  left: 50%;
  transform-origin: top center;
  background: linear-gradient(to bottom, green 60%, var(--col-accent) 100%);
  border-radius: 10px; 
  width: .0635em; /* Adjust the thickness of the lines */
}

.wave-line {  
  animation: waveAnimation 2s infinite alternate ease-out;
  animation-duration: 0s;
}

@keyframes waveAnimation {
  to { 
    height: 50%;
  }
}


.waves-middle {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 75%; height: 75%;
  
  transform: translate(-50%, -50%);
  background-color: var(--col-primary);
  border-radius: 50%;
}









.playback-actions-cnt {
  display: flex;
  justify-content: space-between;
  align-items: center; /* Center vertically */
  position: relative;
  width: 70%;
  height: 70%;
  top: -50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 50%; /* Adjusted border-radius */
}

.playback-btn {
  color: var(--col-accent);
  width: 40px;
  height: 40px;  
  text-align: center;
  font-size: 25px; line-height: 40px;
  cursor: pointer; /* Added cursor property for better UX */


  margin-top: auto;
  margin-bottom: auto;
}

.playback-btn:hover {
  font-size: 30px;
}

/* Adjusted positioning for playpause, prev, and next buttons */
.playback-btn.playpause-btn {
  margin-left: auto;
  margin-right: auto;
}

.playback-btn.prev-btn {
  margin-right: auto;
}

.playback-btn.next-btn {
  margin-left: auto;
}



.playback-actions-cnt .playback-btn.prev-btn, .playback-actions-cnt .playback-btn.next-btn {
  color: transparent;
}

.playback-actions-cnt:hover .playback-btn.prev-btn, .playback-actions-cnt:hover .playback-btn.next-btn {
  color: var(--col-accent);
}



</style>
 