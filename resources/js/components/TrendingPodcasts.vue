<template>
    <!-- Display a list of podcasts -->
    <div class="section-container" v-if="podcasts.length > 0">
        <h2 >Trending Podcasts</h2>
        <div class="podcast-list-container">
            <div class="podcast-container" v-for="podcast in podcasts" :key="podcast.id">
                <img :src="podcast.cover_image" alt="Podcast Cover" class="podcast-cover-image">
                <h3 class="podcast-headline_text">{{ podcast.title }}</h3>
                <p class="podcast-sub_text">{{ podcast.description }}</p>
                <router-link :to="{ name: 'podcast.detail', params: { id: podcast.id } }" class="podcast-link fa-solid fa-play"></router-link>
                <span class="podcast-menu-icon fa-solid fa-ellipsis-vertical"></span>
            </div>
        </div>
        <button class="see-more-button"> SEE MORE </button>
    </div>
    
    <!-- Show a message if no podcasts are available -->
    <div v-else>
        <p>No podcasts available.</p>
    </div>
</template>
<script>  

import { getTrendingPodcasts } from '@/data/podcastData';

let trendingPodcasts = getTrendingPodcasts();

export default {
    data() {
        return {
            podcasts: trendingPodcasts, // Assuming you fetch podcasts from an API
        };
    },
    mounted() {
        // Fetch podcasts from the API using Axios or any other method
        // For demo purposes, an empty array is used.
        this.podcasts = trendingPodcasts;
    },
}
</script>

<style scoped>

.podcast-list-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}

.podcast-container {
    background-color: var(--col-primary-v2);
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    box-sizing: border-box;
    padding: 20px;
    min-height: 150px;

    position: relative;
    z-index: 1;
}

.podcast-container:hover {
    transform: scale(1.05);
}

.podcast-cover-image {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-bottom: 2px solid #ddd;

    position: absolute;
    top: 0%; left: 0%;
    z-index: -1;
}

.podcast-headline_text {
    font-size: 1.2em;
    font-weight: bold;
    margin: 10px 0;
    margin-top: calc(150px);

    color: white;
}

.podcast-sub_text {
    color: var(--col-secondary);
    margin: 0; 
}

.podcast-link {
    display: inline;
    background-color: transparent;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
    border-radius: 30px; 
    padding: 5px 20px;
    text-decoration: none;
    border: 1px solid #fff;
    transition: background-color 0.3s ease-in-out;

    position: absolute;
    top: 25%; left: 50%;
    transform: translate(-50%, -50%);
}



.podcast-link:hover {
    background-color: var(--col-accent);
    border-color: var(--col-accent);
}


.podcast-menu-icon {
    position: absolute;
    top: 10px; left: 10px;
    color: #fff;
}
 
 
</style>