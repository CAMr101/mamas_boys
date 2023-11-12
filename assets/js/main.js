const cartCount = document.getElementById("count");
var cart = JSON.parse(localStorage.getItem("usercart"));

window.onload = setCartCount();

function setCartCount(){
    var cart = JSON.parse(localStorage.getItem("usercart"));
    if(cart){
        cartCount.textContent = cart.length;
    }
}