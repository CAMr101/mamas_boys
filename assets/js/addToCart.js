const category = [
    {
        id: 0,
        name: 'Kota'
    },
    {
        id: 1,
        name: 'Chips'
    },
    {
        id: 2,
        name: 'Extras'
    }
]

var cart;
const categories = [...new Set(products.map((item)=>{return item}))];
var cart = [];
var cartItemsObj = [];
let i = 0;
var body = document.getElementById('main-body');
var products;
const url = `http://localhost/kota2/handlers/processProducts.php?prod=true`;


window.onload = function (){
    getProductList(url);
    if(JSON.parse(localStorage.getItem("usercart")) != null){
        cartItemsObj = JSON.parse(localStorage.getItem("usercart"));
    }
}

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


let isProductAdded = {}; 

function addtocart(id) {

  if (isProductAdded[id]) {
    
    const userResponse = confirm("This product is already in your cart. Do you still want to add it?");

    if (!userResponse) {
      alert("Product not added to cart.");
      return;
    }
  }

  createCartObj(parseInt(id));

  // Update the product status
  isProductAdded[id] = true;

  alert("Product successfully added to cart!");
}

function createCartObj(id){
    var quantityIncreased = false;
    let newObj = {
        id: id,
        quantity: 1
    }

    if(cartItemsObj.length > 0){
        cartItemsObj.forEach(element => {
            if(element.id == id){
                element.quantity= element.quantity + 1;
                quantityIncreased = true;
            }
        });

        if(quantityIncreased == false){
            cartItemsObj.push(newObj);
        }
    }else{
        cartItemsObj.push(newObj);
    }

    cartCount.textContent = cartItemsObj.length;
    saveCart(cartItemsObj)
}

function deleteCartObj(id){
    if(cartItemsObj.length > 0 && id != undefined){

        for(let i = 0; i < cartItemsObj.length;i++){
            if(cartItemsObj[i].id == id){
                if(cartItemsObj[i].quantity > 1){
                    cartItemsObj[i].quantity++
                }else{
                    cartItemsObj.splice(i, 1)
                }
            }
        }
    }

    saveCart(cartItemsObj)
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