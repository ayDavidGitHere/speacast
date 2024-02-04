<template>
    <div class="container">
        <navbar />
        <RecentPodcasts />
        <LatestPodcasts />
        <TrendingPodcasts />
        <Playback />
    </div>
</template>

<script>
import RecentPodcasts from "@/components/RecentPodcasts.vue";
import LatestPodcasts from "@/components/LatestPodcasts.vue";
import TrendingPodcasts from "@/components/TrendingPodcasts.vue";
import Playback from "@/components/Playback.vue";
import navbar from "@/components/navbar.vue"; 
 
export default { 
    components: {
        navbar, 
        LatestPodcasts,
        TrendingPodcasts,
        RecentPodcasts,
        Playback,
    },
};
</script>

<style scoped>
/* Add your component-specific styles here */

</style>
 