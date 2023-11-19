var cart = JSON.parse(localStorage.getItem("usercart"));
var productsInCart;
var cartItemsContainer =document.getElementById('cart-items');
let totalDomElements = document.getElementsByClassName('summed-price');
var subTotalDomElement = document.getElementById("subtotal-amount");
var orderTotalDomElement = document.getElementById("total-amount");
let subTotal = 0;
var products;
const url = `http://localhost/kota2/handlers/processProducts.php?prod=true`;

const priceArr = document.querySelectorAll("#unit-price");
const quantityArr = document.querySelectorAll("#prod-quantity");
const summedPrice = document.querySelectorAll("#total-prod-price");
let count = document.getElementById("count");

window.onload = function(){
    getProductList(url);
    for(let x = 0; x<quantityArr.length; x++){
        let price = parseInt(priceArr[x].innerText);
        let quantity = parseInt(quantityArr[x].innerText);

        summedPrice[x].innerText = price * quantity;
        subTotal += price * quantity;
    }

    subTotalDomElement.innerText = subTotal;
    orderTotalDomElement.innerText = subTotalDomElement.innerText;
};

async function getProductList(url) {

    const response = await fetch(url)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            products = data;
        })
        .catch(function (error) {
            console.log(error);
        })
}

function loadCart(cartArray){
    cartItemsContainer.innerHTML ="";
    
    cartArray.forEach(e => {
        products.forEach(product => {
            if(e.id == product.id){

                const total = e.quantity * product.price;

                if(product.image === ""){
                    var altName ="'" + product.name + "'" + " image not found";
                }
                else{
                    var altName = product.name;
                }

                cartItemsContainer.insertAdjacentHTML("beforeend", 
                `
                <div class="cart-item">
                    <div class="prod-image">
                        <img src="`+ product.image+`" alt="`+ altName+`">
                    </div>
                
                    <div class="details">
                        <div class="prod">
                            <p class="prod-name">`+ product.name +`</p>
                            <p class="prod-ingredient">
                            `+ product.description +`
                            </p>
                        </div>

                        <div>
                            <p class="price">Unit Price</p>
                            <p class="unit-price">
                                R <span id="unit-price">`+ product.price +`</span>
                            </p>
                        </div>

                        <div>
                            <p class="quantity">Quantity</p>
                            <!-- <input type="number" name="quantity" min="1" id="quantity" class="quantity-input"> -->

                            <div class="buttons">
                                <button type="button" class="decrease" onclick="decreaseQuantity(`+ e.id +`)">-</button>

                                <span class="number">`+ e.quantity +`</span>

                                <button type="button" class="increase" onclick="increaseQuantity(`+ e.id +`)">+</button>
                            </div>
                        </div>

                        <div>
                            <p class="total-price">Total</p>
                            <p class="summedPrice-container">
                                R <span class="summed-price">`+ total +`</span>
                            </p>
                        </div>
                    </div>
                </div>
                `
                )}
        });
    });

    subTotalDomElement.innerText = subTotal;
    orderTotalDomElement.innerText = subTotalDomElement.innerText;

}

function decreaseQuantity(id){
    for(let i = 0; i < cart.length; i++){
        if(cart[i].id==id){
            cart[i].quantity--;
        }

        if(cart[i].quantity < 1){
            cart.splice(i, 1);
        }
    }

    saveCart(cart);
    var newCart = JSON.parse(localStorage.getItem("usercart"));
    // getProductList(url);
    loadCart(newCart);
    updateSummary();
    
    count.textContent = newCart.length;
}

function increaseQuantity(id){
    for(let i = 0; i < cart.length; i++){
        if(cart[i].id==id){
            cart[i].quantity++;
        }
    }

    saveCart(cart);
    var newCart = JSON.parse(localStorage.getItem("usercart"));
    // getProductList(url);
    loadCart(newCart)
    updateSummary();

    count.textContent = newCart.length;
}

async function getProductList(url){
    
    const response = await fetch(url)
    .then((response)=>{
        return response.json();
    })
    .then((data)=>{
        products = data;
        console.log(products);
    })
    .catch(function(error){
        console.log(error);
    })
}

function updateSummary(){
    subTotal = 0;

    for(let i = 0; i < totalDomElements.length; i++){
        subTotal += parseInt(totalDomElements[i].innerText);
    }

    subTotalDomElement.innerText = subTotal;
    orderTotalDomElement.innerText = subTotalDomElement.innerText;
}

function saveCart(obj){
    if(localStorage.getItem("usercart")==null){
        localStorage.setItem("usercart", JSON.stringify(obj));
        deleteCookie("usercart");
        setCookie("usercart", obj, 5);
    }else{
        localStorage.removeItem("usercart");
        localStorage.setItem("usercart", JSON.stringify(obj));
        deleteCookie("usercart");
        setCookie("usercart", obj, 5);
    }
}

function setCookie(name, values, days){
    const d = new Date();
    d.setTime(d.getTime() + (days*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = name + "=" + JSON.stringify(values) + ";" + expires + ";path=/";
}

function deleteCookie(name){
    document.cookie = name + "= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
}