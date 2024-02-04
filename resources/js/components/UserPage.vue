<template>
  <div class="container">
    <navbar />
    <!-- User Profile Content -->
    <div class="user-profile">
      <div class="profile-header">
        <img class="profile-image" :src="profile.display_image_src" alt="User Profile Image" />
        <div class="profile-info">
            <h2 class="profile-name">
              {{ profile.name }}
            </h2>@{{ user_username }}
            <p class="profile-followership-container" v-if="false">
                  <span class="profile-followership followers-count">
                      <span class="fas fa-users followership-icon"></span>
                      <span class="followership-count"> {{ profile.followers_count }} FOLLOWERS</span>
                  </span>
                  <span class="profile-followership follow-button">
                      <span class="fas fa-plus followership-icon"></span> 
                  </span>
                  <br><br>
                  <span class="profile-followership following-count">
                      <span class="fas fa-user-plus followership-icon"></span>
                      <span class="followership-count"> {{ profile.following_count }} FOLLOWING</span>
                  </span>
            </p>
            <p class="profile-description">{{ profile.description }}</p>
            <div class="profile-actions">
              <div class="action-item">
                <p><span class="action-icon fas fa-user"></span></p>
                <p>FOLLOW</p>
              </div> 
              <div class="action-item">
                <p><span class="action-icon fas fa-inbox"></span></p>
                <p>MESSAGE</p>
              </div> 
              <div class="action-item">
                <p><span class="action-icon fas fa-bell"></span></p>
                <p>GET NOTIFIED</p>
              </div> 
              <div class="action-item">
                <p><span class="action-icon profile-editor-icon fas fa-pencil-alt" @click="toggleEditor"></span></p>
                <p>EDIT PROFILE</p>
              </div> 
            </div>
        </div>
      </div>
      <UserPageEditor v-if="editor_visible" :profile="profile">
      </UserPageEditor>
      <div class="profile-stats">
        <div class="stat-item" active>
          <h3>{{ profile.episodes_released }}</h3>
          <p><span class="fas fa-film"></span> Episodes</p>
        </div>
        <div class="stat-item">
          <h3>{{ profile.episodes_plays }}</h3>
          <p><span class="fas fa-play-circle"></span> Plays</p>
        </div>
        <div class="stat-item">
          <h3>{{ profile.followers_count }}</h3>
          <p><span class="fas fa-users"></span> Followers</p>
        </div>
        <div class="stat-item">
          <h3>{{ profile.following_count }}</h3>
          <p><span class="fas fa-user-friends"></span> Following</p>
        </div>
      </div>
      <div class="profile-content-container"> 
        <h3 class="profile-content-container-header"><span class="fas fa-film"></span> Episodes</h3>
        <div class="profile-content" >
        </div>
      </div>
    </div>
    <footerhero />
  </div>
</template>

<script>
import navbar from "@/components/navbar.vue";
import footerhero from "@/components/footerhero.vue";
import UserPageEditor from "@/components/UserPageEditor.vue";

import { base_url } from '@/data/request'; 

export default {
  components: {
    navbar,
    footerhero, 
    UserPageEditor,
  },
  data() {
    return { 

      user_username: "",

      logged_user: this.$root.logged_user, 

      editor_visible: false,

      page_for_logged_user: false,  

      profile: {
        name: "",
        display_image_src: "https://loremflickr.com/320/240?lock=30976",
        email: "",
        description: "",
        episodes_released: 0,
        episodes_plays: 0,
        subscribed_totals: 0,

        followers_count: 352,
        following_count: 3,
      },
    };
  },
  methods: {
    fetchProfile(user_username) {
      // Replace the URL with the actual endpoint that returns the updated profile data
      const apiUrl = base_url + "/profile/" + user_username;

      window.fetch(apiUrl)
        .then((response) => {
          if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
          }
          return response.json();
        })
        .then((data) => { 
          this.profile = data.value; console.log("this.profile", this.profile)
        })
        .catch((error) => {
          console.error("Fetch error:", error);
        });
    },
    toggleEditor() {  
        this.editor_visible = !this.editor_visible;
    }
  },
  mounted() { 
    let usernameParam = this.$route.params.username;
 
    if (usernameParam.startsWith('@')) {
      // Remove "@" from the beginning of the username
      let user_username = usernameParam.substring(1); 
      // Now you can use user_username for any further logic or API requests
      this.user_username = user_username;

      this.fetchProfile(user_username); 


      if(user_username == this.logged_user) {
        this.page_for_logged_user = true;
      }

    }
  }
};
</script>

