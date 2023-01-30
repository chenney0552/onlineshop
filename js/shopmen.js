var shopItems = document.getElementsByClassName("shop-items")[0];

// basket array stores items that is being selected so that we can record the state of all items in localStorage
// var basket = [];
// parse JSON in localStorage to object
var basket = JSON.parse(localStorage.getItem("basket")) || [];

// verify if user is logged in by looking at the sessionStorage
let uname = sessionStorage.getItem("username");
document.getElementById("login").innerHTML = (!uname) ? "Login" : "Hello, "+uname;
document.getElementById("login").href = (!uname) ? "loginpage.php" : "login/account.php";


var generateItem = (itemArray)=>{
    return itemArray.filter(item=>item.sex==="men").map((item)=>{
        let {id, brand, name, price, img} = item;
        return `
        <div class="shop-item">
            <img class="shop-item-image" src="${img}" alt="product image">
            <h3 class="shop-item-brand">${brand}</h3>
            <p class="shop-item-title">${name}</p>
            <div class="shop-item-details">
                <span class="shop-item-price">$${price}</span>
                <button onclick="addItemToCart(${id})" class="shop-item-button" type="button">ADD TO BAG</button>
            </div>
        </div>
        `;
    });
};

var renderMenswear = (itemArray)=>{
    shopItems.innerHTML=generateItem(itemArray).join("");
};

renderMenswear(shopData);

// function to update the number of item type in the cart
var calculationCartAmount = () => {
    document.getElementById("shoppingbag").innerHTML = `Shopping Bag${basket.length===0? "":"("+basket.length+")"}`;
};

calculationCartAmount();

var addItemToCart=(id)=>{
    let selectedItemId = id;
    let search = basket.find((x)=>x.id === selectedItemId);
    // if selected item id does not exist in basket, add to basket
    if(search === undefined){
        basket.push({id:selectedItemId,item:1});
        // every tiem a item is pushed to basket, then shopping bag become shopping bag (x)
        calculationCartAmount();
    } else{
        search.item++;
    }
    // 
    localStorage.setItem("basket",JSON.stringify(basket));
};

// add search function
var searchContent = document.getElementById("search");
searchContent.addEventListener("input", (e)=>{
    let searchResult = shopData.filter(item=>item.sex==="men" && item.name.toLowerCase().includes(e.target.value.toLowerCase())===true);
    if(searchResult.length===0){
        shopItems.innerHTML="Sorry, nothing found!";
    } else {
        renderMenswear(searchResult);
    } 
});

// add functionality to filter buttons in aside
var allBrands = document.getElementById("all-brands");
allBrands.addEventListener("click", ()=>renderMenswear(shopData));

var adidasOriginals = document.getElementById("adidas-originals");
adidasOriginals.addEventListener("click", ()=>{
    renderMenswear(shopData.filter(item=>item.brand=="Adidas Originals"));
});

var bape = document.getElementById("bape");
bape.addEventListener("click",()=>{
    renderMenswear(shopData.filter(item=>item.brand=="BAPE"));
});

var essentials = document.getElementById("essentials");
essentials.addEventListener("click",()=>{
    renderMenswear(shopData.filter(item=>item.brand=="Essentials"));
});


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