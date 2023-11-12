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

const products = [
    {
        id: 0,
        image: 'Website pictures/kota.jpg',
        name: 'Porche',
        description: 'Bread, Atchar, Polony, Chips & Vienna',
        categoryId: 0,
        price: 22,
    },
    {
        id: 1,
        image: 'Website pictures/kota.jpg',
        name: 'Mahindra',
        description:  'Bread, Atchar, Polony, Chips & Cheese',
        categoryId: 0,
        price: 23,
    },
    {
        id: 2,
        image: 'Website pictures/kota 40.jpg',
        name: 'Mustang',
        description:  'Bread, Atchar, Polony, Chips & Eggs',
        categoryId: 0,
        price: 27,
    },
    {
        id: 3,
        image: 'Website pictures/kota 41.jpg',
        name: 'Rolce Royce',
        description:  'Bread, Atchar, Polony, Chips & Russian',
        categoryId: 0,
        price: 30,
    },
    {
        id: 4,
        image: 'Website pictures/kota8.jpg',
        name: 'Mini Cooper',
        description: 'Bread, Atchar, Polony, Chips, Russian & Vienna',
        categoryId: 0,
        price: 35,
    },
    {
        id: 5,
        image: 'Website pictures/kota palony 2.jpg',
        name: 'Polo',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna & Cheese',
        categoryId: 0,
        price: 40,
    },
    {
        id: 6,
        image: 'Website pictures/kota russian.jpg',
        name: 'Bently',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese & Burger',
        categoryId: 0,
        price: 50,
    },
    {
        id: 7,
        image: 'Website pictures/kota russian 2.jpg',
        name: 'Staria',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger & Egg',
        categoryId: 0,
        price: 60,
    },
    {
        id: 8,
        image: 'Website pictures/kota vienna 3.jpg',
        name: 'Lambogini',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg & Fish Finger',
        categoryId: 0,
        price: 70,
    },
    {
        id: 9,
        image: 'Website pictures/kota 41.jpg',
        name: 'Toyota',
        description: 'Bread, Atchar, Polony, Chips, Russian, Vienna, Cheese, Burger, Egg, Fish Finger & Bacon ', 
        categoryId: 0,
        price: 80, 
    },

    {
        id: 10,
        image: 'Website pictures/small chips.jpg',
        name: 'Small',
        categoryId: 1,
        price: 40,
    },
    {
        id: 11,
        image: 'Website pictures/small chips 2.webp',
        name: 'Medium',
        categoryId: 1,
        price: 55,
    },
    {
        id: 12,
        image: 'Website pictures/small chips 3.jpeg',
        name: 'Large',
        categoryId: 1,
        price: 70,
    },

    {
        id: 13,
        image: 'Website pictures/egg.jpg',
        name: 'Egg',
        categoryId: 2,
        price: 12,
    },
    {
        id: 14,
        image: 'Website pictures/eggs.jpg',
        name: 'Russian',
        categoryId: 2,
        price: 15,
    },
    {
        id: 15,
        image: 'Website pictures/vienna2.jpg',
        name: 'Vienna',
        categoryId: 2,
        price: 10,
    },
    {
        id: 16,
        image: 'Website pictures/cheese.png',
        name: 'Cheese',
        categoryId: 2,
        price: 10,
    },
    {
        id: 17,
        image: 'Website pictures/Burger.webp',
        name: 'Burger',
        categoryId: 2,
        price: 15,
    },
    {
        id: 18,
        image: 'Website pictures/fish finger.jpg',
        name: 'Fish Finger',
        categoryId: 2,
        price: 12,
    },
    {
        id: 19,
        image: 'Website pictures/bacon.jpeg',
        name: 'Bacon',
        categoryId: 2,
        price: 13,
    },
    {
        id: 20,
        image: 'Website pictures/french.jpg',
        name: 'Polony',
        categoryId: 2,
        price: 5,
    }
];

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
    // cart.push({...categories[id]});
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
