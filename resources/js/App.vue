<template> 
  <router-view /> 
</template>

<script> 
export default {
  // Component logic goes here
  data() {
    return {
      logged_user: null,
    }
  },
  mounted() {
    let logged_user_meta = document.querySelector("[name='user']");
    if(logged_user_meta)
    this.logged_user = JSON.parse(logged_user_meta.getAttribute("content"));
  }
};
console.log("app.vue");
</script>

<style scoped>
    .page {
        width: 100%;
        height: 100%; display: block;
        background-color: red;
        display: block;
        color: pink;
    }  
</style>
