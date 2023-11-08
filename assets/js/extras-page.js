const categories = [
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


prodContainer = document.getElementById('product-container');


    
products.forEach(prod =>{
    if(prod.categoryId == 2){
        prodContainer.insertAdjacentHTML("beforeend",
        `
        <div class="box">
            <img class="prod-img" src="`+ prod.image +`" alt="`+ prod.name +`">
            <h2>`+ prod.name +`</h2>
            <h3>`+ prod.price +`</h3>
            <button class="btn add-to-cart-btn" data-name="Toyota" data-price="22" onclick="addtocart(`+ prod.id +`)">ADD TO CART</button>
        </div>
    `
    )
    }
});
