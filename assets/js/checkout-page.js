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


var cart = JSON.parse(localStorage.getItem("usercart"));
var paymentMethods = document.getElementsByClassName("method");
var orderSummaryItemsDomElement = document.getElementById("items-container")
var totalOrderPrice = 0;
var totalOrderPriceDomElement = document.getElementById("total-amount");
var paymentDetails = document.getElementById("payment-details");
const saveBtn = document.getElementsByClassName("saveBtn");
const formEl = document.getElementsByClassName("contact-form");
var contactInfo = {};
let paymentMethod = "";
const localHostUrl = "http://localhost/kota2"

window.onload = () => {
    if(cart){
        cart.forEach(e => {
            products.forEach(product => {
                if(e.id == product.id){

                    const total = e.quantity * product.price;
                    totalOrderPrice += total; 

                    orderSummaryItemsDomElement.insertAdjacentHTML("beforeend", 
                    `
                    <div class="item">
                        <img src="`+ product.image +`" alt="">
                        <div class="prod-info">
                            <p>
                                <span class="quantity">`+ e.quantity +` </span>
                                <span class="name">x Masarati<span>
                            </p>
                            <p>
                                R <span class="price">`+ total +`</span>
                            </p>
                        </div>
                    </div>
                    `
                    )}
            });
        });
    }

    totalOrderPriceDomElement.innerText = totalOrderPrice;
    removeClassInit(paymentMethods)
}

function removeClassInit(list){
    for(let i = 0; i<list.length; i++){
        if(list[i].classList.contains("active")){
            list[i].classList.remove("active");
        }
    }
}

function paymentOptionOnClick(index){
    if(index == 0 && paymentDetails.classList.contains("payment-inactive")){
        paymentDetails.classList.remove("payment-inactive");
    }else{
        paymentDetails.classList.add("payment-inactive");
    }
    if(paymentMethods[index].classList.contains("active")){
        paymentMethods[index].classList.remove("active");
        
    }else{
        for(let i = 0; i < paymentMethods.length; i++){
            if(i != index){
                paymentMethods[i].classList.remove("active");
            }else{
                paymentMethods[i].classList.add("active");
            }
        }
    }

    if(index == 0){
        paymentMethod = "card";
    }else if (index == 1){
        paymentMethod = "cash";
    }
    
}

function saveContactInfo(){
    const cName = document.getElementById("customer-name").value
    const cEmail = document.getElementById("customer-email").value
    const cPhone = document.getElementById("customer-phone").value

    if(cName == '' || cEmail == '' || cPhone == ''){
        alert("Please Enter you Contact Details")
    }else{
        contactInfo = {
            cName: cName,
            cEmail: cEmail,
            cPhone: cPhone
        }
    
        alert("Contact Details Saved.")
    }

}

function completeOrder(){
    var orderInfo = {};
    let cArray = Object.keys(contactInfo);

    if(cArray.length == 0){
        alert("Please Enter/Save your Contact Details")
    }else if(paymentMethod == ""){
        alert("Please Select A Payment Method")
    }else{

        orderInfo = {
            cName: contactInfo.cName,
            cEmail: contactInfo.cEmail,
            cPhone: contactInfo.cPhone,
            orderTotal: totalOrderPrice,
            orderItems: cart,
            paymentMethod: paymentMethod,
        }

        fetch(`${localHostUrl}/handlers/processNewOrder.php`,{
            "method": "POST",
            "headers": {
                "Content-type": "application/json; charset=utf-8"
            },
            "body": JSON.stringify(orderInfo)
        }).then(function(response){
            return response.text();
        }).then(function(data){
            console.log("Data from server")
            console.log(data);

            localStorage.setItem("orderComplete", data);

            window.location = "success-page.php"
        })
        
    }
}


