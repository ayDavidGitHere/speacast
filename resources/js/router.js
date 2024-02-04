// Assuming you are using Vue Router
import { createRouter, createWebHistory } from 'vue-router';
import HomePage from './components/HomePage.vue';
import LoginRegisterPage from './components/LoginRegisterPage.vue'; 
import UserPage from './components/UserPage.vue'; 

const routes = [
    { path: '/', component: HomePage },
    { path: '/login', component: LoginRegisterPage, meta: { key: 'login' } },
    { path: '/register', component: LoginRegisterPage, meta: { key: 'register' } },
    { path: '/podcast/:id', name: 'podcast.detail', component: HomePage },
    { path: '/user/:username', name: 'user.profile', component: UserPage },
];
  
const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