<style scoped>
.container {
  /* Add container styles */
}

.user-profile {
  width: 100%;
  box-sizing: border-box;
}

.profile-header { 
  width: 100%;
  height: 300px;
  /* background: linear-gradient(to bottom, var(--col-primary-v2), var(--col-primary)); */
  position: relative;


  width: 95%; margin-left: 2.5%;
  background-color: var(--col-primary-v3); 
  border-radius: 10px;
}

.profile-image {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  position: absolute;
  top: 50%; left: 50px;
  transform: translate(0, -50%);
}


.profile-header:hover .profile-image {
  border: 2px solid var(--col-accent);
}


.profile-info {
  width: 70%;
  padding: 20px;
  margin-left: 30%;
  color: var(--col-secondary);
  font-size: 15px; 
  box-sizing: border-box;
}

.profile-info .profile-name  { 
  margin: 0px; margin-top: 30px;
  font-size: 35px;
}
 
.profile-info .profile-description  {  
  width: 100%;  
  overflow: hidden; box-sizing: border-box;
  overflow-wrap: break-word;
}

.profile-info .profile-editor-icon  {  
}

.profile-info .profile-editor-icon:hover  {
  
}

.profile-info .profile-followership-container .profile-followership {
  display: inline-block;
  background: var(--col-accent);
  border-radius: 5px; 
  margin-right: 5px;
  padding: 5px;  
}

.profile-info .profile-followership-container .profile-followership .followership-icon {
   padding-left: 10px; padding-right: 10px;
   margin-left: 5px; margin-right: 5px;
   color: var(--col-secondary-transparent);
}

.profile-info .profile-followership-container .profile-followership .followership-count {

}

.profile-info .profile-followership-container .profile-followership.follow-button {
  background: transparent;
  border: 1.3px solid var(--col-secondary);
  color: var(--col-secondary);
  box-sizing: border-box;
}

.profile-info .profile-followership-container .profile-followership.follow-button:hover {
  cursor: pointer;
  border: 1px solid var(--col-accent);
  color: var(--col-accent);
  transform: scale(1.051); 
}



.profile-stats {
  display: flex;
  justify-content: space-around;
  margin-top: 20px;

  width: 95%; margin-left: 2.5%;
  background-color: var(--col-primary-v3); 
  border-radius: 10px;
}

.stat-item {
  text-align: center;
}

.stat-item h3 {
  font-size: 20px;
  background-color: var(--col-primary-v2);
  color: var(--col-secondary);
  width: 50px; height: 50px; 
  line-height: 50px;
  margin: 10px auto;
  border-radius: 10px;
  overflow: hidden;
}

.stat-item p {
  color: var(--col-secondary);
}

.stat-item[active] h3 {
  background-color: var(--col-accent);
}

.stat-item[active] p {
  color: var(--col-accent);
}

.stat-item:hover h3 {
 
}

.stat-item:hover p {
  color: var(--col-accent);
}




.profile-content-container {
  display: block;
  justify-content: space-around; 

  width: 95%; margin: 20px auto; min-height: 500px;
  background-color: var(--col-primary-v3); 
  border-radius: 10px; box-sizing: border-box;
  padding: 20px;
}

.profile-content-container-header {
  color: var(--col-secondary);
}






.profile-actions {
  display: flex;
  justify-content: space-around;

  width: 99%; margin: 20px auto; 
  background-color: var(--col-primary-v2); 
  border-radius: 10px; box-sizing: border-box;
  padding: 2px;
}

.action-item {
  text-align: center;
  padding: 0px; 
  font-size: 12px;
}

.action-item p {
  padding: 0; margin: 2px;
}

.action-item .action-icon {
  padding: 10px; 
  border: 1px solid yellow; border-radius: 30px;
  box-sizing: border-box; 
}

.action-item .action-icon:hover {
  background-color: #ddee2233;
}
/* Add more styles as needed */
</style>
