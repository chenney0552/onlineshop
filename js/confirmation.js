let basket = JSON.parse(localStorage.getItem("basket")) || [];
basket = [];
localStorage.setItem("basket", JSON.stringify(basket));

// verify if user is logged in by looking at the sessionStorage
let uname = sessionStorage.getItem("username");
document.getElementById("login").innerHTML = (!uname) ? "Login" : "Hello, "+uname;
document.getElementById("login").href = (!uname) ? "loginpage.php" : "login/account.php";
