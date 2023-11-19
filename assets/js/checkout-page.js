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
const localHostUrl = "http://localhost/kota2";
var products;
const url = `http://localhost/kota2/handlers/processProducts.php?prod=true`;

window.onload = () => {
    getProductList(url);
    // totalOrderPriceDomElement.innerText = totalOrderPrice;
    removeClassInit(paymentMethods)

    totalOrderPrice = totalOrderPriceDomElement.innerText;
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

function removeClassInit(list) {
    for (let i = 0; i < list.length; i++) {
        if (list[i].classList.contains("active")) {
            list[i].classList.remove("active");
        }
    }
}

function paymentOptionOnClick(index) {
    if (index == 0 && paymentDetails.classList.contains("payment-inactive")) {
        paymentDetails.classList.remove("payment-inactive");
    } else {
        paymentDetails.classList.add("payment-inactive");
    }
    if (paymentMethods[index].classList.contains("active")) {
        paymentMethods[index].classList.remove("active");

    } else {
        for (let i = 0; i < paymentMethods.length; i++) {
            if (i != index) {
                paymentMethods[i].classList.remove("active");
            } else {
                paymentMethods[i].classList.add("active");
            }
        }
    }

    switch (index) {
        case 0:
            paymentMethod = "card";
            break;
        case 1:
            paymentMethod = "cash";
            break;

        default:
            break;
    }
}

function saveContactInfo() {
    const cName = document.getElementById("customer-name").value
    const cEmail = document.getElementById("customer-email").value
    const cPhone = document.getElementById("customer-phone").value

    if (cName == '' || cEmail == '' || cPhone == '') {
        alert("Please Enter you Contact Details")
    } else {
        contactInfo = {
            cName: cName,
            cEmail: cEmail,
            cPhone: cPhone
        }

        alert("Contact Details Saved.")
    }

}

function completeOrder() {
    var orderInfo = {};
    let cArray = Object.keys(contactInfo);

    if (cArray.length == 0) {
        alert("Please Enter/Save your Contact Details")
    } else if (paymentMethod == "") {
        alert("Please Select A Payment Method")
    } else {

        orderInfo = {
            cId: document.getElementById("cId").value,
            cName: contactInfo.cName,
            cEmail: contactInfo.cEmail,
            cPhone: contactInfo.cPhone,
            orderTotal: totalOrderPriceDomElement.innerText,
            orderItems: cart,
            paymentMethod: paymentMethod,
        }

        fetch(`${localHostUrl}/handlers/processOrder.php?cd=1`, {
            "method": "POST",
            "headers": {
                "Content-type": "application/json; charset=utf-8"
            },
            "body": JSON.stringify(orderInfo)
        }).then(function (response) {
            return response.json();
        }).then(function (data) {
            const order = data;

            console.log(order.id);

            if (order.payment_method == "cash") {
                localStorage.removeItem("usercart");
                deleteCookie("usercart");

                window.location = "order-success.php";
            } else if (order.payment_method == "card") {
                window.location = "card-payment.php?id=" + order.id;
            } else {
                let message = "Something went wrong. Please try again.";
                window.alert(message);
            }


        })

    }
}

function deleteCookie(name) {
    document.cookie = name + "= ; expires = Thu, 01 Jan 2024 00:00:00 GMT";
}

