<template>
  <div class="container">
    <navbar />
    <div class="form-wrapper">
      <div class="form-container" :class="{ 'login-form': formState === 'login', 'register-form': formState === 'register' }">
        <div class="form-state-tabs-container">
          <span class="tab" @click="changeFormState('login')" :class="{ 'tab-active': formState === 'login' }">LOGIN</span>
          <span class="tab" @click="changeFormState('register')" :class="{ 'tab-active': formState === 'register' }">REGISTER</span>
        </div> 
        <div class="form-state-container state-login"  v-if="formState === 'login'"> 
            <LoginForm />
        </div>  
        <div class="form-state-container state-register" v-if="formState === 'register'"> 
            <RegisterForm />
        </div>
      </div>
    </div>
    <footerhero />
  </div>
</template>

<script>
import navbar from "@/components/navbar.vue";
import footerhero from "@/components/footerhero.vue";
import LoginForm from "@/components/LoginForm.vue";
import RegisterForm from "@/components/RegisterForm.vue";


export default {
  components: {
    navbar,
    footerhero,
    LoginForm,
    RegisterForm,
  },
  data() {
    return {
      formState: this.$route.meta.key ?? "login",
      base_url: "http://localhost:8000",
    };
  },
  methods: {
    changeFormState(newState) {
      this.formState = newState;
    }, 
  },
};
</script>

<style>
/* Add your styles here */
.container {
  /* Add container styles */
}

.form-wrapper {
  /* Add form wrapper styles */
}

.form-container {
  /* Add common form container styles */
}

.login-form {
  /* Add login form styles */
}

.register-form {
  /* Add register form styles */
}

.form-state-tabs-container {
  /* Add form state tabs container styles */
  width: 100%;
  text-align: center;
  margin: 50px auto;
}

.tab {
  /* Add tab styles */
  cursor: pointer;
  text-align: center;
  padding: 5px 25px;
  color: #ccc;
}

.tab-active {
  /* Add active tab styles */
  border-bottom: 1px solid var(--col-accent);
  color: var(--col-secondary);
}

.form-input {
  /* Add form input styles */
  margin: 20px auto;
  width: 80%; max-width: 400px;
  border-radius: 50px;
  padding: 7px 28px;
  border: 1px solid var(--col-secondary);
  color: var(--col-secondary);
  position: relative;
}

.form-input:hover {
  border: 1px solid var(--col-accent);
  color: var(--col-accent);
}
 
.form-input input {
  /* Add form input styles */
  background: transparent;
  outline: none; border: none;
  padding: 7px 28px;
  color: var(--col-secondary);
  width: 70%;
}

.form-submit  {
    width: 100%;
    text-align: center;
    position: relative;
}
 
.form-submit button {
  background: var(--col-accent);
  outline: none; border: none;
  border-radius: 50px;
  padding: 14px 28px;
  color: var(--col-secondary); 
  text-transform: capitalize;
}

.form-submit button:hover {
  transform: scale(1.1);
}

.validation-error {
  color: red;
  position: absolute;
  bottom: -20%;
  padding: 0;
  font-size: 15px;
  background-color: var(--col-primary);
}

.validation-at-error {
  color: red; 
  text-align: center;
  padding: 0;
  font-size: 15px;
  background-color: var(--col-primary);
}
</style>