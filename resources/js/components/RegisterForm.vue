<template>   
    <div> 
        <div class="form-input"> 
            <label for="username"><span class="fas fa-user"></span></label>
            <input id="username" class="" type="text" placeholder="Username" @input="checkValidation" v-model="username" />
        </div>
        <div class="form-input">
            <span class="validation-error" v-if="validationErrorNumber === 1">{{validationErrorText}}</span>
            <label for="email"><span class="fas fa-inbox"></span></label>
            <input id="email" class="" type="email" placeholder="email@mail.com" @input="checkValidation" v-model="email" />
        </div>
        <div class="form-input">
            <span class="validation-error" v-if="validationErrorNumber === 2">{{validationErrorText}}</span>
            <label for="password"><span class="fas fa-key"></span></label>
            <input id="password" class="" type="password" placeholder="8 or more digits" @input="checkValidation" v-model="password" />
        </div>
        <div class="form-input">
            <span class="validation-error" v-if="validationErrorNumber === 3">{{validationErrorText}}</span>
            <label for="confirmPassword"><span class="fas fa-key"></span></label>
            <input id="confirmPassword" class="" type="password" placeholder="Confirm Password" @input="checkValidation" v-model="confirmPassword" />
        </div>
        <div class="form-input">
            <label for="firstName"><span class="fas fa-user"></span></label>
            <input id="firstName" class="" type="text" placeholder="First Name" @input="checkValidation" v-model="firstName" />
        </div>
        <div class="form-input">
            <label for="lastName"><span class="fas fa-user"></span></label>
            <input id="lastName" class="" type="text" placeholder="Last Name" @input="checkValidation" v-model="lastName" />
        </div> 
        <div class="form-submit">
            <p class="validation-at-error" >{{validationErrorNumber === 0 ? validationErrorText : "" }}</p>
            <span class="registration-error" v-if="registrationErrorNumber === 0">{{registrationErrorText}}</span>
            <button @click="registerUser" v-if="action_state=='static'">JOIN NOW</button>
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
      action_state_text: "JOIN NOW", 

      validationErrorNumber: "",
      validationErrorText: "",
 
      registrationErrorNumber: "",
      registrationErrorText: "",
      
      username: "",
      email: "",
      password: "",
      confirmPassword: "",
      firstName: "",
      lastName: "",

      base_url: "http://localhost:8000",
    };
  },
  methods: { 
    setValidationError(validationErrorNumber, validationErrorText) {
      this.validationErrorNumber = validationErrorNumber;
      this.validationErrorText = validationErrorText;
    },
    setRegistrationError(registrationErrorNumber, registrationErrorText) {
      this.registrationErrorNumber = registrationErrorNumber;
      this.registrationErrorText = registrationErrorText;
    },
    setActionState(action_state, action_state_text) {
      this.action_state = action_state;
      this.action_state_text = action_state_text;
    },
    checkValidation() {
      console.log( " this.username, this.email, this.password, this.confirmPassword, this.firstName, this.lastName  ",  this.username, this.email, this.password, this.confirmPassword, this.firstName, this.lastName   );

      // Validate email format
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.email)) {
        this.setValidationError(1, "Invalid email format");
        return false;
      }

      // Validate password length
      if (this.password.length < 8) {
        this.setValidationError(2, "Password must be at least 8 characters long");
        return false;
      }

      // Validate password match
      if (this.password !== this.confirmPassword) {
        this.setValidationError(3, "Passwords do not match");
        return false;
      }

      // Add your validation logic here 
      if (this.username=="" || this.email=="" || this.password=="" || this.confirmPassword=="" || this.firstName=="" || this.lastName=="" ) {
        this.setValidationError(0, "Please fill in all fields");
        return false;
      }

      this.setValidationError(-1, "All fields are correct");

      return true;
    },
    registerUser() {
      if( !this.checkValidation() ) return;

      // If all conditions pass, proceed with registration logic
      this.performRegistration();
    },
    async performRegistration() {
      this.setActionState("loading", "loading ...");

      let response = null;
      try {
        // Send a POST request to "/register"
        response = await window.fetch(this.base_url + "/register", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            username: this.username,
            email: this.email,
            password: this.password,
            confirmPassword: this.confirmPassword,
            firstName: this.firstName,
            lastName: this.lastName,

            _token: form_token,
          }),
        });


        if(!response.ok) throw new Error("Register Error");

        let responseData = await response.json();

        // Process the response
        console.log("Registration successful", responseData);

        // Display success message or navigate to a new page
        this.setActionState("finished", "Registered Successfully, Login in");
      } catch (error) {
        console.error(`Register HTTP error! Status: ${response.status }`);

        // Display error message or handle the error in another way
        this.setActionState("static", "JOIN NOW");

        if(response.status == 422) {
          let responseData = await response.json();
          console.log("responseData", responseData);
          if(responseData.error == 2) {
              this.setRegistrationError(0, "Email Already Exists");
          }
          else if(responseData.error == 3) {
              this.setRegistrationError(0, "Username Already Exists");
          }
          else {
              this.setRegistrationError(0, "Invalid Registration Credentials");
          }
        }
        if(response.status == 419)
        this.setRegistrationError(0, "Sorry, a network error");
      }
    }, 
    addMockValueToField() {
      // This method will add mock values to the fields for testing purposes
      this.username = "ruse_enam";
      this.email = "ruseenam34@example.com";
      this.password = "122110034F2q1";
      this.confirmPassword = "122110034F2q1";
      this.firstName = "Ruse";
      this.lastName = "Enam";
    },
  },
  mounted() {
    this.addMockValueToField(); 
  }
};
</script>

<style scoped> 
.registration-error {
  color: red;
  position: absolute;
  bottom: -50%; left: 50%; 
  transform: translate(-50%, 0%);
  padding: 0;
  font-size: 15px;
  background-color: var(--col-primary);
}
</style>