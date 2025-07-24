console.log("Script loaded successfully");

let discount1 = 20;
let discount2 = 30;
let discount3 = 40;
let discount4 = 50;


function applyDiscounts() {
    let price1 = 10;
    let price2 = 20;
    let price3 = 30;
    let price4 = 40;
    let subTotal = 0;

    let finalPrice1 = price1 - (price1 * discount1 / 100);
    let finalPrice2 = price2 - (price2 * discount2 / 100);
    let finalPrice3 = price3 - (price3 * discount3 / 100);
    let finalPrice4 = price4 - (price4 * discount4 / 100);

    document.getElementById("discoutprice1").innerHTML = `<del>Price: $${price1}</del> <br> Final Price: $${finalPrice1}`;
    document.getElementById("discoutprice2").innerHTML = `<del>Price: $${price2}</del> <br> Final Price: $${finalPrice2}`;
    document.getElementById("discoutprice3").innerHTML = `<del>Price: $${price3}</del> <br> Final Price: $${finalPrice3}`;
    document.getElementById("discoutprice4").innerHTML = `<del>Price: $${price4}</del> <br> Final Price: $${finalPrice4}`;

    document.getElementById("discount1").innerHTML = `Discount: ${discount1}%`;
    document.getElementById("discount2").innerHTML = `Discount: ${discount2}%`;
    document.getElementById("discount3").innerHTML = `Discount: ${discount3 }%`;
    document.getElementById("discount4").innerHTML = `Discount: ${discount4}%`;

    document.getElementById('btn2').addEventListener('click', function() {

        const cartItemPrice = document.createElement('p');
        cartItemPrice.innerHTML = `Burger 1X <br> Total Price: $${finalPrice1}`;
        document.getElementById('cartItemPrice').appendChild(cartItemPrice);
        subTotal += finalPrice1;
        document.getElementById('subTotal').innerHTML = `Sub Total: $${subTotal}`;

    })
    document.getElementById('btn3').addEventListener('click', function() {

        const cartItemPrice = document.createElement('p');
        cartItemPrice.innerHTML = `Chicken Fry 1X <br> Total Price: $${finalPrice2}`;
        document.getElementById('cartItemPrice').appendChild(cartItemPrice);
        subTotal += finalPrice2;
        document.getElementById('subTotal').innerHTML = `Sub Total: $${subTotal}`;

    })
    document.getElementById('btn4').addEventListener('click', function() {

        const cartItemPrice = document.createElement('p');
        cartItemPrice.innerHTML = `Coffee 1X <br> Total Price: $${finalPrice3}`;
        document.getElementById('cartItemPrice').appendChild(cartItemPrice);
        subTotal += finalPrice3;
        document.getElementById('subTotal').innerHTML = `Sub Total: $${subTotal}`;

    })
    document.getElementById('btn5').addEventListener('click', function() {

        const cartItemPrice = document.createElement('p');
        cartItemPrice.innerHTML = `Sandwich 1X <br> Total Price: $${finalPrice4}`;
        document.getElementById('cartItemPrice').appendChild(cartItemPrice);
        subTotal += finalPrice4;
        document.getElementById('subTotal').innerHTML = `Sub Total: $${subTotal}`;


    })

}

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
applyDiscounts();