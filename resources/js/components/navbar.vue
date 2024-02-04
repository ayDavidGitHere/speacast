<template>
  <div class="header-container">
    <h1 class="title">
    <router-link :to="{ path: '/' }" class="page-link">LaraPod</router-link></h1>
    <div class="search-container">
      <input type="text" placeholder="Search" class="search-input" />
      <span class="search-icon fas fa-search"></span>
    </div>
    <button class="login-button">
      <router-link :to="{ path: logged_user ? '/user/@' + logged_user.username : '/login' }" class="page-link">
        {{ logged_user ? logged_user.username : 'Login' }}
      </router-link>
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      logged_user: this.$root.logged_user, // Access logged_user from the root Vue instance
    };
  }
};
</script>

<style scoped>
.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: var(--col-primary);
  color: var(--col-secondary);
}

.title {
  margin: 0;
}

.search-container {
  margin-left: auto;
  margin-right: auto;
  display: flex;
  align-items: center;
  background-color: var(--col-primary-v2);
  color: var(--col-secondary);
  border-radius: 30px;
  overflow: hidden;
}

.search-input {
  padding: 10px 24px; 
  margin-right: 10px;
  outline: none;
  border: none;
  background-color: var(--col-primary-v2);
  color: var(--col-secondary);
}

.search-icon {
  text-align: center;
  font-size: 15px;
  margin-right: 10px;
  cursor: pointer;
}

.login-button {
  margin-left: auto;
  padding: 10px 24px; 
  color: var(--col-secondary);
  background-color: var(--col-accent);
  border-radius: 30px;
  outline: none;
  border: none;
  text-transform: uppercase;
}

.login-button:hover {
    transform: scale(1.1);
}

.username {
  margin-left: 10px;
}
</style>
