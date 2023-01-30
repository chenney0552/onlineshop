// get basket from localStorage where record the state of shop or assign empty array
// JSON.parse is parser to transform JSON to javascript object
var basket = JSON.parse(localStorage.getItem("basket")) || [];

// verify if user is logged in by looking at the sessionStorage
let uname = sessionStorage.getItem("username");
document.getElementById("login").innerHTML = (!uname) ? "Login" : "Hello, "+uname;
document.getElementById("login").href = (!uname) ? "loginpage.php" : "login/account.php";


// get parent div.cart-row
var cartItems = document.getElementsByClassName("cart-items")[0];

// --------vanilla javascript, nested for loops(working), but comment out to try high order functions---------
// var showAddedItems = ()=>{
//     for(let i=0;i<basket.length;i++){
//         for(let j=0;j<shopData.length;j++){
//             if(basket[i].id==shopData[j].id){
//                 console.log(shopData[j])
//                 let content = `
//                 <div class="cart-item cart-column">
//                     <img class="cart-item-image" src="${shopData[j].img}" width="100" height="100">
//                     <span class="cart-item-title">${shopData[j].name}</span>
//                 </div>
//                 <span class="cart-price cart-column">$${shopData[j].price}</span>
//                 <div class="cart-quantity cart-column">
//                     <input class="cart-quantity-input" type="number" value="${basket[i].item}">
//                     <button class="btn btn-danger" type="button">REMOVE</button>
//                 </div>`;
//                 cartItems.innerHTML += content;
//             }
//         }
//     }
// };

var showAddedItems = ()=>{
    if(basket.length !== 0){
        cartItems.innerHTML = basket
        .map((x)=>{
            let {id, item} = x;
            let search = shopData.find((item) => item.id == id) || [];
            return `
                <div class="cart-row">
                    <div class="cart-item">
                        <img class="cart-item-image" src="${search.img}" alt="product" width="100" height="100">
                        <span class="cart-item-title">${search.brand+"<hr>"+search.name}</span>
                    </div>
                    <span class="cart-item-price">$${search.price}</span>
                    <div class="cart-item-quantity">
                        <input id="${id}" onchange="quantityChanged(${id})" class="cart-quantity-input" type="number" value="${item}" min="1">
                        <button onclick="removeItem(${id})" class="btn-danger" type="button">REMOVE</button>
                    </div>
                </div>`;
        })
        .join("");
    } else{
        cartItems.innerHTML = "<h3>Shopping bag is empty</h3>";
        document.getElementsByClassName("btn-order")[0].innerHTML = "GO SHOPPING";
        document.getElementsByClassName("btn-order")[0].href = "index.html";
    }
};

showAddedItems();

// function to update the number of item type in the cart
var calculationCartAmount = () => {
    document.getElementById("shoppingbag").innerHTML = `Shopping Bag${basket.length===0? "":"("+basket.length+")"}`;
};

calculationCartAmount();

var quantityChanged = (id) => {
    let selectedItemId = id;
    let search = basket.find((x)=>x.id === selectedItemId);
    let input = document.getElementById(id);
    search.item = parseInt(input.value);
    totalAmount();
    showAddedItems();
    localStorage.setItem("basket", JSON.stringify(basket));
}

var removeItem = (id) => {
    let selectedItemId = id;
    basket = basket.filter((x)=> x.id !== selectedItemId);
    totalAmount();
    calculationCartAmount();
    showAddedItems();
    localStorage.setItem("basket", JSON.stringify(basket));
}

var totalAmount = () => {
    if(basket.length !== 0){
        let amount = basket.map((x)=>{
            let {id, item} = x;
            let search = shopData.find(y=>y.id == id) || [];
            return item * search.price;
        }).reduce((x,y)=>x+y,0);
        document.getElementById("total").innerHTML = "$ " + amount;
    } else {
        document.getElementById("total").innerHTML = "$ " + 0;
    }
};

totalAmount();



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