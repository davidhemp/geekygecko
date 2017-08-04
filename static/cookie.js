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
    createCookie(name,"",-1);
}
// Application globals
var subTotal = 0;
var prefix = "product_";
// Application functions

function addProduct(productName, quantity, cost){
    var cost = Number(cost);
    var quantity = parseInt(quantity, 10);
    var currentQuantity = parseInt(getCookie(productName), 10);
    var currentTotal = Number(getCookie("subTotal"));

    console.log(currentQuantity);

    var newQuantity = currentQuantity + quantity
    setCookie("basket_" + productName, newQuantity.toString() , 1);

    var newCost = currentTotal+cost*quantity;
    setCookie("subTotal", newCost.toString() , 1);
    document.getElementById("basket").innerHTML = "Basket: £" + newCost.toString();

}

function removeProduct(productName, quantity, cost){
    var productName = prefix + productName
    var currentQuantity = parseInt(getCookie(productName), 10);
    var newQuantity = currentQuantity - quantity
    if (newQuantity > 0){
        setCookie("basket_" + productName, newQuantity.toString(), 1);
    } else {
        setCookie(productName, "", -1);
    }
    var subTotal = Number(getCookie("subTotal"));
    var newCost = subTotal + cost*quantity;
    setCookie("subTotal", newCost.toString(), 1);
    document.getElementById("basket").innerHTML = "Basket: " + newCost.toString();
}

function addFromInfo(productName, cost){
    var quantity = parseInt(document.querySelector("#product-quantity").value, 10);
    addProduct(productName, quantity, cost);
}
///////////////////
function getCookieByMatch(regex) {
  var cs = document.cookie.split(/;\s*/);
  var ret = [];
  for (var i = 0; i < cs.length; i++) {
    if (cs[i].match(regex)) {
      ret.push(cs[i]);
    }
  }
  return ret;
};


// getCookieByMatch(/^text\d+=/);
