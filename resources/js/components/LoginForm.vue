<template>  
    <div>   
        <div class="form-input">
            <label for="email"> <span class="fas fa-inbox"></span></label>
            <input id="email" class="" type="email" placeholder="email@mail.com" v-model="email" />
        </div> 
        <div class="form-input">
            <label for="password"> <span class="fas fa-key"></span></label>
            <input id="password" class="" type="password" placeholder="8_more_digits" v-model="password" />
        </div>
        <div class="form-submit">
            <span class="login-error" v-if="loginErrorNumber === 0">{{loginErrorText}}</span>
            <button class="" @click="loginUser" v-if="action_state =='static'" >{{action_state_text}}</button>
            <button class="" v-if="action_state =='finished'" >{{action_state_text}}</button>
            <button class="" v-if="action_state =='loading'" >{{action_state_text}}</button>
        </div>
    </div>    
</template>

<script>  
const form_token = document.querySelector("[name='csrf-token']").getAttribute("content"); 

export default {
  components: { 
  },
  data() {
    return {  
      action_state: "static",
      action_state_text: "ENTER", 

      loginErrorNumber: "",
      loginErrorText: "",
 
      email: "",
      password: "", 

      base_url: "http://localhost:8000",
    };
  },
  methods: {  
    setLoginError(loginErrorNumber, loginErrorText) {
      this.loginErrorNumber = loginErrorNumber;
      this.loginErrorText = loginErrorText;
    }, 
    setActionState(action_state, action_state_text) {
      this.action_state = action_state;
      this.action_state_text = action_state_text;
    },
    loginUser() { 
      this.performLogin();
    },
    async performLogin() {
      this.setActionState("loading", "loading ...");

      let response = null;
      try {
        response = await fetch(this.base_url + "/login", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            email: this.email,
            password: this.password,
            
            _token: form_token,
          }),
        });

        if(!response.ok) throw new Error("Login Error");

        const responseData = await response.json();

        console.log("Login successful", responseData);

        // Display success message or navigate to a new page
        this.setActionState("finished", "Login Successful, Taking you to home");
        this.redirectToUserPage(responseData.user);
      } catch (error) { 
        console.error(`Login HTTP error! Status: ${response.status}`);

        // Display error message or handle the error in another way
        this.setActionState("static", "ENTER");

        if(response.status == 401)
        this.setLoginError(0, "Invalid Email or Password");
        if(response.status == 419)
        this.setLoginError(0, "Sorry, a network error");
      }
    },
    redirectToUserPage(user) {
      console.log(user.username);
      // Redirect to "/user/@ruse" after 5 seconds (5000 milliseconds)
      setTimeout(() => {
        this.$router.push(`/user/@${user.username}`);
      }, 5000);
    },

  },
};
</script>

<style scoped> 

.login-error {
  color: red;
  position: absolute;
  bottom: -50%; left: 50%; 
  transform: translate(-50%, 0%);
  padding: 0;
  font-size: 15px;
  background-color: var(--col-primary);
}

</style>