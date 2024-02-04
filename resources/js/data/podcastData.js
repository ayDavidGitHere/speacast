const mockPodcasts = [
    {
      id: 1,
      title: 'The Renaissance Revival',
      description: 'Explore the cultural rebirth in Europe during the Renaissance period.',
      cover_image: 'https://img.freepik.com/free-photo/retro-microphone-isolated-color-background_1387-912.jpg?size=626&ext=jpg&ga=GA1.1.563292924.1704524424&semt=sph',
      store_id: 101,
      date_added: '2022-01-15',
      total_views: 12000,
    },
    {
      id: 2,
      title: 'Space Race Chronicles',
      description: 'Dive into the thrilling competition between the United States and the Soviet Union during the Space Race.',
      cover_image: 'https://img.freepik.com/free-photo/recording-technology-podcast-microphone-livestream-used-record-content-discussion-internet-channel-stream-sound-production-station-creative-onlien-broadcast-close-up_482257-43446.jpg?size=626&ext=jpg&ga=GA1.1.563292924.1704524424&semt=sph',
      store_id: 102,
      date_added: '2022-02-03',
      total_views: 8500,
    },
    {
      id: 3,
      title: 'Industrial Revolution Insights',
      description: 'Discover the profound changes in manufacturing and society during the Industrial Revolution.',
      cover_image: 'https://img.freepik.com/free-photo/nobody-empty-desk-with-streaming-equipment-broadcast-live-conversation-social-media-no-people-space-with-podcast-station-microphone-headphones-sound-production_482257-42287.jpg?size=626&ext=jpg',
      store_id: 103,
      date_added: '2022-03-20',
      total_views: 15000,
    },
    {
      id: 4,
      title: 'Era of Enlightenment',
      description: 'Uncover the intellectual and philosophical movement that shaped the Enlightenment era.',
      cover_image: 'https://img.freepik.com/free-photo/microphone-set-up-home-podcast-studio_60438-3821.jpg?size=626&ext=jpg',
      store_id: 104,
      date_added: '2022-04-08',
      total_views: 9800,
    },
    // Add more podcast topics as needed
  ];
  
    
  function getLatestPodcasts() {
    return [...mockPodcasts].sort((a, b) => new Date(b.date_added) - new Date(a.date_added));
  }
  
  function getRecentlyPlayedPodcasts() {
    return [...mockPodcasts].sort(() => Math.random() - 0.5);
  }
  
  function getTrendingPodcasts() {
    return [...mockPodcasts].sort((a, b) => b.total_views - a.total_views);
  }
  
  export { getLatestPodcasts, getRecentlyPlayedPodcasts, getTrendingPodcasts };
  