// When a product is added to the basket it is added as :
//  'product_{{ product.id}}' = quantity
// The value is also added to 'subTotal' both as a cookie and var
//
//
// Helper functions

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return 0;
}

function eraseCookie(name) {
    setCookie(name,"",-1);
}
// Application globals
var subTotal = 0;
var prefix = "basket_";
// Application functions

function updateBasket(productid, quantity, deltaQuantity, cost){
    var currentTotal = Number(getCookie("subTotal"));
    var newCost = currentTotal+cost*deltaQuantity;
    if (quantity > 0){
        setCookie(prefix + productid, quantity.toString() , 1);
    } else {
        eraseCookie(prefix + productid);
    }
    setCookie("subTotal", newCost.toString() , 1);
    document.getElementById("header-subtotal").innerHTML = "£" + newCost.toFixed(2);
    document.getElementById("header-subtotal2").innerHTML = "Basket: £" + newCost.toFixed(2);
}

function addFromInfo(productid, cost){
    var newQuantity = parseInt(document.querySelector("#product-quantity").value, 10);
    var currentQuantity = parseInt(getCookie(prefix+productid), 10);
    document.getElementById('addButton').innerHTML="Update Basket";
    if (currentQuantity > 0){
        document.getElementById('confirm-text').innerHTML="<p>Basket Updated</p>";
    } else {
        document.getElementById('confirm-text').innerHTML="<p>Added to Basket</p>";
    }
    updateBasket(productid, newQuantity, newQuantity-currentQuantity, Number(cost));
}

function updateFromBasket(productid, newQuantity, cost){
    var currentQuantity = parseInt(getCookie(prefix+productid), 10);
    updateBasket(productid, newQuantity, newQuantity-currentQuantity, Number(cost));
    location.reload();
}
