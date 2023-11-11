
var cart;
const categories = [...new Set(products.map((item)=>{return item}))];
var cart = [];
var cartItemsObj = [];
let i = 0;
var body = document.getElementById('main-body');


window.onload = function (){
    if(JSON.parse(localStorage.getItem("usercart")) != null){
        cartItemsObj = JSON.parse(localStorage.getItem("usercart"));
    }
}


function addtocart(id){
    createCartObj(parseInt(id));
    alert("Successfully added to cart\n");
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
    }else{
        localStorage.removeItem("usercart");
        localStorage.setItem("usercart", JSON.stringify(obj));
    }
}
