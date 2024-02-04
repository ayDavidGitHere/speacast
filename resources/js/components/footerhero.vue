<template>
  <div class="footer-container">
    <p class="footer-text">© 2024 LaraPod. All rights reserved.</p>
  </div>
</template>

<script>
export default {
  // Component logic goes here
};
</script>

<style scoped>
.footer-container {
  width: 100%;
  height: 300px;
  text-align: center;
  padding: 10px;
  background-color: var(--col-primary);
  color: var(--col-secondary);
  margin-top: 150px;
  
  background: linear-gradient(to top, var(--col-primary-v2), var(--col-primary));
  position: static;
  bottom: 0;
  
}

.footer-text {
  margin: 0;
}
</style>
