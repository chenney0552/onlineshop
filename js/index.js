let basket = JSON.parse(localStorage.getItem("basket")) || [];
document.getElementById("shoppingbag").innerHTML = `Shopping Bag${basket.length===0? "":"("+basket.length+")"}`;


// verify if user is logged in by looking at the sessionStorage
let uname = sessionStorage.getItem("username");
document.getElementById("login").innerHTML = (!uname) ? "Login" : "Hello, "+uname;
document.getElementById("login").href = (!uname) ? "loginpage.php" : "login/account.php";


// ---------------------------------newsletter--------------------------------
const email = document.getElementById("email");

// create paragraph to display the error Msg 
//and assign this paragraph to the class errormessage to style the error MSg
const emailError = document.createElement("p");
emailError.classList.toggle("errormessage");
document.getElementsByClassName("textfield")[0].append(emailError);

//define a global variables
const defaultMSg="";
const emailErrorMSg="Email address should be non-empty with the format xyx@xyz.xyz.";


// email vilidation
const validateEmail = ()=>{
    let regExp = /\S+@\S+\.\S+/;
    if(regExp.test(email.value)) {
        error = defaultMSg;
    } 
    else {
        error = emailErrorMSg;
    }
    return error;
};

 // display the error messages if not all requiements filled
const validate = ()=>{
    let valid = true;
    if(validateEmail()!==defaultMSg){
        emailError.innerHTML = "<span>&#10006;&nbsp;</span>" + error;
        email.style.borderColor="red";  
        valid = false;
    } 
    return valid;
};

// email blur event
email.addEventListener("blur",()=>{
    if(validateEmail() === defaultMSg){
        emailError.textContent = defaultMSg;
        email.style.borderColor=defaultMSg;
    }
});

// click newsletter link and trigger form to show or to disapper
let newsLetter = document.getElementById("newsLetter");
newsLetter.addEventListener("click", function myFunction(event) {
    event.preventDefault();
    document.getElementById("dropdown").classList.toggle("show");
});

