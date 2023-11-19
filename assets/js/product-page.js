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

var cartItemsObj = [];
var body = document.getElementById('main-body');
var prodContainer;
var products;
const url = `http://localhost/kota2/handlers/processProducts.php?prod=true`;

window.onload = loadContent();

function loadContent(){
    getProductList(url);
    category.forEach(element => {
        console.log(element.name)

        body.insertAdjacentHTML("beforeend",
            `
            <h1 class="title">`+ element.name +`</h1> 
            <div class="box-container" id="product-container">
            </div>
            <br>
            `
        )
    });

    prodContainer = document.querySelectorAll('#product-container');
    loadProducts();
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

function loadProducts(){
    for(var i = 0; i < category.length; i++){
        products.forEach(e => {
            if(i == e.categoryId && i == 0){
                prodContainer[i].insertAdjacentHTML("beforeend",
                    `
                    <div class="box">
                        <img class="prod-img" src="`+ e.image +`" alt="`+ e.name +`">
                        <h2>`+ e.name +`</h2>
                        <p>`+ e.description +`</p>
                        <h3>R `+ e.price +`</h3>
                        <button class="btn add-to-cart-btn" data-name="Toyota" data-price="22" onclick="addtocart(`+ e.id +`)">ADD TO CART</button>
                    </div>
                `
                )
            }else if(i == e.categoryId){
                prodContainer[i].insertAdjacentHTML("beforeend",
                    `
                    <div class="box">
                        <img class="prod-img" src="`+ e.image +`" alt="`+ e.name +`">
                        <h2>`+ e.name +`</h2>
                        <h3>R `+ e.price +`</h3>
                        <button class="btn add-to-cart-btn" data-name="Toyota" data-price="22" onclick="addtocart(`+ e.id +`)">ADD TO CART</button>
                    </div>
                `
                )
            }
        });
    }
}