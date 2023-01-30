
let emailInput = document.querySelector("#email");
let userInput = document.querySelector("#login");
let passInput = document.querySelector("#pass");
let pass2Input = document.querySelector("#pass2");

// create paragraph to display the error Msg returned by validateEmail() function
// and assign this paragraph to the class warning to style the error MSg
let emailError = document.createElement("p");
emailError.setAttribute("class", "warning");
//append the created element to the parent of email div
document.querySelectorAll(".textfield")[0].append(emailError);

// create paragraph to display the error Msg returned by validateUser() function
// and assign this paragraph to the class warning to style the error MSg
let userError = document.createElement("p");
userError.setAttribute("class", "warning");
//append the created element to the parent of user div
document.querySelectorAll(".textfield")[1].append(userError);

// create paragraph to display the error Msg returned by validatePass() function
// and assign this paragraph to the class warning to style the error MSg
let passError = document.createElement("p");
passError.setAttribute("class", "warning");
//append the created element to the parent of pass div
document.querySelectorAll(".textfield")[2].append(passError);

// create paragraph to display the error Msg returned by validatePass2() function
// and assign this paragraph to the class warning to style the error MSg
let pass2Error = document.createElement("p");
pass2Error.setAttribute("class", "warning");
//append the created element to the parent of pass2 div
document.querySelectorAll(".textfield")[3].append(pass2Error);

//define global variables
let defaultMsg = "";
let emailErrorMsg =
  "x Email address should be non-empty with the formal xyx@xyz.xyz.";
let userErrorMsg =
  "x User name should be non-empty, and within 20 characters long.";
let passErrorMsg =
  "x Password should be at least 6 characters: 1 uppercase, 1 lowercase.";
let pass2ErrorMsg = "x Please retype password.";

//method to validate email address
function validateEmail() {  
    let email = emailInput.value; // access the value of the email
    let regexp = /\S+@\S+\.\S+/; //reg. expression
  
    if (regexp.test(email)) {
      //test is predefined method to check if the entered email matches the regexp
      error = defaultMsg;
    } else {
      error = emailErrorMsg;
    }
  
    return error;
  }
  
  //method to validate user name
  function validateUser() {
    let user = userInput.value; // access the value of the email
  
    if (user.length > 0 && user.length < 20) {
      //check the user if the entered user matches the requirement.
      error = defaultMsg;
    } else {
      error = userErrorMsg;
    }
    return error;
  }
  
  //method to validate password
  function validatePassword() {
    let pass = passInput.value; // access the value of the email
    let regexp = /^(?=.*[a-z])(?=.*[A-Z]).{6,}$/; //reg. expression
    if (regexp.test(pass)) {
      //test is predefined method to check if the entered password matches the regexp
      error = defaultMsg;
    } else {
      error = passErrorMsg;
    }
    return error;
  }
  //method to validate password2
  function validatePassword2() {
    let pass = passInput.value; // access the value of the email
    let pass2 = pass2Input.value; // access the value of the email
    
    if (!pass2) { 
          error = pass2ErrorMsg;
    }    
    else if (pass === pass2) {
      //check the password2 if the entered password2 matches the requirement.
      error = defaultMsg;
    } else {
      error = pass2ErrorMsg;
    }
    return error;
}
  
//event handler for submit event
function validate() {
    let valid = true; //global validation
    let emailValidation = validateEmail();
    let userValidation = validateUser();
    let passValidation = validatePassword();
    let pass2Validation = validatePassword2();
  
    if (emailValidation !== defaultMsg) {
        emailError.textContent = emailValidation;
        emailInput.style.borderColor = "red";
        valid = false;
    }
  
    if (userValidation !== defaultMsg) {
        userError.textContent = userValidation;
        userInput.style.borderColor = "red";
        valid = false;
    }
  
    if (passValidation !== defaultMsg) {
        passError.textContent = passValidation;
        passInput.style.borderColor = "red";
        valid = false;
    }

    if (pass2Validation !== defaultMsg) {
        pass2Error.textContent = pass2Validation;
        pass2Input.style.borderColor = "red";
        valid = false;
    }

    if (valid) {
        userInput.value = userInput.value.toLowerCase();
      }
    
      return valid;
}
    

// add event listener to reset the form
function resetFormError() {
    emailError.textContent = defaultMsg;
    userError.textContent = defaultMsg;
    passError.textContent = defaultMsg;
    pass2Error.textContent = defaultMsg;
    emailInput.style.borderColor = "black";
    userInput.style.borderColor = "black";
    passInput.style.borderColor = "black";
    pass2Input.style.borderColor = "black";
  }
  
  document.forms[0].addEventListener("reset", resetFormError);

  // add event listener to the email if you entered correct email,the error paragraph will be empty
emailInput.addEventListener("blur", () => {
    // arrow function  
    let x = validateEmail();
    if (x == defaultMsg) {
      emailError.textContent = defaultMsg;
      emailInput.style.borderColor = "black";
    }
  });
  
  // add event listener to the user if you entered correct user name,the error paragraph will be empty
  userInput.addEventListener("blur", () => {
    // arrow function
    let x = validateUser();
    if (x == defaultMsg) {
      userError.textContent = defaultMsg;
      userInput.style.borderColor = "black";
    }
  });
  
  // add event listener to the password if you entered correct password,the error paragraph will be empty
  passInput.addEventListener("blur", () => {
    // arrow function
    let x = validatePassword();
    if (x == defaultMsg) {
      passError.textContent = defaultMsg;
      passInput.style.borderColor = "black";
    }
  });
  
  // add event listener to the password2 if you entered correct password2,the error paragraph will be empty
  pass2Input.addEventListener("blur", () => {
    // arrow function
    let x = validatePassword2();
    if (x == defaultMsg) {
      pass2Error.textContent = defaultMsg;
      pass2Input.style.borderColor = "black";
    }
  });