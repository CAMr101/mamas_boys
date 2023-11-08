// Initialize the cart as an empty array
let cart = [];

// Function to add an item to the cart
function addToCart(itemName, itemPrice) {
    const item = {
        name: itemName,
        price: itemPrice
    };
    cart.push(item);
    updateCart();
    saveCartToLocalStorage();
}

// Function to remove an item from the cart
function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
    saveCartToLocalStorage();
}

// Function to update the cart content and calculate the total
function updateCart() {
    const cartList = document.getElementById("cart-list");
    const cartTotal = document.getElementById("cart-total");
    const cartCount = document.getElementById("count");

    // Clear the current cart content
    cartList.innerHTML = "";

    // Calculate the total amount
    let totalAmount = 0;
    for (let i = 0; i < cart.length; i++) {
        totalAmount += cart[i].price;
        const cartItem = document.createElement("div");
        cartItem.classList.add("cart-item");
        cartItem.innerHTML = `
            <span>${cart[i].name}  R${cart[i].price}</span>
            <button class="remove-item" data-index="${i}">🗑️</button> 
        `;
        cartList.appendChild(cartItem);
    }

    cartTotal.textContent = `Total: R${totalAmount.toFixed(2)}`;
    cartCount.textContent = cart.length;
}

// Function to save the cart data to local storage
function saveCartToLocalStorage() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Function to load the cart data from local storage
function loadCartFromLocalStorage() {
    const storedCart = localStorage.getItem("cart");
    if (storedCart) {
        cart = JSON.parse(storedCart);
    }
    updateCart();
}


//adddd

function updateOrderSummary() {
    const cartItems = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");

    // Clear the current order summary content
    cartItems.innerHTML = "";

    // Calculate the total amount
    let totalAmount = 0;
    for (let i = 0; i < cart.length; i++) {
        totalAmount += cart[i].price;
        const cartItem = document.createElement("div");
        cartItem.classList.add("order-item");
        cartItem.innerHTML = `
            <span>${cart[i].name} R${cart[i].price.toFixed(2)}</span>
        `;
        cartItems.appendChild(cartItem);
    }

    cartTotal.textContent = `Total: R${totalAmount.toFixed(2)}`;
}


// Add a click event listener to "ADD TO CART" buttons
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("add-to-cart-btn")) {
        const itemName = e.target.getAttribute("data-name");
        const itemPrice = parseFloat(e.target.getAttribute("data-price"));
        addToCart(itemName, itemPrice);
    }
});

// Add a click event listener to "Remove" buttons in the cart
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("remove-item")) {
        const index = parseInt(e.target.getAttribute("data-index"));
        if (!isNaN(index) && index >= 0 && index < cart.length) {
            removeFromCart(index);
        }
    }
});

// Initialize the cart by loading data from local storage when the page loads
loadCartFromLocalStorage();

// Update the cart count initially when the page loads
updateCart();

// Call the updateOrderSummary function when the checkout.html page loads
document.addEventListener("DOMContentLoaded", function() {
    // Check if you are on the checkout page
    if (window.location.pathname.endsWith("checkouts.php")) {
        updateOrderSummary();
    }
});