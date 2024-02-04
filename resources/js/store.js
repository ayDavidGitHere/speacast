import * as Vue from 'vue';
import { createStore } from 'vuex';
  
function getRandomNumber(min, max) {
    // Ensure min and max are numbers
    min = parseFloat(min);
    max = parseFloat(max);

    // Check if either min or max is NaN
    if (isNaN(min) || isNaN(max)) {
        throw new Error('Invalid input. Both min and max must be numbers.');
    }

    // Calculate the random number within the range
    return Math.random() * (max - min) + min;
}



const state = {
  lines: [],
  playbackState: 'play', // Initial state is 'play'
};

const mutations = {
  SET_LINES(state, lines) {
    state.lines = lines;
  },
  TOGGLE_PLAYBACK(state) {
    state.playbackState = state.playbackState === 'play' ? 'pause' : 'play';
  },
};

const actions = {
  generateLines({ commit }) {
    let numberOfWaves = 64 * 1.5;
    let lines = [];
    for (let i = 0; i < numberOfWaves; i++) {
      const angle = (360 / numberOfWaves) * i;
      const dest_height = (50 - Math.random() * 1 * 10) + '%';
      const animation_duration = (getRandomNumber(0.5, 2)) + 's';
      lines.push({ angle, dest_height, animation_duration });
    }
    commit('SET_LINES', lines);
  },
  togglePlayback({ commit }) {
    commit('TOGGLE_PLAYBACK');
  },
  play({ commit }) {
    // Your play function logic goes here
    console.log('Play function called');
  },
};

const getters = {
  getLines: state => state.lines,
  getPlaybackState: state => state.playbackState,
};

const store = createStore({
  state,
  mutations,
  actions,
  getters,
});

export default store;