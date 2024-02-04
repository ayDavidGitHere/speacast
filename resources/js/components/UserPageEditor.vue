<template>
  <div class="userpage-editor">
    <div class="profile-header">
      <img class="profile-image" :src="profile.display_image_src" alt="User Profile Image" />
      <div class="profile-info">
        <h2 class="profile-name">
          <span ref="nameSpan" contenteditable>{{ profile.name }}</span>
        </h2>@{{ user_username }}
        <p class="profile-description" contenteditable>
          <span ref="descriptionSpan">{{ profile.description }}</span>
        </p>
        <br />
        <button class="profile-save-button" @click="saveData">{{saveData_text}}</button>
        <button class="profile-save-button" @click="toggleEditor">CANCEL</button>
      </div>
    </div>
  </div>
</template>

<script>
const form_token = document.querySelector("[name='csrf-token']").getAttribute("content");

import { base_url } from '@/data/request';

export default {
  data() {
    return {

      user_username: "",

      logged_user: this.$root.logged_user, 
      
      saveData_text: "SAVE",
    }
  },
  props: {
    profile: Object,
  },
  methods: {
    toggleEditor() {
      this.$parent.toggleEditor(); 
      this.$parent.fetchProfile(this.user_username); 
    },
    async saveData() {
      const user_username = this.user_username;
      const name = this.$refs.nameSpan.innerText; 
      const description = this.$refs.descriptionSpan.innerText; 


      this.saveData_text = 'loading';
      if(name=="" || description=="") {  
        this.setSaveData_text("Fill Fields. Retry.", "SAVE");
        return;
      }  

      const apiUrl = base_url + '/profile/' + user_username + '/update_meta';

      try {
        const response = await fetch(apiUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ 
            name,
            description,

            _token: form_token,
          }),
        });

        if (!response.ok) throw new Error('Update Error');

        const responseData = await response.json();

        console.log('Update successful', responseData);

        
        this.setSaveData_text("SAVED SUCESSFULLY", "SAVE");
      } catch (error) {
        console.error(`Update HTTP error! ${error.message}`);

        // Display error message or handle the error in another way
        this.setSaveData_text("ERROR SAVING", "SAVE");
      }
    },
    setSaveData_text(textInit, textNext="") {
      this.saveData_text = textInit;
      if(textNext !== "") {  
        setTimeout(() => {
          this.saveData_text = textNext; 
        }, 1000);
      }
    },
  },
  mounted() {
    let usernameParam = this.$route.params.username;

    if (usernameParam.startsWith('@')) {
      // Remove "@" from the beginning of the username
      let user_username = usernameParam.substring(1);
      // Now you can use user_username for any further logic or API requests
      this.user_username = user_username;

      if (user_username === this.logged_user) {
        this.page_for_logged_user = true;
      }
    }
  },
};
</script>

<style scoped>
/* Add your styling here */
.userpage-editor {
  position: absolute;
  top: 0;
  border: 1px solid yellow;
  width: 100%;
  height: 100%;
  box-sizing: border-box;
  background-color: var(--col-primary);
}

.profile-header {
  width: 100%;
  height: 300px;
  background: linear-gradient(to bottom, var(--col-primary-v2), var(--col-primary));
  position: relative;
}

.profile-image {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  position: absolute;
  top: 50%;
  left: 50px;
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

.profile-info .profile-name {
  margin: 0;
  margin-top: 30px;
  font-size: 35px;
}

.profile-info .profile-description {
  width: 100%;
  overflow: hidden;
  box-sizing: border-box;
  overflow-wrap: break-word;
}

.profile-info .profile-editor-icon {
  border: 1px solid yellow;
  border-radius: 30px;
  box-sizing: bordedr-box;
  padding: 10px;
}

.profile-info .profile-editor-icon:hover {
  background-color: #ddee2233;
}

.profile-info .profile-save-button {
  background-color: transparent;
  border: 1px solid var(--col-secondary);
  border-radius: 5px;
  color: var(--col-secondary);
  padding: 8px 16px;
}

.profile-info .profile-save-button:hover {
  background-color: #dc1e3f33;
}
</style>
