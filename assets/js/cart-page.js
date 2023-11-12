var cart = JSON.parse(localStorage.getItem("usercart"));
var productsInCart;
var cartItemsContainer =document.getElementById('cart-items');
let totalDomElements = document.getElementsByClassName('summed-price');
var subTotalDomElement = document.getElementById("subtotal-amount");
var orderTotalDomElement = document.getElementById("total-amount");
let subTotal = 0;

const priceArr = document.querySelectorAll("#unit-price");
const quantityArr = document.querySelectorAll("#prod-quantity");
const summedPrice = document.querySelectorAll("#total-prod-price");

window.onload = function(){

    for(let x = 0; x<quantityArr.length; x++){
        let price = parseInt(priceArr[x].innerText);
        let quantity = parseInt(quantityArr[x].innerText);

        summedPrice[x].innerText = price * quantity;
        subTotal += price * quantity;
    }

    subTotalDomElement.innerText = subTotal;
    orderTotalDomElement.innerText = subTotalDomElement.innerText;
};

function loadCart(cartArray){
    cartItemsContainer.innerHTML ="";
    
    cartArray.forEach(e => {
        products.forEach(product => {
            if(e.id == product.id){

                const total = e.quantity * product.price;

                cartItemsContainer.insertAdjacentHTML("beforeend", 
                `
                <div class="cart-item">
                    <div class="prod-image">
                        <img src="`+ product.image+`" alt="Kota 1">
                    </div>
                
                    <div class="details">
                        <div class="prod">
                            <p class="prod-name">`+ product.title +`</p>
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
    loadCart(newCart)
    updateSummary();
}

function increaseQuantity(id){
    for(let i = 0; i < cart.length; i++){
        if(cart[i].id==id){
            cart[i].quantity++;
        }
    }

    saveCart(cart);
    var newCart = JSON.parse(localStorage.getItem("usercart"));
    loadCart(newCart)
    updateSummary();
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
    console.log(document.cookie)
}

function deleteCookie(name){
    document.cookie = name + "= ; expires = Thu, 01 Jan 1970 00:00:00 GMT";
}


const products = [
    {
        id: 0,
        image: 'Website pictures/kota.jpg',
        title: 'Porche',
        description: 'Bread, Atchar, Polony, Chips & Vienna',
        price: 22,
    },
    {
        id: 1,
        image: 'Website pictures/kota.jpg',
        title: 'Mahindra',
        description:  'Bread, Atchar, Polony, Chips & Cheese',
        price: 23,
    },
    {
        id: 2,
        image: 'Website pictures/kota 40.jpg',
        title: 'Mustang',
        description:  'Bread, Atchar, Polony, Chips & Eggs',
        price: 27,
    },
    {
        id: 3,
        image: 'Website pictures/kota 41.jpg',
        title: 'Rolce Royce',
        description:  'Bread, Atchar, Polony, Chips & Russian',
        price: 30,
    },
    {
        id: 4,
        image: 'Website pictures/gg-1.jpg',
        title: 'Mini Cooper',
        description: 'Bread, Atchar, Polony, Chips, Russian & Vienna',
        price: 35,
    },
    {
        id: 5,
        image: 'Website pictures/gg-1.jpg',
        title: 'Polo',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna & Cheese',
        price: 40,
    },
    {
        id: 6,
        image: 'Website pictures/gg-1.jpg',
        title: 'Bently',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese & Burger',
        price: 50,
    },
    {
        id: 7,
        image: 'Website pictures/gg-1.jpg',
        title: 'Staria',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger & Egg',
        price: 60,
    },
    {
        id: 8,
        image: 'Website pictures/gg-1.jpg',
        title: 'Lambogini',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg & Fish Finger',
        price: 70,
    },
    {
        id: 9,
        image: 'Website pictures/gg-1.jpg',
        title: 'Toyota',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg, Fish Finger & Bacon ', 
        price: 80, 
    },

    {
        id: 10,
        image: 'Website pictures/gg-1.jpg',
        title: 'Small',
        price: 40,
    },
    {
        id: 11,
        image: 'Website pictures/gg-1.jpg',
        title: 'Medium',
        price: 55,
    },
    {
        id: 12,
        image: 'Website pictures/gg-1.jpg',
        title: 'Large',
        price: 70,
    },

    {
        id: 13,
        image: 'Website pictures/egg.jpg',
        title: 'Egg',
        price: 12,
    },
    {
        id: 14,
        image: 'Website pictures/eggs.jpg',
        title: 'Russian',
        price: 15,
    },
    {
        id: 15,
        image: 'Website pictures/gg-1.jpg',
        title: 'Vienna',
        price: 10,
    },
    {
        id: 16,
        image: 'Website pictures/cheese.png',
        title: 'Cheese',
        price: 10,
    },
    {
        id: 17,
        image: 'Website pictures/Burger.webp',
        title: 'Burger',
        price: 15,
    },
    {
        id: 18,
        image: 'Website pictures/fish finger.jpg',
        title: 'Fish Finger',
        price: 12,
    },
    {
        id: 19,
        image: 'Website pictures/bacon.jpeg',
        title: 'Bacon',
        price: 13,
    },
    {
        id: 20,
        image: 'Website pictures/french.jpg',
        title: 'Polony',
        price: 5,
    }
];